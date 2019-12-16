<?php
/**
 * Auth
 * 
 * @package 
 * @author Gabriel Comarita
 * @copyright 2012
 * @version $Id$
 * @access public
 */
class Auth {
    
	public $conf;
    public $db;
    public $ses;
    
    public $login_url;
    public $attempts_before_captcha_for_login;
    public $max_login_attempts;
    
    public $mail;

	/**
	 * Auth::__construct()
	 * 
	 * @param mixed $conf
	 * @param mixed $db
	 * @return void
	 */
	public function __construct($conf = array(), $db = '', $ses = '', $app = '') {
		$this->conf = $conf;
        $this->db = $db;
        $this->ses = $ses;
        $this->app = $app;
        
        $this->login_url = $conf['url']['path_to_afp_admin'].'login.php';
        $this->attempts_before_captcha_for_login = 3;
        $this->max_login_attempts = 10;
	}
    
    public function initMail() {
        
        $php_mailer_dir = $this->conf['local']['path_to_app'].'includes/php.mailer/';
        
        include $php_mailer_dir.'class.phpmailer.php';
        include $php_mailer_dir.'class.pop3.php';
        
        $mail = new PHPMailer();
        
        return $mail;
    }  
    
    /**
     * Auth::isLoggedIn()
     * 
     * @return
     */
    public function isLoggedIn() {   
        
        $user_id = $this->ses->get('user_id');
                
        if($user_id) {
            $r = true;
        } else {
            $r = false;
        }
            
        return $r;
    }

    
    /**
     * Auth::checkUser()
     * 
     * @return void
     */
    public function checkUser() {
        if( ! $this->isLoggedIn()) {
            $this->redirect($this->login_url);
        } else {
            return $this->ses->get('user_id');
        }
    }

    /**
     * Auth::autoLogin()
     * 
     * @return
     */
    public function autoLogin() {
        //echo '<pre>'; print_r($_COOKIE); echo '</pre>';        
		$hash = $_COOKIE['afp_data'];
                        
        if($hash && !$_SESSION['user_id'] && (strpos($hash, '.') !== false)) {    
            
            //echo $hash.'<br />';
            list($user_id, $enc_pwd) = explode('.', $hash);
            //echo $enc_pwd;
            
            // Check if the login credentials are valid
            $db_password_hash = $this->db->getOne("SELECT password FROM `".$this->conf['db']['prefix']."users` WHERE id='".$user_id."'");
            
            $cookie_str = $this->doCookieStr($db_password_hash);
            
            //echo $db_password_hash.'<br />'.$db_password_hash;
            
            if($cookie_str == $enc_pwd) {
 
                // Set the sessions
                $this->ses->set('user_id', $user_id);
 
                return true;
            }
        }
        return false;
    }
     
    /**
     * Auth::checkLogin()
     * 
     * @param mixed $credentials
     * @return
     */
    public function checkLogin($credentials) {
    
        $username       = $credentials['username'];
        $password       = $credentials['password'];
        $remember_me    = $credentials['remember_me'];
        $security_code  = $credentials['security_code'];
    
        // check if the user had to enter the security code and if it was entered correctly
    
        if($this->captchaForLogin()) {
    
            if(!$this->isValidCaptcha($security_code)) {
    
    	       $this->recordVisitorActivity();
    
               return ($this->checkIfBanned()) ? 'banned' : 'incorrect_captcha';
            }
        }
 
        $requested_password_hash = $this->generatePasswordHash($password);
    
        $sql_login_check_query = "SELECT id FROM `".$this->conf['db']['prefix']."users`
                                  WHERE username='".$username."' && password='".$requested_password_hash."'";
    
        //echo $sql_login_check_query;
    
        $fetch_login = $this->db->getRow($sql_login_check_query);
    
        //echo '<pre>'; print_r($fetch_login); echo '</pre>';
    
        if( ! empty($fetch_login) ) {
    
            //echo $fetch_login['id'];
    
            // set the sessions
            $this->ses->set('user_id', $fetch_login['id']);

            // Was Remember Me checked?
            $cookie_path = parse_url(URL_PATH_TO_AFP, PHP_URL_PATH);
 
            if($remember_me == 1) {
                $cookie_value = $fetch_login['id'].'.'.$this->doCookieStr($requested_password_hash);
                setcookie('afp_data', $cookie_value, (time() + (3600 * 24 * 30)), $cookie_path, AFP_DOMAIN);
            }
    
            // update the `users` table
            $q = "UPDATE `".$this->conf['db']['prefix']."users` SET logins = logins + 1, last_login='".time()."' WHERE id=".$fetch_login['id'];
            
            //echo $_SESSION['user_id'];
            
            $this->db->query($q);
    
            // delete any activities from `visitors_activity`
            $this->db->delete($this->conf['db']['prefix'].'visitors_activity', array('ip' => ip2long($this->getRealIpAddress())));
    
            return 'is_valid';
        } else {
            return $this->recordVisitorActivity();
        }
        
        return false;
    }

    /**
     * Auth::isValidCaptcha()
     * 
     * @param mixed $security_code
     * @return
     */
    function isValidCaptcha($security_code) {
        
        //echo $this->ses->get('login_captcha_security_code');
          
        if($this->ses->get('login_captcha_security_code') == '') {
            $token = $this->ses->get('login_captcha_security_code', 'c');
        } else {
            $token = $this->ses->get('login_captcha_security_code');
        }
        
        if(md5($security_code) != $token) {
            return false;
        }
        
        return true;
    }

    function checkIfBanned() {
    
        // Check IP Address
        $visitor_ip = $this->getRealIpAddress();
        
        $fetch = $this->db->getRow("SELECT banned FROM `".$this->conf['db']['prefix']."visitors_activity` WHERE banned='1' AND ip='".ip2long($visitor_ip)."'");
        
        if(count($fetch) > 0) {
            if($fetch['banned'] == 1) {
                return true;
            }
        }
        
        return false;  
    }
      
    /**
     * Auth::generateHash()
     * 
     * @param mixed $string
     * @return
     */
    public function generateHash($string) {
        return strtoupper(str_replace('.', '', uniqid(substr(md5(strrev($string)), 0, 16), true)));
    }

    /**
     * Auth::generatePasswordHash()
     * 
     * @param mixed $string
     * @return
     */
    public function generatePasswordHash($string) {
        return strrev(substr(md5($string), 0, 27).substr(sha1($string), 0, 23));
    }
 
    /**
     * Auth::doCookieStr()
     * 
     * @param mixed $str
     * @return
     */
    public function doCookieStr($str) {
        $str = strrev($str);
        return sha1($str).md5($str);
    }
    
    /**
     * Auth::generateRandomPassword()
     * 
     * @param string $chars_number
     * @return
     */
    public function generateRandomPassword($chars_number = '') {
    
        if($chars_number == '') {
            $chars_number = 10;
        }
    
        $array = array_merge(range('a','z'), range(1,9));
        
        shuffle($array);
    
        $rand_keys = array_rand($array, $chars_number);
    
        $string = '';
    
        foreach($rand_keys as $key) {
            $string .= $array[$key];
        }
    
        return $string;
    }

    /**
     * Auth::captchaForLogin()
     * 
     * @return
     */
    public function captchaForLogin() {
    
        $fetch = $this->db->getRow("SELECT login_attempts FROM `".$this->conf['db']['prefix']."visitors_activity` WHERE ip = INET_ATON('".$this->getRealIpAddress()."')");
    
        if( ! empty($fetch) ) {
            if($fetch['login_attempts'] >= $this->attempts_before_captcha_for_login) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Auth::changePassword()
     * 
     * @return
     */
    public function changePassword() {
        
        $success = true; // Initial value
        
        $initial = $_POST['initial'];
        $new = $_POST['new'];
        $new_confirm = $_POST['new_confirm'];
    
        if($initial != '' && $new != '' && $new_confirm != '') {
            
            // Check initial password
            $sql_login_check_query = "SELECT id FROM `".$this->conf['db']['prefix']."users` WHERE id='".$this->ses->get('user_id')."' && password='".$this->generatePasswordHash($initial)."'";
            $fetch_login = $this->db->getRow($sql_login_check_query);
        
            if( empty($fetch_login) ) {            
                $success = false;
                $message = $this->conf['msg']['error']['initial_wrong'];      
            }
            
            if($new != $new_confirm) {
                $success = false;
                $message = $this->conf['msg']['error']['confirm_not_match'];
            }
            
            if($success === true) {
                
                // Update the new password
                $update = $this->db->query("UPDATE `".$this->conf['db']['prefix']."users` SET password='".$this->generatePasswordHash($new)."' WHERE id='".$this->ses->get('user_id')."'");
                
                if($update) {
                    $message = $this->conf['msg']['success']['pass_changed'];
                }
            }
                 
        } else {
            $success = false;
            $message = $this->conf['msg']['error']['all_fields_must_fill'];    
        }
        
        // echo '<pre>'; print_r($this->conf); echo '</pre>';
        
		return array('success' => $success, 
			         'message' => $message);
    }
    
    /**
     * Auth::sendResetPasswordMail()
     * 
     * @return
     */
    public function sendResetPasswordMail() {
        
        $visitor_ip = ip2long($this->getRealIpAddress());
        $now = time();
        $timing = 3600;
        
        $email = $_POST['email'];
        
        $db_email = $this->db->getOne("SELECT email FROM `".$this->conf['db']['prefix']."users` WHERE email='".$email."'");
        
        if($db_email) {
            
            // Check if a request was already made for this user in the past hour
            $date_requested = $this->db->getOne("SELECT date_requested FROM `".$this->conf['db']['prefix']."users_keys` WHERE ip='".$visitor_ip."'");
            
            if( ($now - $date_requested) < $timing ) {
                
                return array('success' => false,
                             'message' => $this->conf['msg']['error']['too_many_ip_requests']);
            }
            
            $reset_key = $this->generatePasswordHash(uniqid());
            
            $user_id = $this->db->getOne("SELECT id FROM `".$this->conf['db']['prefix']."users` WHERE email='".$email."'");
            
            // Send Reset Mail
            $data = array(
                'user_id'        => $user_id,
                'reset_key'      => $reset_key,
                'ip'             => $visitor_ip,
                'date_requested' => $now
            );
            
            $this->db->query($this->db->prepareInsert($this->conf['db']['prefix'].'users_keys', $data));
            $reset_key_id = $this->db->insertId();
            
            $reset_password_url = $this->conf['url']['path_to_afp_admin'].'reset_password.php?id='.$reset_key_id.'&key='.$reset_key;
            
            $mail = $this->initMail();
            
            $mail->IsHTML(true);
            
            $mail->From = "no-reply@bitrepository.com";
            $mail->FromName = "AJAX Form Pro";
            $mail->AddAddress($db_email, "AJAX Form Pro");
            
            $mail->Subject = "Reset Password Request";
            
            $body = "Greetings,
            
            You have requested a new password for AJAX Form Pro [Administration Panel]. To complete your requested please use the following URL to get a new password:
            
            <a href='".$reset_password_url."'>".$reset_password_url."</a>
            
            Regards,
            EuRooms";

            $body_alt = preg_replace("/(\r\n|\n|\r)/", '', $body);
            $body_alt = preg_replace("=<br */?>=i", "\n", $body_alt);

            $mail->Body    = nl2br($body);
            $mail->AltBody = $body_alt;
            
            if( ! $mail->Send() ) {
                $success = false;
                $message = $this->conf['msg']['error']['mail_reset_pass_not_sent'];
            } else {
                $success = true;
                $message = $this->conf['msg']['success']['mail_reset_pass_sent'];
            }
        } else {
            $success = false;
            $message = $this->conf['msg']['error']['email_not_in_db'];
        }
            
        return array('success' => $success,
                     'message' => $message);
    }
    
    public function resetPassword($key_id, $key) {
        
        $data = $this->db->getRow("SELECT user_id, date_used FROM `".$this->conf['db']['prefix']."users_keys` WHERE id='".$key_id."' && reset_key='".$key."'");
        
        if( ! empty($data) ) {
            
            $user_id = $data['user_id'];
            $date_used = $data['date_used'];
            
            $visitor_ip = ip2long($this->getRealIpAddress());
            
            $now = time(); # Current UNIX Timestamp
            $timing = 3600; # 1 hour in seconds

            // Check if the reset password link was already used for this user in the past hour
            
            if( (($now - $date_used) < $timing) && $date_used > 0 ) {
                return array('success' => false,
                             'message' => $this->conf['msg']['error']['reset_pass_link_used']);
            }
            
            
            $new_password = $this->generateRandomPassword();
            $new_password_hash = $this->generatePasswordHash($new_password);
            
            $mail = $this->initMail();
            
            $mail->IsHTML(true);
            
            $mail->From = "no-reply@bitrepository.com";
            $mail->FromName = "AJAX Form Pro";
            
            $db_email = $this->db->getOne("SELECT email FROM `".$this->conf['db']['prefix']."users` WHERE id='".$user_id."'");
            
            $mail->AddAddress($db_email, "AJAX Form Pro");
            
            $mail->Subject = "New Password";
            
            $body = "Greetings,
            
            A new password was generated for you:
            
            -------------------
            <strong>".$new_password."</strong>
            -------------------
            
            LOGIN URL: <a href='".$this->conf['url']['path_to_afp_admin']."login.php'>".$this->conf['url']['path_to_afp_admin']."login.php</a>
            
            Regards,
            AJAX Form Pro";

            $body_alt = preg_replace("/(\r\n|\n|\r)/", '', $body);
            $body_alt = preg_replace("=<br */?>=i", "\n", $body_alt);

            $mail->Body    = nl2br($body);
            $mail->AltBody = $body_alt;
            
            if( ! $mail->Send() ) {
                $success = false;
                $message = $this->conf['msg']['error']['new_pass_mail_not_sent'];
            } else {
                
                // Update the password in the database
                $this->db->query("UPDATE `".$this->conf['db']['prefix']."users` SET password='".$new_password_hash."' WHERE id='".$user_id."'");                
                
                // Update the time when the reset password URL is used
                $this->db->query("UPDATE `".$this->conf['db']['prefix']."users_keys` SET date_used='".$now."' WHERE id='".$key_id."' && reset_key='".$key."'");
                
                $success = true;
                $message = $this->conf['msg']['success']['new_pass_mail_sent'];
            }            
            
        } else {
            $success = false;
            $message = $this->conf['msg']['error']['reset_url_incorrect'];            
        }
        
        return array('success' => $success,
                     'message' => $message);
            
    }
    
    /**
     * Auth::changeEmail()
     * 
     * @return
     */
    public function changeEmail() {
        
        $new = $_POST['new'];
        $confirm = $_POST['new_confirm'];
        
        if($new != $confirm) {            
            return array('success' => false, 'message' => $this->conf['msg']['error']['emails_do_not_match']);        
        }
        
        // Check if the new 'email' looks like a real email address
        if($new) {
            $regex = '/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i';
            $string = preg_replace($regex, '', $new);
    
            $is_valid = (empty($string)) ? true : false;
            
            if( ! $is_valid) { 
                return array('success' => false, 'message' => $this->conf['msg']['error']['email_not_valid']);
            }
        } else {
            return array('success' => false, 'message' => $this->conf['msg']['error']['email_is_empty']);
        }
        
        // check for dupe
        $row_id = $this->db->getOne("SELECT id FROM `".$this->conf['db']['prefix']."users` WHERE email='".$new."' && id != '".$this->ses->get('user_id')."'");
        
        if($row_id) {
            $success = false;
            $message = $this->conf['msg']['error']['email_dupe_in_db'];  
        } else {
            
            $update = $this->db->query("UPDATE `".$this->conf['db']['prefix']."users` SET email='".$new."' WHERE id='".$this->ses->get('user_id')."'");
            
            if($update) {
                $success = true;
                $message = $this->conf['msg']['success']['email_changed'];
            }
            
        }
        
        return array('success' => $success,
                     'message' => $message);        
        
    }

    /**
     * Auth::changeSecurityKey()
     * 
     * @return
     */
    public function changeSecurityKey() {
        
        if( ! is_writable($this->conf['afp_security_key_file']) ) {
            return false;                
        }        
        
        $new_key = $_POST['new_key'];
        $new_key = preg_replace('/\s+/', '', $new_key);
        
        if($new_key) {
            
            $new_key_length = strlen($new_key);
            
            if( ($new_key_length < 10) && ($new_key_length > 20) ) {
                return array('success' => false, 'message' => $this->conf['msg']['error']['security_key_wrong_length']);                 
            }
            
            $new_afp_security_key_file_contents = '<?php'."\n".'define(\'AFP_SECURITY_KEY\', \''.addslashes($new_key).'\');'."\n".'?>';
            
            $update = @file_put_contents($this->conf['afp_security_key_file'], $new_afp_security_key_file_contents);
            
            $pass_info = $this->db->getRow("SELECT id, default_value FROM `".$this->conf['db']['prefix']."config_names` WHERE field_name='smtp[password]'");
            
            $field_id     = $pass_info['id'];
            $default_pass = $pass_info['default_value'];
                    
            if($default_pass != '') {
                $new_default_value = $this->app->encrypt($new_key, $this->app->decrypt(AFP_SECURITY_KEY, $default_pass));
                $update = $this->db->query("UPDATE `".$this->conf['db']['prefix']."config_names` SET default_value='".$new_default_value."' WHERE id='".$field_id."'");
            }
            
            $all = $this->db->getAll("SELECT id, value FROM `".$this->conf['db']['prefix']."config_values` WHERE field_id='".$field_id."'");
            
            if( ! empty($all) ) {
                foreach($all as $valoare) {
                    if($valoare['value'] != '') {
                        $new_value = $this->app->encrypt($new_key, $this->app->decrypt(AFP_SECURITY_KEY, $valoare['value']));
                        $update = $this->db->query("UPDATE `".$this->conf['db']['prefix']."config_values` SET value='".$new_value."' WHERE id='".$valoare['id']."'");            
                    }
                }
            }
            
            if($update) {
                $success = true;
                $message = $this->conf['msg']['success']['security_key_file_updated'];
            } else {
                $success = false;
                $message = $this->conf['msg']['error']['security_key_file_not_updated'];                
            }
            
            return array('success' => $success, 'message' => $message);
            
        } 
    }
 
    /* Credits: http://roshanbh.com.np/2007/12/getting-real-ip-address-in-php.html */
    
    public function getRealIpAddress()
    {
       if (!empty($_SERVER['HTTP_CLIENT_IP'])) { // check ip from share internet
           $ip = $_SERVER['HTTP_CLIENT_IP'];
       } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { // to check ip is pass from proxy
           $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
       } else {
           $ip = $_SERVER['REMOTE_ADDR'];
       }
       return $ip;
    }

    /**
     * Auth::recordVisitorActivity()
     * 
     * @return
     */
    public function recordVisitorActivity() {
      
        $visitor_ip = $this->getRealIpAddress();
      
        $fetch = $this->db->getRow("SELECT id, login_attempts FROM `".$this->conf['db']['prefix']."visitors_activity` WHERE ip='".ip2long($visitor_ip)."'");
    
        //echo '<pre>'; print_r($fetch); echo '</pre>';
    
        if( ! empty($fetch) ) {
            
    	    $this->db->query("UPDATE `".$this->conf['db']['prefix']."visitors_activity` SET login_attempts = login_attempts + 1 WHERE ip='".ip2long($visitor_ip)."'");

    	    $login_attempts = $fetch['login_attempts'] + 1;
    
    	    if($login_attempts >= $this->max_login_attempts) {
    		    $this->db->query("UPDATE `".$this->conf['db']['prefix']."visitors_activity` SET banned='1' WHERE id='".$fetch['id']."'");
    		    return 'banned';
            }
    
            if( ($login_attempts >= $this->attempts_before_captcha_for_login) && ($login_attempts < $this->max_login_attempts) ) {
                return 'incorrect_enable_captcha';
            }
    
        } else {
            
            $data = array(
                'ip'             => ip2long($visitor_ip),
                'login_attempts' => 1,
                'banned'         => 0,
                'date_added'     => time()
            );
                
            $this->db->query( $this->db->prepareInsert($this->conf['db']['prefix'].'visitors_activity', $data) );
        }
    
        return false;
    }
    
    /**
     * Auth::redirect()
     * 
     * @param mixed $url
     * @return void
     */
    public function redirect($location) {
        
        if($location == 'login') {
            $location = $this->conf['url']['path_to_afp_admin'].'login.php?go_to='.urlencode($this->getCurrentURL());
        }
        
        header("Location: ".$location);
        exit;
    }
    
    /**
     * Auth::getCurrentPage()
     * 
     * @return
     */
    public function getCurrentPage() {
        return basename($_SERVER['PHP_SELF']);
    }
    
    /**
     * Auth::getCurrentURL()
     * 
     * @return
     */
    public function getCurrentURL() {
        return 'http'.( ($_SERVER['HTTPS'] == 'on') ? 's' : '' ).'://'.$_SERVER['HTTP_HOST'].'/'.$_SERVER['REQUEST_URI'];
    }    
}
?>