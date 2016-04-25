<?php
/*Controls custom field creation in the dashboard area*/
global $wpdb;
$textdomain = 'custom-registration-form-builder-with-submission-manager';
$crf_option=$wpdb->prefix."crf_option";
$path =  plugin_dir_url(__FILE__); 
include_once 'crf_functions.php';
if(isset($_REQUEST['saveoption']))
{
	$retrieved_nonce = $_REQUEST['_wpnonce'];
	if (!wp_verify_nonce($retrieved_nonce, 'save_crf_global_setting' ) ) die( 'Failed security check' );
	if(!isset($_REQUEST['enable_mailchimp'])) $_REQUEST['enable_mailchimp']='no';
	if(!isset($_REQUEST['enable_facebook'])) $_REQUEST['enable_facebook']='no';
	if(!isset($_REQUEST['enable_captcha'])) $_REQUEST['enable_captcha']='no';
	if(!isset($_REQUEST['enable_captcha'])) $_REQUEST['enable_captcha']='no';
	if(!isset($_REQUEST['autogenerate_pass'])) $_REQUEST['autogenerate_pass']='no';
	if(!isset($_REQUEST['user_auto_approval'])) $_REQUEST['user_auto_approval']='no';
	if(!isset($_REQUEST['admin_notification'])) $_REQUEST['admin_notification']='no';
	if(!isset($_REQUEST['send_password'])) $_REQUEST['send_password']='no';
	if(!isset($_REQUEST['userip'])) $_REQUEST['userip']='no';
	crf_add_option( 'enable_captcha', $_REQUEST['enable_captcha']);
	crf_add_option( 'public_key', $_REQUEST['publickey']);
	crf_add_option( 'private_key', $_REQUEST['privatekey']);
	crf_add_option( 'autogeneratedepass', $_REQUEST['autogenerate_pass']);
	crf_add_option( 'userautoapproval', $_REQUEST['user_auto_approval']);
	crf_add_option( 'adminnotification', $_REQUEST['admin_notification']);
	//echo implode(',',$_REQUEST['optionvalue']);die;
	crf_add_option( 'adminemail', rtrim(implode(',',$_REQUEST['optionvalue']),','));
	crf_add_option( 'from_email', $_REQUEST['from_email']);	
	crf_add_option( 'userip', $_REQUEST['userip']);	
	crf_add_option( 'crf_theme', $_REQUEST['crf_theme']);
	crf_add_option( 'enable_facebook', $_REQUEST['enable_facebook']);
	crf_add_option( 'facebook_app_id', $_REQUEST['facebook_app_id']);
	crf_add_option( 'facebook_app_secret', $_REQUEST['facebook_app_secret']);	
	crf_add_option( 'enable_mailchimp', $_REQUEST['enable_mailchimp']);
	crf_add_option( 'mailchimp_key', $_REQUEST['mailchimp_key']);
	crf_add_option( 'send_password', $_REQUEST['send_password']);
	
	if(isset($_POST['repeatedfilefield'])) $repeatfile ='yes'; else $repeatfile = 'no';
	update_option( 'ucf_allowfiletypes',$_POST['filetypes'] );	
	update_option( 'ucf_repeatfilefields',$repeatfile);		
}
$public_key = crf_get_global_option_value('public_key');
$private_key = crf_get_global_option_value('private_key');
$admin_email = crf_get_global_option_value('adminemail');
$from_email = crf_get_global_option_value('from_email');
$crf_theme = crf_get_global_option_value('crf_theme');
$facebook_app_id = crf_get_global_option_value('facebook_app_id');
$facebook_app_secret = crf_get_global_option_value('facebook_app_secret');
$mailchimp_key = crf_get_global_option_value('mailchimp_key');
?>
<div class="crf-main-form">
  <div class="crf-form-heading">
    <h1><?php _e( 'Global Settings', $textdomain ); ?></h1>
  </div>
  <form method="post">
  <div class="option-main crf-form-setting">
      <div class="user-group crf-form-left-area">
        <div class="crf-label">
          <?php _e( 'Form Theme:', $textdomain ); ?>
        </div>
      </div>
      <div class="user-group-option crf-form-right-area">
        <select name="crf_theme" id="crf_theme">
        <option value="classic" <?php if($crf_theme=='classic')echo 'selected';?>>Classic</option>
        <option value="default" <?php if($crf_theme=='default')echo 'selected';?>>Default</option>
        </select>
      </div>
    </div>
    
    <div class="option-main crf-form-setting">
      <div class="user-group crf-form-left-area">
        <div class="crf-label">
          <?php _e( 'Enable Recaptcha:', $textdomain ); ?>
        </div>
      </div>
      <div class="user-group-option crf-form-right-area">
        <input name="enable_captcha" id="enable_captcha" type="checkbox" class="upb_toggle" value="yes" <?php if (checkfieldname("enable_captcha","yes")==true){ echo "checked";}?> style="display:none;"/>
        <label for="enable_captcha"></label>
      </div>
    </div>
    <div class="option-main ">
      <div id="captcha_fun" <?php if (checkfieldname("enable_captcha","yes")==true){ echo 'style="display:block"';}else{echo 'style="display:none"';}?>>
        <div class="option-main crf-form-setting">
          <div class="user-group crf-form-left-area">
            <div class="crf-label">
              <?php _e( 'Site key:', $textdomain ); ?>
            </div>
          </div>
          <div class="user-group-option crf-form-right-area">
            <input type="text" name="publickey" id="publickey" value="<?php if(isset($public_key)) echo $public_key; ?>" />
          </div>
        </div>
        <div class="option-main crf-form-setting">
          <div class="user-group crf-form-left-area">
            <div class="crf-label">
              <?php _e( 'Secret Key:', $textdomain ); ?>
            </div>
          </div>
          <div class="user-group-option crf-form-right-area">
            <input type="text" name="privatekey" id="privatekey" value="<?php if(isset($private_key)) echo $private_key; ?>" />
          </div>
        </div>
      </div>
    </div>
    
    <div class="option-main crf-form-setting">
      <div class="user-group crf-form-left-area">
        <div class="crf-label">
          <?php _e( 'Enable Facebook Login:', $textdomain ); ?>
        </div>
      </div>
      <div class="user-group-option crf-form-right-area">
        <input name="enable_facebook" id="enable_facebook" type="checkbox" class="upb_toggle" value="yes" <?php if (checkfieldname("enable_facebook","yes")==true){ echo "checked";}?> style="display:none;"/>
        <label for="enable_facebook"></label>
      </div>
    </div>
      <div id="facebook_fun" <?php if (checkfieldname("enable_facebook","yes")==true){ echo 'style="display:block"';}else{echo 'style="display:none"';}?>>
        <div class="option-main crf-form-setting">
          <div class="user-group crf-form-left-area">
            <div class="crf-label">
              <?php _e( 'Facebook App Id:', $textdomain ); ?>
            </div>
          </div>
          <div class="user-group-option crf-form-right-area">
            <input type="text" name="facebook_app_id" id="facebook_app_id" value="<?php if(isset($facebook_app_id)) echo esc_attr($facebook_app_id); ?>" />
          </div>
        </div>
        <div class="option-main crf-form-setting">
          <div class="user-group crf-form-left-area">
            <div class="crf-label">
              <?php _e( 'Facebook App Secret:', $textdomain ); ?>
            </div>
          </div>
          <div class="user-group-option crf-form-right-area">
            <input type="text" name="facebook_app_secret" id="facebook_app_secret" value="<?php if(isset($facebook_app_secret)) echo esc_attr($facebook_app_secret); ?>" />
          </div>
        </div>
        </div>
        
    
    <div class="option-main crf-form-setting">
      <div class="user-group crf-form-left-area">
        <div class="crf-label">
          <?php _e( 'Enable MailChimp Integration:', $textdomain ); ?>
        </div>
      </div>
      <div class="user-group-option crf-form-right-area">
        <input name="enable_mailchimp" id="enable_mailchimp" type="checkbox" class="upb_toggle" value="yes" <?php if (checkfieldname("enable_mailchimp","yes")==true){ echo "checked";}?> style="display:none;"/>
        <label for="enable_mailchimp"></label>
      </div>
    </div>
    
    <div class="option-main ">
      <div id="mailchimp_fun" <?php if (checkfieldname("enable_mailchimp","yes")==true){ echo 'style="display:block"';}else{echo 'style="display:none"';}?>>
      
      <div class="option-main crf-form-setting">
          <div class="user-group crf-form-left-area">
            <div class="crf-label">
              <?php _e( 'Mailchimp API:', $textdomain ); ?>
            </div>
          </div>
          <div class="user-group-option crf-form-right-area">
            <input type="text" name="mailchimp_key" id="mailchimp_key" value="<?php if(isset($mailchimp_key)) echo $mailchimp_key; ?>" />
          </div>
        </div>
        
       
        
      </div>
    </div>
    
    
    <div class="option-main crf-form-setting">
      <div class="user-group crf-form-left-area">
        <div class="crf-label">
          <?php _e( 'Auto Generated Password:', $textdomain ); ?>
        </div>
      </div>
      <div class="user-group-option crf-form-right-area">
        <input name="autogenerate_pass" id="autogenerate_pass" type="checkbox" class="upb_toggle" value="yes" <?php if (checkfieldname("autogeneratedepass","yes")==true){ echo "checked";}?> style="display:none;" />
        <label for="autogenerate_pass"></label>
      </div>
    </div>
    
    <div class="option-main crf-form-setting">
      <div class="user-group crf-form-left-area">
        <div class="crf-label">
          <?php _e( 'Capture IP and Browser Info:', $textdomain ); ?>
        </div>
      </div>
      <div class="user-group-option crf-form-right-area">
        <input name="userip" id="userip" type="checkbox" class="upb_toggle" value="yes" <?php if (checkfieldname("userip","yes")==true){ echo "checked";}?> style="display:none;" />
        <label for="userip"></label>
      </div>
    </div>
    
    <div class="option-main crf-form-setting">
      <div class="user-group crf-form-left-area">
        <div class="crf-label">
          <?php _e( 'User Registration Auto approval:', $textdomain ); ?>
        </div>
      </div>
      <div class="user-group-option crf-form-right-area">
        <input name="user_auto_approval" id="user_auto_approval" type="checkbox" class="upb_toggle" value="yes" <?php if (checkfieldname("userautoapproval","yes")==true){ echo "checked";}?> style="display:none;"/>
        <label for="user_auto_approval"></label>
      </div>
    </div>
    
    <div class="option-main crf-form-setting">
      <div class="user-group crf-form-left-area">
        <div class="crf-label">
          <?php _e( 'Send Username and Password in Email:', $textdomain ); ?>
        </div>
      </div>
      <div class="user-group-option crf-form-right-area">
        <input name="send_password" id="send_password" type="checkbox" class="upb_toggle" value="yes" <?php if (checkfieldname("send_password","yes")==true){ echo "checked";}?> style="display:none;"/>
        <label for="send_password"></label>
      </div>
    </div>
    
    <div class="option-main crf-form-setting">
      <div class="user-group crf-form-left-area">
        <div class="crf-label">
          <?php _e( 'Email Notification:', $textdomain ); ?>
        </div>
      </div>
      <div class="user-group-option crf-form-right-area">
        <input name="admin_notification" id="admin_notification" type="checkbox" class="upb_toggle" value="yes" <?php if (checkfieldname("adminnotification","yes")==true){ echo "checked";}?> style="display:none;"/>
        <label for="admin_notification"></label>
      </div>
    </div>
         <div id="notification_fun" <?php if (checkfieldname("adminnotification","yes")==true){ echo 'style="display:block"';}else{echo 'style="display:none"';}?>>
    <div class="option-main crf-form-setting">
      <div class="user-group crf-form-left-area">
        <div class="crf-label">
          <?php _e( 'Email Address:', $textdomain ); ?>
        </div>
      </div>
      
      <div class="user-group-option crf-form-right-area" id="optionsfield2">
      <ul id="sortablefield" class="optionsfieldwrapper">
      <?php
	  $optionvalues = @explode(',',$admin_email);
	  foreach($optionvalues as $optionvalue)
	  {
		  ?>
          <li class="optioninputfield">
          <span class="handle"></span>
          	<input type="text" name="optionvalue[]" value="<?php if(!empty($optionvalue)) echo esc_attr($optionvalue); ?>"><span class="removefield" onClick="removefield(this)">Delete</span>
            
            </li>
          <?php
	  }
	  ?>
      </ul>
      <input type="text" value="" placeholder="Click to add another email address" maxlength="0" onClick="addoption()" onKeyUp="addoption()">
      </div>
      
      
      
    </div>
    </div>
    
    <div class="option-main crf-form-setting">
      <div class="user-group crf-form-left-area">
        <div class="crf-label">
          <?php _e( 'From Email Address:', $textdomain ); ?>
        </div>
      </div>
      <div class="user-group-option crf-form-right-area">
        <input type="text" name="from_email" id="from_email" value="<?php if(isset($from_email)) echo $from_email; ?>" />
      </div>
    </div>
    
    <div class="option-main crf-form-setting">
      <div class="user-group crf-form-left-area">
        <div class="crf-label">
          <?php _e( 'Define allowed file types (file extensions)', $textdomain ); ?>
          <small> <?php _e( '(Separate multiple values by “|”. For example PDF|JPEG|XLS)', $textdomain ); ?></small>
        </div>
      </div>
      <div class="user-group-option crf-form-right-area">
      <textarea name="filetypes" id="filetypes"><?php echo get_option('ucf_allowfiletypes','jpg|jpeg|png|gif|doc|pdf|docx|txt|psd'); ?></textarea>
      </div>
    </div>
    
    <div class="option-main crf-form-setting">
      <div class="user-group crf-form-left-area">
        <div class="crf-label">
          <?php _e( 'Use Repeated File fields:', $textdomain ); ?>
        </div>
      </div>
      <div class="user-group-option crf-form-right-area">
        <input name="repeatedfilefield" id="repeatedfilefield" type="checkbox" class="upb_toggle" value="yes" style="display:none;" <?php if(get_option('ucf_repeatfilefields')=='yes')echo 'checked'; ?> />
        <label for="repeatedfilefield"></label>
      </div>
    </div>
    
    <br>
    <br>
    <div class="crf-form-footer">
      <div class="crf-form-button">
      <?php wp_nonce_field('save_crf_global_setting'); ?>
        <input type="submit"  class="button-primary" value="<?php _e('Save',$textdomain);?>" name="saveoption" id="saveoption" />
        <a href="admin.php?page=crf_manage_forms" class="cancel_button"><?php _e('Cancel',$textdomain);?></a>
      </div>
    </div>
  </form>
</div>
