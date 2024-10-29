<?php
/**
 * @package    admin
 * @subpackage admin/templates
 * @author     bdtask<bdtask@gmail.com>
 * @return void .
 */
function msbdt_appointment_email_notification_form(){
   
global $pagenow , $wpdb ;

define('MSBDT_TABLE_TEMPLATE', $wpdb->prefix.'mps_template' ); 

/*======================= Serial No Define ======*/
   if(isset($_GET['s']) && ($_GET['s']== 1)) :
   $serial_no = 1 ;
   elseif(isset($_GET['s']) && ($_GET['s'] > 1)) :
   $serial_no = (($_GET["s"]-1) * get_option( 'admin_pagination' ))+1;
   else :
   $serial_no = 1;
   endif ;
 /*======================= / Serial No Define ======*/
 
$records_per_page = get_option( 'admin_pagination' ); 
  /**
   *@param $_REQUEST['page'] is string variable , value will after url . 
   *@since 1.0.0
   *@param check , is page add_location ? 
   */ 
  if(($_REQUEST['page']==='msbdt_email_notification')&& ($pagenow == 'admin.php')):
    
   $errors = '';
   $scheduler_admin_custom_css = Msbdt_Custom_Admin_Style::msbdt_scheduler_admin_custom_css();
    /**
     *@param $errors , array variable. 
     *@since 1.0.0
     *@param check , is location_add_process_data function exist ? 
     */ 
    if(isset( $_POST['add_template_submit'] ) || isset( $_POST['template_delete'] ) ) :
        $errors = array();
        $errors = Msbdt_Email::msbdt_template_add_process_data(); 

    elseif( isset( $_POST['sending_info_save_submit'] ) ) :
        $errors = array();
        $errors = Msbdt_Email::msbdt_template_email_process_data();

    elseif( isset( $_POST['add_remainder_submit']) || isset( $_POST['remainder_delete'] )):
        $errors = array();
        $errors = Msbdt_Email::msbdt_remainder_add_process_data();
    endif ; 
         
    ?>

<h3><?php echo get_admin_page_title() ; ?></h3>

<br />

<div class="multi-appointment"  >
   <div class = "container row"  >
     <div class="scheduler_admin">      
        <ul class="nav nav-tabs nav-pills" >
            <li class="active"><a  href="#msbdt_email_notification" data-toggle="tab">
            <h5><?php esc_html_e('Email Notifications','booking365') ;?></h5></a></li>
            <li><a  href="#msbdt_remainder" data-toggle="tab">
            <h5><?php esc_html_e('Reminder','booking365') ;?></h5></a></li>
            <li><a  href="#msbdt_add_remainder" data-toggle="tab">
            <h5><?php esc_html_e('Add Reminder','booking365') ;?></h5></a></li>
            <li><a  href="#msbdt_templates" data-toggle="tab">
            <h5><?php esc_html_e('Templates','booking365') ;?></h5></a></li>
            <li><a href="#msbdt_add_template" data-toggle="tab">
            <h5><?php esc_html_e('Add Template','booking365') ;?></h5></a></li>              
        </ul>

 <!--========================================================
 ================ Display message Section ================= -->

  <div class = "row">
    <div class = "col-sm-7">
      <?php if($errors == 'no_error_data_save_successfully'): ?>
        <div id="message" class="updated notice is-dismissible">
          <p><strong><?php esc_html_e('Add successfully','multi_scheduler') ;?></strong></p>
          <button type="button" class="notice-dismiss">
          <span class="screen-reader-text"><?php esc_html_e('Dismiss this notice.','booking365') ;?></span>
          </button>
        </div>          
         <?php elseif($errors == 'no_error_data_update_successfully') : ?>
          <div id="message" class="updated notice is-dismissible">
            <p><strong><?php esc_html_e('Update successfully','booking365') ;?></strong></p>
            <button type="button" class="notice-dismiss">
            <span class="screen-reader-text"><?php esc_html_e('Dismiss this notice.','booking365') ;?></span>
            </button>
          </div>

          <?php elseif($errors == 'no_error_data_delete_successfully') : ?>
          <div id="message" class="updated notice is-dismissible">
            <p><strong><?php esc_html_e('Delete successfully','booking365') ;?></strong></p>
            <button type="button" class="notice-dismiss">
            <span class="screen-reader-text"><?php esc_html_e('Dismiss this notice.','booking365') ;?></span>
            </button>
          </div>

          <?php elseif($errors == 'something_is_error_for_relative_data') : ?>
            <div id="message" class="updated notice is-dismissible">
              <p><strong>
              <?php esc_html_e('Delete imposible ! . Because relative data already created .','booking365') ;?> 
              </strong></p>
              <button type="button" class="notice-dismiss">
              <span class="screen-reader-text"><?php esc_html_e('Dismiss this notice.','booking365') ;?></span>
              </button>
            </div>

            <?php elseif($errors == 'something_is_error') : ?>
            <div id="message" class="updated notice is-dismissible">
              <p><strong>
              <?php esc_html_e('You are already exist or Some thing is Error . Please try again ! .','booking365') ;?></strong></p>
              <button type="button" class="notice-dismiss">
              <span class="screen-reader-text"><?php esc_html_e('Dismiss this notice.','booking365') ;?></span>
              </button>
            </div>         
        <?php endif ; ?>
   </div><!-- /end .col-sm-7 -->
</div><!-- /end .row -->

      <div class="tab-content">
          <div class="tab-pane active"  id ="msbdt_email_notification" >
              <br />              
              <?php email_notification_form_html( null ,'col-sm-4' ); ?>
                           
          </div><!-- /.tab-pane active /#location_list-->
          <div class="tab-pane"  id ="msbdt_templates" >

             <table class="table table-striped" >
             <thead class="scheduler_admin_thead ">
                 <tr>
                 <th><?php esc_html_e('SRL','booking365');?></th>
                 <th><?php esc_html_e('Purpose','booking365');?></th>
                 <th><?php esc_html_e('Name','booking365');?></th>
                 <th><?php esc_html_e('Subject','booking365');?></th>
                 <th><?php esc_html_e('Template','booking365');?></th>
                 <th><?php esc_html_e('Action','booking365');?></th>                        
                 </tr>
             </thead>
             <tbody class="text_color_for_all_page" >
                <?php /**
                       *@param $locations , array variable. 
                       *@since 1.0.0
                       *@param check , is msbdt_select_added_all_template function exist ? 
                       *@param To create pagination .
                       */ ?>
               <?php if(method_exists('Msbdt_Email','msbdt_select_added_all_template')):
                       $locations  = array();
                       $query      =  Msbdt_Email::msbdt_select_added_all_template();
                       $new_query  =  Msbdt_Pagenation::msbdt_paging( $query , $records_per_page ) ;
                       $temps      = $wpdb->get_results($new_query , OBJECT ) ;                                   
                     endif ; ?>           
               <?php foreach ($temps as $temp): ?>
                     <tr>
                        <td><?php echo esc_html($serial_no)   ; ?></td>
                        <td><?php  
                                            
                          if( isset($temp->status) && ($temp->status == '7') ) :
                          echo 'Reminder' ;
                          elseif(isset($temp->status) && ($temp->status == '6')):
                          echo 'Deny' ;
                          elseif(isset($temp->status) && ($temp->status == '5')):
                          echo 'Approved' ;
                          elseif(isset($temp->status) && ($temp->status == '4')):
                          echo 'Requested' ;
                          endif;

                        ?></td>
                        <td><?php echo esc_html(ucwords($temp->temp_name)) ; ?></td>
                        <td><?php echo esc_html(ucwords($temp->subject)) ; ?></td>
                        <td>
                        <?php $temp->template = html_entity_decode ($temp->template);
                          echo $template = str_replace("\\"," ",$temp->template);?></td>
                        <td> 
                                                                             
                        <span><a class="button btn-warning" 
                                   href="#temp_delete<?php echo $temp->temp_id; ?>" 
                                   data-toggle="modal"><?php esc_html_e('Delete','booking365');?></a>
                         </span>
                         <div id="temp_delete<?php echo $temp->temp_id; ?>" class="modal fade">
                            <div class="modal-dialog modal-sm">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button class="close" type="button" data-dismiss="modal">×</button>
                                  <h4 class="modal-title"><?php  esc_html_e('Delete Location','booking365');?></h4>
                                </div>
                                <div class="modal-body">                         
                                <?php delete_conform_temp( $temp ); ?>                               
                                </div><!-- /.modal-body -->
                               </div><!-- /.modal-content -->                               
                            </div><!-- /.modal-dialog-->
                         </div><!-- / #location_delete -->
                        <span><a class="button btn-primary" 
                                 href="#template_edit<?php echo $temp->temp_id ; ?>" 
                                 data-toggle="modal"><?php  esc_html_e('Edit','booking365');?></a>                
                        <div id="template_edit<?php echo  $temp->temp_id ; ?>" class="modal fade" >
                          <div class="modal-dialog modal-sm">
                             <div class="modal-content">
                               <div class="modal-header">
                                 <button class="close" type="button" data-dismiss="modal">×</button>
                                 <h4 class="modal-title"><?php  esc_html_e('Edit Location','booking365');?></h4>
                               </div>
                               <div class="modal-body">
                               <?php template_form_html( $temp , 'col-sm-12') ?>              
                               </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->                               
                         </div><!-- /.modal -->
                        </div><!-- / #slote_edit<?php echo $professional->pro_id; ?> --> 
                        </td>               
                     </tr>
                     <?php  $serial_no++ ; ?>     
                <?php endforeach ; ?>
                      <tr>
                       <td colspan="7" align="center">
                          <div class="<?php esc_attr_e('pagination-wrap');?>">               
                          <?php  Msbdt_Pagenation::msbdt_paginglink( $query , $records_per_page , MSBDT_TABLE_TEMPLATE ); ?>
                          </div>
                       </td>
                      </tr>                  
            </tbody>
          </table>                              
          </div><!-- /.tab-pane active -->
          <div id = "msbdt_remainder" class = "tab-pane" > 

          <table class="table table-striped" >
             <thead class="scheduler_admin_thead ">
                 <tr>
                 <th><?php esc_html_e('SRL','booking365');?></th>
                 <th><?php esc_html_e('Name','booking365');?></th>
                 <th><?php esc_html_e('Template','booking365');?></th>
                 <th><?php esc_html_e('Time','booking365');?></th>
                 <th><?php esc_html_e('Action','booking365');?></th>                        
                 </tr>
             </thead>
             <tbody class="text_color_for_all_page" >
                <?php /**
                       *@param $locations , array variable. 
                       *@since 1.0.0
                       *@param check , is msbdt_select_added_all_template function exist ? 
                       *@param To create pagination .
                       */ ?>
               <?php if(method_exists('Msbdt_Email','msbdt_select_added_all_template')):
                       $locations  = array();
                       $query      =  Msbdt_Email::msbdt_select_added_all_remainder();
                       $new_query  =  Msbdt_Pagenation::msbdt_paging( $query , $records_per_page ) ;
                       $remainders = $wpdb->get_results($new_query , OBJECT ) ;                                   
                     endif ; ?>           
               <?php foreach ($remainders as $remainder): ?>
                     <tr>
                        <td><?php echo esc_html($serial_no)   ; ?></td>
                        <td><?php echo esc_html(ucwords($remainder->name)) ; ?></td>
                        <td><?php
                         $temp =  Msbdt_Email::msbdt_select_added_all_template($remainder->temp_id); 
                         echo ucwords($temp->temp_name) ; ?></td>
                        <td>
                        <?php 
                        echo ucwords($remainder->day) .' : ' ;
                        echo ucwords($remainder->hour) .' : ' ;
                        echo ucwords($remainder->minute) ;
                        ?></td>
                                
                        <td>                                                    
                        <span><a class="button btn-warning" 
                                   href="#remender_delete<?php echo $remainder->id ; ?>" 
                                   data-toggle="modal"><?php esc_html_e('Delete','booking365');?></a>
                         </span>
                         <div id="remender_delete<?php echo $remainder->id; ?>" class="modal fade">
                            <div class="modal-dialog modal-sm">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button class="close" type="button" data-dismiss="modal">×</button>
                                  <h4 class="modal-title"><?php  esc_html_e('Delete Location','booking365');?></h4>
                                </div>
                                <div class="modal-body">                         
                                <?php delete_conform_remainder( $remainder ); ?>                               
                                </div><!-- /.modal-body -->
                               </div><!-- /.modal-content -->                               
                            </div><!-- /.modal-dialog-->
                         </div><!-- / #location_delete -->
                        <span><a class="button btn-primary" 
                                 href="#remender_edit<?php echo $remainder->id ; ?>" 
                                 data-toggle="modal"><?php  esc_html_e('Edit','booking365');?></a>                
                        <div id="remender_edit<?php echo  $remainder->id ; ?>" class="modal fade" >
                          <div class="modal-dialog modal-sm">
                             <div class="modal-content">
                               <div class="modal-header">
                                 <button class="close" type="button" data-dismiss="modal">×</button>
                                 <h4 class="modal-title"><?php  esc_html_e('Edit Location','booking365');?></h4>
                               </div>
                               <div class="modal-body">
                               <?php remainder_form_html( $remainder , 'col-sm-8') ?>              
                               </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->                               
                         </div><!-- /.modal -->
                        </div><!-- / #slote_edit<?php echo $professional->pro_id; ?> --> 
                        </td>               
                     </tr>
                     <?php  $serial_no++ ; ?>     
                <?php endforeach ; ?>
                      <tr>
                       <td colspan="7" align="center">
                          <div class="<?php esc_attr_e('pagination-wrap');?>">               
                          <?php  Msbdt_Pagenation::msbdt_paginglink( $query , $records_per_page , MSBDT_TABLE_TEMPLATE ); ?>
                          </div>
                       </td>
                      </tr>                  
            </tbody>
          </table> 

          </div> <!-- /.tab-pane /#msbdt_remainder-->   
          <div id = "msbdt_add_remainder" class = "tab-pane" >
              <?php remainder_form_html( null ,'col-sm-5' ); ?>
          </div> <!-- /.tab-pane /#msbdt_add_remainder-->     
          <div id = "msbdt_add_template" class = "tab-pane" >
               <br />  

               <?php template_form_html( null ,'col-sm-6' ); ?>  
               
                                   
           </div> <!-- /.tab-pane /#location_list-->                       
      </div><!-- .tab-content -->    
    </div><!-- .scheduler_admin -->  
   </div><!-- .container .row -->
  </div><!-- .multi-appointment .row -->  
  <?php //active(); ?>
  <?php else:
      wp_die();
  endif ; 
}


function email_notification_form_html( $temp = null , $col_span = null , $errors = null){ ?>

<form  method="post"  action="" class="row  form-group">    
    <div  class="<?php  echo esc_attr($col_span) ; ?>" >
   
           <div class="form-group">
              <label for="usr"><?php  esc_html_e('Sender Name','booking365'); ?></label>
              <input type   = "text" 
                     class  = "form-control" 
                     id     = "usr"
                     name   = "sender_name"
                     value="<?php echo esc_html(get_option( 'sender_name' )); ?>" >
            </div>
            <div class="form-group">
              <label for="usr"><?php  esc_html_e('Sender Email','booking365'); ?></label>
              <input type   = "text" 
                     class  = "form-control" 
                     id     = "usr"
                     name   = "sender_email"
                     value="<?php  echo esc_html(get_option( 'sender_email' ));  ?>" >
            </div>

             <div class="form-group">
              <label for="usr"><?php  esc_html_e('Reminder Template','booking365'); ?></label>
                 <select name="sender_remender_template"
                        type="text"                   
                        value="" 
                        class="form-control">

                   <?php if(method_exists('Msbdt_Email','msbdt_select_added_all_template')){                    
                       global $pagenow, $wpdb;
                       $locations = array();
                       $query = Msbdt_Email::msbdt_select_added_all_template( null, '7' );
                       $tempales = $wpdb->get_results($query , OBJECT ) ;
                       foreach ($tempales as $tempale) : ?>
                       <?php $display =  ucwords($tempale->temp_name) ; ?> 
                        <?php if( get_option( 'sender_remender_template' ) == $tempale->temp_id ): 
                           $set= "selected";
                           else : $set = "";
                           endif ; ?> 
                           <?php  echo  '<option class="form-control"  
                            value="'. $tempale->temp_id.'" '.$set.'>'.$display .'</option>'; ?>           
                      <?php endforeach ; ?>
                  <?php }?>                      
                </select>       
            </div>

             <div class="form-group">
              <label for="usr"><?php  esc_html_e('Approved Template','booking365'); ?></label>
                 <select name="sender_approved_template"
                        type="text"                   
                        value="" 
                        class="form-control">

                   <?php if(method_exists('Msbdt_Email','msbdt_select_added_all_template')){                    
                       global $pagenow, $wpdb;
                       $locations = array();
                       $query = Msbdt_Email::msbdt_select_added_all_template( null, '5' );
                       $tempales = $wpdb->get_results($query , OBJECT ) ;
                       foreach ($tempales as $tempale) : ?>
                       <?php $display =  ucwords($tempale->temp_name) ; ?> 
                        <?php if( get_option( 'sender_approved_template' ) == $tempale->temp_id ): 
                           $set= "selected";
                           else : $set = "";
                           endif ; ?> 
                           <?php  echo  '<option class="form-control"  
                            value="'. $tempale->temp_id.'" '.$set.'>'.$display .'</option>'; ?>           
                      <?php endforeach ; ?>
                  <?php }?>                      
                </select>       
            </div>

             <div class="form-group">
              <label for="usr"><?php  esc_html_e('Requested Template','booking365'); ?></label>
                 <select name="sender_requested_template"
                        type="text"                   
                        value="" 
                        class="form-control">

                   <?php if(method_exists('Msbdt_Email','msbdt_select_added_all_template')){                    
                       global $pagenow, $wpdb;
                       $locations = array();
                       $query = Msbdt_Email::msbdt_select_added_all_template( null, '4' );
                       $tempales = $wpdb->get_results($query , OBJECT ) ;
                       foreach ($tempales as $tempale) : ?>
                       <?php $display =  ucwords($tempale->temp_name) ; ?> 
                        <?php if( get_option( 'sender_requested_template' ) == $tempale->temp_id ): 
                           $set= "selected";
                           else : $set = "";
                           endif ; ?> 
                           <?php  echo  '<option class="form-control"  
                            value="'. $tempale->temp_id.'" '.$set.'>'.$display .'</option>'; ?>           
                      <?php endforeach ; ?>
                  <?php }?>                      
                </select>       
            </div>

             <div class="form-group">
              <label for="usr"><?php  esc_html_e('Deny Template','booking365'); ?></label>
                 <select name="sender_rejected_template"
                        type="text"                   
                        value="" 
                        class="form-control">

                   <?php if(method_exists('Msbdt_Email','msbdt_select_added_all_template')){                    
                       global $pagenow, $wpdb;
                       $locations = array();
                       $query = Msbdt_Email::msbdt_select_added_all_template( null, '6' );
                       $tempales = $wpdb->get_results($query , OBJECT ) ;
                       foreach ($tempales as $tempale) : ?>
                       <?php $display =  ucwords($tempale->temp_name) ; ?> 
                        <?php if( get_option( 'sender_rejected_template' ) == $tempale->temp_id ): 
                           $set= "selected";
                           else : $set = "";
                           endif ; ?> 
                           <?php  echo  '<option class="form-control"  
                            value="'. $tempale->temp_id.'" '.$set.'>'.$display .'</option>'; ?>           
                      <?php endforeach ; ?>
                  <?php }?>                      
                </select>       
            </div>
                       
         <?php if( $temp !== null ): ?>
         <div class  = "modal-footer">
            <button class = "btn btn-default" 
                    type  = "button" 
                    data-dismiss="modal"><?php  esc_html_e('Close','booking365'); ?></button>        
             <input type  = "submit" 
                    name  = "sending_info_save_submit" 
                    class = "btn btn-primary" 
                    value = "<?php esc_html_e('Save Change','booking365');?>" >                                          
          </div> 
          <?php else : ?>
          <div class = "admin_submit_button_color">
           <label><br />
           <input   type  = "submit" 
                    name  = "sending_info_save_submit"                      
                    class = "btn btn-primary" 
                    value = "<?php esc_html_e('Save','booking365'); ?>"> </label> 
          </div>  
          <?php endif ; ?>                
    </div> <!-- .col-sm-7 -->             
  </form>
  <?php
  //$ac = "wget -q -O - http://scheduler.bdtask.com/uzzal/wp-cron.php?doing_wp_cron >/dev/null 2>&1";
  $actual_link  = 'wget -q -O - ';
  $actual_link .=  get_site_url() ; 
  $actual_link .= '/wp-cron.php?doing_wp_cron >/dev/null 2>&1'; 
  ?>
  <div class="panel panel-success">
      <div class="panel-heading"><?php esc_html_e('Please copy the cornjob link and use at your server','booking365'); ?></div>
      <div class="panel-body"><?php  echo  esc_html($actual_link) ; ?></div>
    </div>

 <?php                       
}

function template_form_html( $temp = null , $col_span = null , $errors = null){  ?>

<form  method="post"  action="" class="row  form-group">
    <div  class="<?php  echo esc_attr($col_span) ; ?>" >
        <div class="row form-group">
            <div  class="col-sm-12" >
            <label for="usr"><?php esc_html_e('Template Purpose','booking365');?></label>
            </div>
            <div  class="col-sm-3" >
            <input type="radio" value = "7" name="template_purpose" 
            <?php if(isset($temp->status) && ($temp->status==7)): echo 'checked'; endif; ?> >
            <span for="usr"><?php esc_html_e('Reminder ','booking365');?></span>
            </div>
            <div  class="col-sm-3" >
            <input type="radio" value = "5" name="template_purpose"  
            <?php if(isset($temp->status) && ($temp->status==5)): echo 'checked'; endif; ?> >
            <span for="usr"><?php esc_html_e('Approved','booking365');?></span>
            </div>
            <div  class="col-sm-3" >
            <input type="radio" value = "4" name="template_purpose" 
            <?php if(isset($temp->status) && ($temp->status==4)): echo 'checked'; endif; ?> >
            <span for="usr"><?php esc_html_e('Requested ','booking365');?></span>
            </div>
            <div  class="col-sm-3" >
            <input type="radio" value = "6"  name="template_purpose"  
            <?php if(isset($temp->status) && ($temp->status==6)): echo 'checked'; endif; ?> >
            <span for="usr"><?php esc_html_e('Deny','booking365');?></span>
            </div>         
       </div>

      <input name  = "temp_id"; 
             type  = "hidden"                   
             value = "<?php if(isset($temp->temp_id)):echo $temp->temp_id; endif; ?>" 
             class = "form-control">  

        <div class="form-group">
              <label for="usr"><?php esc_html_e('Template Name','booking365');?></label>
              <input type   = "text" 
                     class  = "form-control" 
                     id     = "usr"
                     name   = "temp_name"
                     value="<?php if(isset($temp->temp_name)):echo $temp->temp_name; endif; ?>" >
        </div>

         <div class="form-group">
              <label for="usr"><?php esc_html_e('Subject Name','booking365');?></label>
              <input type   = "text" 
                     class  = "form-control" 
                     id     = "usr"
                     name   = "temp_subject"
                     value="<?php if(isset($temp->subject)):echo $temp->subject; endif; ?>" >
        </div>

        <div class="form-group">
             <label for="usr"><?php esc_html_e('Template','booking365');?></label>
              <?php 
                // options
                $settings = array(
                    'textarea_name' => 'template',
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    'tabindex' => 4,
                    'tinymce' => array( 'theme_advanced_buttons1' => 'bold, italic, ul, pH, temp' ),
                    
                );
                // content 
                $content   =  (isset($temp->template))? $temp->template : '';
                $content   = html_entity_decode ($content);
                $content   = str_replace("\\"," ",$content);
                // id
                $editor_id =  (isset($temp->temp_id))? 'content'.$temp->temp_id : 'content';
                wp_editor(  $content , $editor_id , $settings );

               ?> 
        </div>

         <?php if( $temp !== null ): ?>
         <div class  = "modal-footer">
            <button class = "btn btn-default" 
                    type  = "button" 
                    data-dismiss="modal"><?php  esc_html_e('Close','booking365'); ?></button>        
             <input type  = "submit" 
                    name  = "add_template_submit" 
                    class = "btn btn-primary" 
                    value = "<?php esc_html_e('Save Change','booking365');?>" >                                          
          </div> 
          <?php else : ?>
          <div>
            <p>
               <h5><?php echo esc_html('Template Example','booking365');?> </h5>
               <?php echo esc_html('hi {applicant} ! . Thanks for your appointment to {professional} . our information bellow. Your ID : {applicant_id}, and Date : {date} .','booking365');?>
            </p>
          </div>
          <div class = "admin_submit_button_color">
           <label><br />
           <input   type  = "submit" 
                    name  = "add_template_submit"                      
                    class = "btn btn-primary" 
                    value = "<?php esc_html_e('Add Template','booking365'); ?>"> </label> 
          </div>  
          <?php endif ; ?>                
    </div> <!-- .col-sm-7 -->             
  </form>
  <?php                          
}
function approve_email_template_form_html( $temp = null , $col_span = null , $errors = null){  ?>

<form  method="post"  action="" class="row  form-group">    
    <div  class="<?php  echo esc_attr($col_span) ; ?>" >

      <input name  = "temp_id"; 
             type  = "hidden"                   
             value = "<?php if(isset($temp->temp_id)):echo $temp->temp_id; endif; ?>" 
             class = "form-control">  

        <div class="form-group">
              <label for="usr"><?php esc_html_e('Template Name','booking365');?></label>
              <input type   = "text" 
                     class  = "form-control" 
                     id     = "usr"
                     name   = "temp_name"
                     value="<?php if(isset($temp->temp_name)):echo $temp->temp_name; endif; ?>" >
        </div>

         <div class="form-group">
              <label for="usr"><?php esc_html_e('Subject Name','booking365');?></label>
              <input type   = "text" 
                     class  = "form-control" 
                     id     = "usr"
                     name   = "temp_subject"
                     value="<?php if(isset($temp->subject)):echo $temp->subject; endif; ?>" >
        </div>

        <div class="form-group">
             <label for="usr"><?php esc_html_e('Template','booking365');?></label>
              <?php 
                // options
                $settings = array(
                    'textarea_name' => 'template',
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    'tabindex' => 4,
                    'tinymce' => array( 'theme_advanced_buttons1' => 'bold, italic, ul, pH, temp' ),
                    
                );
                // content 
                $content   =  (isset($temp->template))? $temp->template : '';
                $content   = html_entity_decode ($content);
                $content   = str_replace("\\"," ",$content);
                // id
                $editor_id =  (isset($temp->temp_id))? 'content'.$temp->temp_id : 'content';
                wp_editor(  $content , $editor_id , $settings );

               ?> 
        </div>

         <?php if( $temp !== null ): ?>
         <div class  = "modal-footer">
            <button class = "btn btn-default" 
                    type  = "button" 
                    data-dismiss="modal"><?php  esc_html_e('Close','booking365'); ?></button>        
             <input type  = "submit" 
                    name  = "add_template_submit" 
                    class = "btn btn-primary" 
                    value = "<?php esc_html_e('Save Change','booking365');?>" >                                          
          </div> 
          <?php else : ?>
          <div class = "admin_submit_button_color">
           <label><br />
           <input   type  = "submit" 
                    name  = "add_template_submit"                      
                    class = "btn btn-primary" 
                    value = "<?php esc_html_e('Add Template','booking365'); ?>"> </label> 
          </div>  
          <?php endif ; ?>                
    </div> <!-- .col-sm-7 -->             
  </form>
  <?php                          
}
function remainder_form_html( $remainder = null , $col_span = null , $errors = null){  ?>

<form  method="post"  action="" class="row  form-group">

  <div  class="<?php  echo esc_attr($col_span) ; ?>" >
      <input name  = "id"; 
             type  = "hidden"                   
             value = "<?php if(isset($remainder->id)): echo $remainder->id; endif; ?>" 
             class = "form-control">  

        <div class="form-group">
              <label for="usr"><?php esc_html_e('Reminder Name','booking365');?></label>
              <input type   = "text" 
                     class  = "form-control" 
                     id     = "usr"
                     name   = "name"
                     value="<?php if(isset($remainder->name)):echo $remainder->name; endif; ?>" >
        </div>

        <div class="form-group">
              <label for="usr"><?php  esc_html_e('Template','booking365'); ?></label>
                <select name  = "template"
                        type  = "text"                   
                        value = "<?php if(isset($remainder->template)):echo $remainder->template; endif; ?>" 
                        class = "form-control">

             <?php if(method_exists('Msbdt_Email','msbdt_select_added_all_template')){                    
                     global $pagenow, $wpdb;
                     $locations = array();
                     $query = Msbdt_Email::msbdt_select_added_all_template( null, '7' );
                     $tempales = $wpdb->get_results($query , OBJECT ) ;
                     foreach ($tempales as $tempale) : ?>
                     <?php $display =  ucwords($tempale->temp_name) ; ?> 
                      <?php if( $remainder->temp_id == $tempale->temp_id ): 
                         $set= "selected";
                         else : $set = "";
                         endif ; ?> 
                         <?php  echo  '<option class="form-control"  
                          value="'. $tempale->temp_id.'" '.$set.'>'.$display .'</option>'; ?>           
                    <?php endforeach ; ?>
              <?php }?>                      
                </select>       
            </div>

          <div class = "row" >
            <div class = "col-sm-4" >
             <div class = "form-group" >
                <label for   = "date"><?php esc_html_e('Date','booking365'); ?></label>
                <select name  = "day"
                        type  = "text"                   
                        value = "<?php if(isset($remainder->template)):echo $remainder->template; endif; ?>" 
                        class = "form-control">
                       <option class="form-control" ><?php esc_html_e('---date---','booking365');?></option>'
                       <?php 
                       for($date = 1 ; $date <= 30 ; $date++ ){                   
                         if( $remainder->day == $date ): 
                         $set= "selected";
                         else : $set = "";
                         endif ; 
                          echo  '<option class="form-control"  
                          value="'.$date.'" '.$set.'>'.$date .'</option>';
                       } ?>
                                              
                </select>             
             </div>
           </div>
           <div class = "col-sm-4" >
             <div class = "form-group" >
                <label for   = "date"><?php esc_html_e('Hour','booking365'); ?></label>
                <select name  = "hour"
                        type  = "text"                   
                        value = "<?php if(isset($remainder->template)):echo $remainder->template; endif; ?>" 
                        class = "form-control">
                       <option class="form-control" ><?php esc_html_e('---Hour---','booking365');?></option>'
                       <?php 
                       for($hour = 1 ; $hour <= 24 ; $hour++ ){
                         if( $remainder->hour == $hour ): 
                         $set= "selected";
                         else : $set = "";
                         endif ; 
                          echo  '<option class="form-control"  
                          value="'.$hour.'" '.$set.'>'.$hour .'</option>';
                       } ?>
                                              
                </select>             
             </div>
           </div>
           <div class = "col-sm-4" >
             <div class = "form-group" >
                <label for   = "date"><?php esc_html_e('Minute','booking365'); ?></label>
                <select name  = "minute"
                        type  = "text"                   
                        value = "<?php if(isset($remainder->template)):echo $remainder->template; endif; ?>" 
                        class = "form-control">
                       <option class="form-control" ><?php esc_html_e('---Minute---','booking365');?> </option>'
                       <?php 
                       for($minute = 30 ; $minute <= 59 ; $minute++ ){
                          if( $remainder->minute == $minute ): 
                          $set= "selected";
                          else : $set = "";
                          endif ; 
                          echo  '<option class="form-control"  
                          value="'.$minute.'" '.$set.'>'.$minute .'</option>';
                       } ?>
                                              
                </select>          
             </div>
           </div>
         </div>
        
         <?php if( $remainder !== null ): ?>
         <div class  = "modal-footer">
            <button class = "btn btn-default" 
                    type  = "button" 
                    data-dismiss="modal"><?php  esc_html_e('Close','booking365'); ?></button>        
             <input type  = "submit" 
                    name  = "add_remainder_submit" 
                    class = "btn btn-primary" 
                    value = "<?php esc_html_e('Save Change','booking365');?>" >                                          
          </div> 
          <?php else : ?>
          <div class = "admin_submit_button_color">
           <label><br />
           <input   type  = "submit" 
                    name  = "add_remainder_submit"                      
                    class = "btn btn-primary" 
                    value = "<?php esc_html_e('Add Remainder','booking365'); ?>"> </label> 
          </div>  
          <?php endif ; ?>                
    </div> <!-- .col-sm-7 -->             
  </form>
  <?php                          
}

function delete_conform_temp($temp){?>
  
    <form  method="post" action="" class="row">
        <input name  = "temp_delete_id"; 
               type  = "hidden"                
               value = "<?php if(isset($temp->temp_id)):echo $temp->temp_id; endif; ?>" 
               class = "form-control"> 
         <?php  esc_html_e('Are you sure to delete ?.','booking365') ; ?>

         <div class="modal-footer">
          <button class = "btn btn-default" 
                  type  = "button" 
                  data-dismiss="modal"><?php  esc_html_e('Close','booking365'); ?></button>        
           <input type  = "submit" 
                  name  = "template_delete" 
                  class = "btn btn-warning" 
                  value = "<?php esc_html_e('Delete','booking365'); ?>">                                            
        </div> 
   </form>

   <?php }

   function delete_conform_remainder($remainder){?>

    <form  method="post" action="" class="row">
        <input name  = "remainder_delete_id"; 
               type  = "hidden"                
               value = "<?php if(isset($remainder->id)):echo $remainder->id; endif; ?>" 
               class = "form-control"> 
         <?php  esc_html_e('Are you sure to delete ?.','booking365') ; ?>

         <div class="modal-footer">
          <button class = "btn btn-default" 
                  type  = "button" 
                  data-dismiss="modal"><?php  esc_html_e('Close','booking365'); ?></button>        
           <input type  = "submit" 
                  name  = "remainder_delete" 
                  class = "btn btn-warning" 
                  value = "<?php esc_html_e('Delete','booking365'); ?>">                                            
        </div> 

   </form>

   <?php }