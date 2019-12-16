<?php
    $code = array();
    
        if($method == 'iframe') {
            
            foreach($forms as $form_id) {
            
                list($name, $description) = $form->getInfo($form_id);
        
                $iframe_src = $conf['url']['path_to_afp'].'ajax-form-app/standalone/generate.php?form_id='.$form_id;
        
                $code[] = array(
                    'form_id' => $form_id,
                    'name'    => $name,
                    'code'    => htmlspecialchars('<!-- [START] '.$name.' -->'."\n".'<iframe scrolling="no" style="border:none; overflow:auto;" id="afp'.$form_id.'_afp_frame" src="'.$iframe_src.'" width="100%" height="100%"><p>Your browser does not support iframes.</p></iframe>'."\n".'<!-- [END] '.$name.' -->')
                );
            }
        
        } else if($method == 'copy_php_code') {
               
           /* (Basic) Web Page - CODE */
           if($integration_type == 'web_page') {
               
               $type_title = '(Basic) Web Page';   
               
                $code_1 = 
                '&lt;?php'."\n".'$get_form_info = 1;'."\n\n".'$forms = array('.implode(',', $forms).');'."\n\n".
                                
                'include &#39;[PATH_TO_AJAX_FORM_PRO]/ajax-form-app/common.php&#39;;'."\n".
                                
                '?&gt;';
           
        
                $code_2 = '&lt;?php'."\n".'$afp-&gt;Init();'."\n".'?&gt;';
           
                $code_3 = array();

                foreach($forms as $form_id) {
            
                    $f_info = $form->getFormData($form_id);

                    $title = $f_info['title'];
                    $area_width = $f_info['area_width'];
           
                    $code_3_html = htmlspecialchars('<!-- [START] '.$title.' -->')."\n".'&lt;div style=&quot;width:'.$area_width.';&quot;&gt;'."\n".
                    	'  &lt;div id=&quot;afp'.$form_id.'_wrap&quot;&gt;'."\n";

                    $code_3_html .=  '  &lt;h1 style=&quot;height:48px; margin: 0; padding: 16px 0 0 59px; background: url(&#39;&lt;?php echo $afp_conf[&#39;url&#39;][&#39;path_to_images&#39;]; ?&gt;icon-mail.png&#39;) no-repeat scroll -5px 44% transparent;&quot;&gt;'.$title.'&lt;/h1&gt;'."\n";
                      
                    $code_3_html .= '    &lt;?php'.
                    	"\n".'    /*'."\n".
                    	'    -----------------------'."\n".
                    	'    Include the AJAX Form'."\n".
                    	'    -----------------------'."\n".
                    	'    */'."\n".
                    	'    $afp-&gt;ShowForm('.$form_id.');'."\n".
                    	'    ?&gt;'."\n".
                    
                    	'  &lt;/div&gt;'."\n".
                    '&lt;/div&gt;'."\n".htmlspecialchars('<!-- [END] '.$title.' -->');
 
                    $code_3[] = array(
                        'form_id' => $form_id,
                        'name'    => $title,
                        'code'    => $code_3_html
                    );
                }
            /* 
            --------------------
            Lightbox - CODE 
            --------------------
            */
            
            } else if($integration_type == 'lightbox') {
                
                $type_title = 'Lightbox';
        
                $code_1 = 
                '&lt;?php'."\n".'$get_form_info = 1;'."\n\n".'$forms = array('.implode(',', $forms).');'."\n\n".
                                
                'include &#39;[PATH_TO_AJAX_FORM_PRO]/ajax-form-app/common.php&#39;;'."\n\n".
                                
                '$afp->mLightbox = 1;'."\n". 
                                
                '?&gt;';
            
                $code_2 = '&lt;?php'."\n".'$afp-&gt;Init();'."\n".'?&gt;';
            
                $code_3 = array();
            
                foreach($forms as $form_id) {
                    
                    $f_info = $form->getFormData($form_id);

                    $title = $f_info['title'];
					$area_width = $f_info['area_width'];
                    
                    # Code 3
                    
                    $code_3_html = htmlspecialchars('<button class=\'afp_lightbox afp'.$form_id.'\' style=\'padding:10px;\'>'.$title.'</button>');
                    
                    $code_3[] = array(
                        'name' => $title,
                        'code' => $code_3_html
                    );
                    
                    # Code 4
                    
                    $code_4_html = htmlspecialchars('<!-- [START] '.$title.' -->')."\n".'&lt;div style=&quot;display:none; width:'.$area_width.';&quot;&gt;'."\n".
                    	'  &lt;div id=&quot;afp'.$form_id.'_wrap&quot;&gt;'."\n";

                    $code_4_html .=  '  &lt;h1 style=&quot;height:48px; margin: 0; padding: 16px 0 0 59px; background: url(&#39;&lt;?php echo $afp_conf[&#39;url&#39;][&#39;path_to_images&#39;]; ?&gt;icon-mail.png&#39;) no-repeat scroll -5px 44% transparent;&quot;&gt;'.$title.'&lt;/h1&gt;'."\n";
                      
                    $code_4_html .= '    &lt;?php'.
                    	"\n".'    /*'."\n".
                    	'    -----------------------'."\n".
                    	'    Include the AJAX Form'."\n".
                    	'    -----------------------'."\n".
                    	'    */'."\n".
                    	'    $afp-&gt;ShowForm('.$form_id.');'."\n".
                    	'    ?&gt;'."\n".
                    
                    	'  &lt;/div&gt;'."\n".
                    '&lt;/div&gt;'."\n".htmlspecialchars('<!-- [END] '.$title.' -->');
                    
                    $code_4[] = array(
                        'name' => $title,
                        'code' => $code_4_html
                    );
                    
                }
            }  
        }
    ?>

    <div style="width:100%; clear:both;">
        <div style="float: left;"><h2>Multiple Forms</h2><h3><?php echo $type_title; ?></h3></div>
        
        
        <div style="float: right; margin:12px 0 0 0;"><strong><a href="<?php echo $conf['url']['path_to_afp_admin']; ?>manage_forms.php">&laquo; Back to forms' list</a></strong></div>
        <div style="clear: both;"></div>
    </div>
    

<?php
if($integration_type == 'lightbox') {
?>
    <div class="desc">
        Having trouble integrating PHP code into your website? Use the following link to see these Lightbox Forms in action and get the HTML source code from there.
        
        <p><a target="_blank" href="<?php echo $afp_conf['url']['path_to_script']; ?>standalone/pages/lightbox.php?forms=<?php echo implode(',', $forms); ?>">&gt;&gt; See it in action</a></p>
        
    </div>
<?php
}
?>
    
    
    <div style="background-color: #f2faf2; padding:10px; border:1px solid green;">
 
    <?php    
    if($method == 'iframe') {
    ?>
        <p style="line-height: 20px; margin: 0 0 15px;">Copy &amp; Paste the following blocks of codes where you want to have the forms loaded. This can be integrated easily in any platform (such as Wordpress, Drupal, Joomla etc.) or .HTML page.</p>
        
        <?php foreach($code as $value) {
            
            $form_id = $value['form_id'];
        ?>
        
            <iframe id="load_afp_page_afp<?php echo $form_id; ?>" scrolling="no" style="border:none; overflow:auto; width:1px; height:1px;" src="<?php echo $afp_conf['url']['path_to_script']; ?>standalone/generate.php?form_id=<?php echo $form_id; ?>" width="1" height="1"><p>Your browser does not support iframes.</p></iframe>
        
            <div style="margin:9px 0;">
            <p><strong><?php echo $value['name']; ?></strong></p>
            
            <div>
            <textarea id="block_code_afp<?php echo $form_id; ?>" style="padding:5px;" rows="4" cols="10"><?php echo $value['code']; ?></textarea>
                <div style="margin: 10px 0 0 0; float: right;">
                    <button class="fancy-button-base light copy_to_clipboard">Copy to Clipboard</button>
                </div>
                <div class="clear"></div>
            </div>
            
            </div>  
              
        <?php
        }
        ?>
        
        <div style="clear: both;"></div>
        
        <?php
        
    } else if($method == 'copy_php_code') { 
    
        if($integration_type == 'web_page') {
        ?>
    
            <p style="line-height: 20px; margin: 0 0 15px;"><div class="step">1</div> Copy &amp; Paste the following block of code at the very beginning of your .PHP file.</p>
            
            <div class="warning">Update [PATH_TO_AJAX_FORM_PRO] with the path to 'ajax-form-pro' (or any - chosen - custom name) folder!</div>
            
            <div>
            <textarea rows="7"><?php echo $code_1; ?></textarea>
                <div style="margin: 10px 0 0 0; float: right;">
                    <button class="fancy-button-base light copy_to_clipboard">Copy to Clipboard</button>
                </div>
                <div class="clear"></div>
            </div>  
    
            <p style="line-height: 20px; margin: 0 0 15px;"><div class="step">2</div> Copy &amp; Paste the following block of code between the <strong>&lt;head&gt;</strong> and <strong>&lt;/head&gt;</strong> tags of your page.</p>
            <div>
            <textarea rows="3"><?php echo $code_2; ?></textarea>
                <div style="margin: 10px 0 0 0; float: right;">
                    <button class="fancy-button-base light copy_to_clipboard">Copy to Clipboard</button>
                </div>
                <div class="clear"></div>
            </div> 
    
            <p style="line-height: 20px; margin: 0 0 15px;"><div class="step">3</div> Copy &amp; Paste the following blocks of codes where you want the forms to be shown (between the <strong>&lt;body&gt;</strong> and <strong>&lt;/body&gt;</strong> tags of your page)</p>
            
            <?php
            foreach($code_3 as $value) {
            ?>
            
            <p><em>for</em> <strong><?php echo $value['name']; ?></strong></p>

            <div>
            <textarea rows="16"><?php echo $value['code']; ?></textarea>
                <div style="margin: 10px 0 0 0; float: right;">
                    <button class="fancy-button-base light copy_to_clipboard">Copy to Clipboard</button>
                </div>
                <div class="clear"></div>
            </div>

        <?php 
            }
        } else if($integration_type == 'lightbox') {
        ?>
        
            <p style="line-height: 20px; margin: 0 0 15px;"><div class="step">1</div> Copy &amp; Paste the following block of code at the very beginning of your .PHP file.</p>
            
            <div class="warning">Update [PATH_TO_AJAX_FORM_PRO] with the path to 'ajax-form-pro' (or any - chosen - custom name) folder!</div>
            
            <div>
            <textarea rows="9"><?php echo $code_1; ?></textarea>
                <div style="margin: 10px 0 0 0; float: right;">
                    <button class="fancy-button-base light copy_to_clipboard">Copy to Clipboard</button>
                </div>
                <div class="clear"></div>
            </div>  
                
            <p style="line-height: 20px; margin: 0 0 15px;"><div class="step">2</div> Copy &amp; Paste the following block of code between the <strong>&lt;head&gt;</strong> and <strong>&lt;/head&gt;</strong> tags of your page.</p>
            
            
            <div>
                <textarea rows="3"><?php echo $code_2; ?></textarea>
                <div style="margin: 10px 0 0 0; float: right;">
                    <button class="fancy-button-base light copy_to_clipboard">Copy to Clipboard</button>
                </div>
                <div class="clear"></div>
            </div>  
                
            <p style="line-height: 20px; margin: 0 0 15px;"><div class="step">3</div> When they are pressed the following buttons call the Lightbox for the requested form. You can put them anywhere you want in the page. You can also use links (instead of buttons) if you wish. Make sure they have the <strong>class</strong> attribute equal with <code>"afp_lightbox afp[FORM_ID]"</code>.</p>

            <?php foreach($code_3 as $value) { ?>
                <p><em>for</em> <strong><?php echo $value['name']; ?></strong></p>
            
            <div>
                <textarea rows="1"><?php echo $value['code']; ?></textarea>
                <div style="margin: 10px 0 0 0; float: right;">
                    <button class="fancy-button-base light copy_to_clipboard">Copy to Clipboard</button>
                </div>
                <div class="clear"></div>
            </div>  
                            
            <?php } ?>
    
            <p style="line-height: 20px; margin: 0 0 15px;"><div class="step">4</div> Copy &amp; Paste the following blocks of codes just before the <strong>&lt;/body&gt;</strong> tag of your page</p>
            <?php foreach($code_4 as $value) { ?>
                <p><em>for</em> <strong><?php echo $value['name']; ?></strong></p>
            <div>
                <textarea rows="17"><?php echo $value['code']; ?></textarea>

                <div style="margin: 10px 0 0 0; float: right;">
                    <button class="fancy-button-base light copy_to_clipboard">Copy to Clipboard</button>
                </div>
                <div class="clear"></div>
            </div>  
            <?php } ?>
          
        
        <?php
        }        
    }
    ?>
    </div>
    