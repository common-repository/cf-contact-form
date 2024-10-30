<?php
/*
Plugin Name: CF Contact Form 
Plugin URI: https://wordpress.org/plugins/cf-contact-form
Description: Reach us by submitting the details through Contact Form
Version: 1.0
Author: Nishant Shah
Author URI: https://twowayresume.com/nishs/
License: GPL2

CF contact form is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Simple contact form is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with CF contact Form plugin. If not, see {License URI}.
*/
   
   
   function cf_contact_form() {
	   
	    
	   
	   echo '<form action = "" method = "post">';
	   echo '<div>';
	   echo 'Name *<br/>';
	   echo '<input type = "text" name = "cfname" >';
	   echo '</div>';
	   echo '<div>';
	   echo 'E-mail *<br/>';
	   echo '<input id = "cnfemail" type = "text" name = "cfemail" >';
	   	   
	   echo 'E-mail should be in format mail@example.com <br/>';
	   echo '</div>';
	   echo '<div>';
	   echo 'Subject *<br/>';
	   echo '<input type = "text" name = "cfsubject" >';
	   
	   
	   echo '</div>';
	   echo '<div>';
	   echo 'Message *<br/>';
	   echo '<textarea rows="6" cols="35" name = "cfmessage" ></textarea>';
	   
	    
	   echo '</div>';
	   echo '<br>';
	   echo '<div>';
	   echo '<input type = "submit" name = "cfsubmit" value = "Send" >';
	   
	   echo '<?php wp_nonce_field(); ?>';
	   
	   echo '</div>';
	   echo '</form>';
	     
	   
   }
   
	
    function cf_send_contact_form_email() {
		
		
		if ($_POST["cfsubmit"]) {
		
		   		
		
		$to = get_option( 'admin_email' );
		
		$name = sanitize_text_field($_POST["cfname"]);
			
		$email = sanitize_email($_POST["cfemail"]);
			
		$subject = sanitize_text_field($_POST["cfsubject"]);
		
		$message = esc_textarea($_POST["cfmessage"]);
		
		
		$headers = "Online Submission";
		
		if ( wp_verify_nonce($_POST['cfsubmit'])) {
			
		}
		else {
			
		}
			
		if (empty($name) || empty($email)){ 
				
			echo "<div>";
			echo "Fields with * are required";
			echo "</div>";
               

		} else {
			
		$msg = 'Name:' . $name . "\r\n" .
		       'Email:' . $email . "\r\n" . 
			   'Subject:' . $subject . "\r\n" .
			   'Message:' . $message . "\r\n" ;
			   
			
		
		$sent = wp_mail($to, $subject, strip_tags($msg), $headers);
		
		
		
          if ($sent) {
						
            echo "<div>";
			echo "Your message has been send successfully";
			echo "</div>";
		  }	
		  	else {
			  
		  echo "<div>";	  
          echo "Cannot send your message";
		  echo "</div>";
		  
		  }		  
		  
		}	
		
		
		}
		
	}
	
   
   
   function cf_contact_form_shortcode() {
	   
	   cf_contact_form();
	   
	   cf_send_contact_form_email();
	   
	   
   }
   
   add_shortcode('cfm_contact_form', 'cf_contact_form_shortcode');
   
      
   
?>