<?php
/**
 * Sessions
 * 
 * @package Eurooms
 * @author Gabriel Comarita
 * @copyright 2011
 * @version $Id$
 * @access public
 */
class Sessions {
    
    private $security_salt_key = ADMIN_SALT_KEY;
    
    /**
     * Sessions::start()
     * 
     * @return
     */
    public function start() {
        session_id();
        session_start(); // Start Session
        header('Cache-control: private'); // IE 6 FIX        
    }
    
    /**
     * Sessions::set()
     * 
     * @param mixed $name
     * @param mixed $value
     * @return
     */
    public function set($name, $value) {
        $_SESSION[$this->security_salt_key.$name] = $value;
    }
    
    /**
     * Sessions::get()
     * 
     * @param mixed $name
     * @param string $type
     * @return
     */
    public function get($name, $type = 's') {
        
        if($type == 's') {
            $result = $_SESSION[$this->security_salt_key.$name];
        }

        if($type == 'c') {
            $result = $_COOKIE[$this->security_salt_key.$name];
        }
        
        return $result;
    }
    
    /**
     * Sessions::delete()
     * 
     * @param mixed $name
     * @return
     */
    public function delete($name) {
        unset($_SESSION[$this->security_salt_key.$name]);
    }
    
    /**
     * Sessions::deleteAll()
     * 
     * @return
     */
    public function deleteAll() {
        
        // Unset all of the sessions
        $_SESSION = array();
        
        // If it's desired to remove the session, also delete the session cookie.
        // Note: This will remove the session, and not just the session data!
        
        if (ini_get("session.use_cookies")) {
            
            $params = session_get_cookie_params();
            
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        // Finally, destroy the session.
        session_destroy();        
    }
}
?>