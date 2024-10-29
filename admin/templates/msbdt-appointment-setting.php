<?php
/**
 * @package    admin
 * @subpackage admin/templates
 * @author     bdtask@gmail.com
 */
function msbdt_appointment_setting_form(){
 global $pagenow , $current_user ;
 if(($_REQUEST['page']==='msbdt_setting')&& ($pagenow == 'admin.php')){    
        settings_errors(); 
      $admin_custom_css = Msbdt_Custom_Admin_Style::msbdt_scheduler_admin_custom_css();
 /*/////////////////////////////////////////////////////////////////////////////////////////
                        Default Value Set for languages
////////////////////////////////////////////////////////////////////////////////////////////*/

        // The option already exists, so we just update it.
        // The option hasn't been added yet. We'll add it with $autoload set to 'no'.

         ( get_option( 'name_language' ) == false )? 
                  update_option( 'name_language', esc_html('Name','booking365') , null ,  'no' ) : '' ;
         
         ( get_option( 'email_language' ) == false )? 
                  update_option( 'email_language', esc_html('Email','booking365'), null ,  'no' ) : '' ;
         
         ( get_option( 'contact_language' ) == false )? 
                  update_option( 'contact_language', esc_html('Contact No','booking365'), null ,  'no' ) : '' ;
         
         ( get_option( 'category_language' ) == false )? 
                  update_option( 'category_language', esc_html('Category','booking365')  , null ,  'no' ) : '' ;

         ( get_option( 'service_language' ) == false )? 
                  update_option( 'service_language', esc_html('Location','booking365') , null ,  'no' ) : '' ;

         ( get_option( 'professional_language' ) == false )? 
                  update_option( 'professional_language', esc_html('Professional','booking365') , null ,  'no' ) : '' ;

         ( get_option( 'message_language' ) == false )? 
                  update_option( 'message_language', esc_html('Message','booking365') , null ,  'no' ) : '' ;

         ( get_option( 'frontend_button' ) == false )? 
                  update_option( 'frontend_button', esc_html('Appointment','booking365'), null ,  'no' ) : '' ;

/*/////////////////////////////////////////////////////////////////////////////////////////
                        Default Value Set for admin
////////////////////////////////////////////////////////////////////////////////////////////*/

         ( get_option( 'admin_pagination' ) == false )? 
                  update_option( 'admin_pagination', '5' , null ,  'no' ) : '' ; 
         ( get_option( 'admin_text_color' ) == false )? 
                  update_option( 'admin_text_color', esc_html('#000000','booking365') , null ,  'no' ) : '' ; 
         ( get_option( 'admin_edit_button_color' ) == false )? 
                  update_option( 'admin_edit_button_color', esc_html('#1e73be','booking365') , null ,  'no' ) : '' ;
         ( get_option( 'admin_delete_button_color' ) == false )? 
                  update_option( 'admin_delete_button_color', esc_html('#dd9933','booking365') , null ,  'no' ) : '' ;  
         ( get_option( 'admin_submit_button_color' ) == false )? 
                  update_option( 'admin_submit_button_color', esc_html('#1e73be','booking365') , null ,  'no' ) : '' ;
         ( get_option( 'admin_submit_button_text_color' ) == false )? 
                  update_option( 'admin_submit_button_text_color', esc_html('#ffffff','booking365') , null ,  'no' ) : '' ;  
         ( get_option( 'admin_fontfamily' ) == false )? 
                  update_option( 'admin_fontfamily', esc_html('arial','booking365') , null ,  'no' ) : '' ;
         ( get_option( 'admin_fontsize' ) == false )? 
                  update_option( 'admin_fontsize', esc_html('12','booking365') , null ,  'no' ) : '' ;
         ( get_option( 'admin_text_color_active_page' ) == false )? 
                  update_option( 'admin_text_color_active_page', '1' , null ,  'no' ) : '' ;


/*/////////////////////////////////////////////////////////////////////////////////////////
                        Default Value Set for frontend
////////////////////////////////////////////////////////////////////////////////////////////*/

         ( get_option( 'frontend_fontfamily' ) == false )? 
                  update_option( 'frontend_fontfamily', esc_html('arial','booking365') , null ,  'no' ) : '' ;
         ( get_option( 'frontend_fontsize' ) == false )? 
                  update_option( 'frontend_fontsize', esc_html('12','booking365') , null ,  'no' ) : '' ;
          // frontent default.
         ( get_option( 'text_color' ) == false )? 
                  update_option( 'text_color', esc_html('#000000','booking365') , null ,  'no' ) : '' ;
         ( get_option( 'submit_button_color' ) == false )? 
                  update_option( 'submit_button_color', esc_html('#2192dd','booking365') , null ,  'no' ) : '' ; 

         ( get_option( 'submit_button_border' ) == false )? 
                  update_option( 'submit_button_border', esc_html('#555','booking365') , null ,  'no' ) : '' ;

         ( get_option( 'error_message_color' ) == false )? 
                  update_option( 'error_message_color', esc_html('#dd3333','booking365') , null ,  'no' ) : '' ;  

/*/////////////////////////////////////////////////////////////////////////////////////////
                        Default Value Set for Status
////////////////////////////////////////////////////////////////////////////////////////////*/ 

         ( get_option( 'request_color' ) == false )? 
                  update_option( 'request_color', esc_html('#dd9933','booking365') , null ,  'no' ) : '' ;
         ( get_option( 'approve_color' ) == false )? 
                  update_option( 'approve_color', esc_html('#81d742','booking365') , null ,  'no' ) : '' ;
         ( get_option( 'reject_color' ) == false )? 
                  update_option( 'reject_color', esc_html('#dd3333','booking365') , null ,  'no' ) : '' ;
         ( get_option( 'avoilable_color' ) == false )? 
                  update_option( 'avoilable_color', esc_html('#36af48','booking365') , null ,  'no' ) : '' ;

/*/////////////////////////////////////////////////////////////////////////////////////////
                        Default Value Set for Status
////////////////////////////////////////////////////////////////////////////////////////////*/          
         ( get_option( 'calender_enable_color' ) == false )? 
                  update_option( 'calender_enable_color', esc_html('#81d742','booking365') , null ,  'no' ) : '' ;
         ( get_option( 'calender_active_color' ) == false )? 
                  update_option( 'calender_active_color', esc_html('#dd9933','booking365') , null ,  'no' ) : '' ;
         ( get_option( 'calender_day_text_color' ) == false )? 
                  update_option( 'calender_day_text_color', esc_html('#36af48','booking365') , null ,  'no' ) : '' ;
         ( get_option( 'calender_month_text_color' ) == false )? 
                  update_option( 'calender_month_text_color', esc_html('#2192dd','booking365') , null ,  'no' ) : '' ;
         ( get_option( 'calender_header_bg_color' ) == false )? 
                  update_option( 'calender_header_bg_color', esc_html('#91d631','booking365') , null ,  'no' ) : '' ;
         ( get_option( 'calender_border_color' ) == false )? 
                  update_option( 'calender_border_color', esc_html('#b0d330','booking365') , null ,  'no' ) : '' ;

/*/////////////////////////////////////////////////////////////////////////////////////////
                        Default Value Set for payment
////////////////////////////////////////////////////////////////////////////////////////////*/          
         ( get_option( 'local_language' ) == false )? 
                  update_option( 'local_language', esc_html('I will pay with local','booking365') , null ,  'no' ) : '' ;
         ( get_option( 'paypal_language' ) == false )? 
                  update_option( 'paypal_language', esc_html('I will pay with paypal','booking365') , null ,  'no' ) : '' ;
         ( get_option( 'card_language' ) == false )? 
                  update_option( 'card_language', esc_html('I will pay with card','booking365') , null ,  'no' ) : '' ;
        
      
/*//////////////////////////////////////////////////////////////////////////
                        Display Setting .
////////////////////////////////////////////////////////////////////////////*/          
?>
 <br />
 <div class = "multi-appointment container row" >
    <ul class="nav nav-tabs nav-pills ">
        <li class="active" ><a  href="#mas_language_setting" data-toggle="tab">
        <h5><?php esc_html_e('Language Setting','booking365') ;?></h5></a></li>
        <li><a href="#mas_color_setting" data-toggle="tab">
        <h5><?php esc_html_e('Status Setting','booking365') ;?></h5></a></li>
        <li><a href="#mas_calender_setting" data-toggle="tab">
        <h5><?php esc_html_e('Frontend Calender Setting','booking365') ;?></h5></a></li> 
        <li><a href="#mas_admin_setting" data-toggle="tab">
        <h5><?php esc_html_e('Admin Setting','booking365') ;?></h5></a></li>     
        <li><a href="#mas_orther_setting" data-toggle="tab">
        <h5><?php esc_html_e('Frontend Setting','booking365') ;?></h5></a></li>
        <li><a href="#mas_paypal_setting" data-toggle="tab">
        <h5><?php esc_html_e('Payment Setting','booking365') ;?></h5></a></li>
        <li><a href="#mas_sortcode" data-toggle="tab">
        <h5><?php esc_html_e('Shortcode','booking365') ;?></h5></a></li>                 
    </ul>
    <div class="col-sm-6" >            
         <div class="tab-content admin_custom_css">
            <div class="tab-pane active"  id="mas_language_setting" >  
             <?php
              echo '<form method="post" action="options.php" id="mas_language_setting">';                   
              settings_fields('mas-frontend-language-setting');                    
              do_settings_sections( 'mas_language_setting' );            
              submit_button();
              echo '</form>';
             ?>
            </div>
            <div class="tab-pane"  id="mas_color_setting" >  
             <?php
              echo '<form method="post" action="options.php" id="mas_color_setting">';                   
              settings_fields('mas-frontend-color-setting');                    
              do_settings_sections( 'mas_color_setting' );            
              submit_button();
              echo '</form>';
             ?>           
            </div>
             <div class="tab-pane"  id="mas_calender_setting" >  
            <?php
              echo '<form method="post" action="options.php" id="mas_calender_setting">';                   
              settings_fields('mas-calender-setting');                    
              do_settings_sections( 'mas_calender_setting' );            
              submit_button();
              echo '</form>';
             ?>
            </div> 
            <div class="tab-pane"  id="mas_admin_setting" >  
            <?php
              echo '<form method="post" action="options.php" id="mas_admin_setting">';                   
              settings_fields('mas_admin_setting');                    
              do_settings_sections( 'mas_admin_section' );            
              submit_button();
              echo '</form>';
             ?>
            </div>
             <div class="tab-pane"  id="mas_paypal_setting" >  
            <?php
              echo '<form method="post" action="options.php" id="mas_paypal_setting">';                 
              settings_fields('mas-paypal-setting');                    
              do_settings_sections( 'mas_paypal_setting' );            
              submit_button();
              echo '</form>';
             ?>
            </div>


            <div class="tab-pane"  id="mas_orther_setting" >  
             <?php
              echo '<form method="post" action="options.php" id="mas_orther_setting">';                   
              settings_fields('mas-frontend-setting');                    
              do_settings_sections( 'mas_frontend_setting' );            
              submit_button();
              echo '</form>';
             ?>            
            </div>
          
             <div class="tab-pane"  id="mas_sortcode" >  
             <?php
               if( get_option('frontend_name') !== '' && 
                   get_option('frontend_email') !== '' && 
                   get_option('frontend_contact') !== '' && 
                   get_option('frontend_location') !== '' && 
                   get_option('frontend_professional') !== '' && 
                   get_option('frontend_message') !== '' && 
                   get_option('frontend_error_message') !== '' && 
                   get_option('frontend_button') !== '') :
                
                     echo '<div class="multi-appointment row" >';
                     echo '<div class="col-sm-12" >';
                     ?>
                    <h4> <?php echo esc_html('Shortcode : [mas_bdtask]','booking365');?>
                      
                    </h4> 
                     <h5><?php echo esc_html('Please copy the shortcode and paste in the page or post to display the appointment form .','booking365');?>
                     </h5> 
                     <?php 
                     echo '</div>';
                     echo '</div>';

                    else:
                        echo esc_html('<h3>Please fillup mendatory field .</h3>','booking365') ;
                    endif ;

             ?>            
            </div> 
         </div><!-- .tab-content -->  
    </div><!-- .col-sm -->  
</div><!-- .multi-appointment .container .row-->  
<?php
        
    }else{
        wp_die();
    }

}