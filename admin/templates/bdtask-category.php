<?php global $category ; ?>
</br>
<div class = "multi-appointment row" > 
   <div class="scheduler_admin">
         <ul class="nav nav-tabs nav-pills" >
            <li class="active"  >
            <a  href="#category" data-toggle="tab">
            <h5><?php esc_html_e('Category','booking365') ;?></h5></a></li>
            <li><a href="#add_category" data-toggle="tab">
            <h5><?php esc_html_e('Add category','booking365') ;?></h5></a></li>              
        </ul>

   <?php 
if(isset($_POST['cat_submit'])):
      $category = Msbdt_Categorys::msbdt_process_category_data(); 
      if( isset($category['action_status']) ):?> 

  <div class = "row">
    <div class = "col-sm-7">
      <?php if($category['action_status'] == 'no_error_data_save_successfully'): ?>
        <div id="message" class="updated notice is-dismissible">
          <p><strong><?php esc_html_e('Add successfully','booking365') ;?></strong></p>
          <button type="button" class="notice-dismiss">
          <span class="screen-reader-text"><?php esc_html_e('Dismiss this notice.','booking365') ;?></span>
          </button>
        </div>          

        <?php elseif($category['action_status'] == 'something_is_error') : ?>
        <div id="message" class="updated notice is-dismissible">
          <p><strong>
          <?php esc_html_e('You are already exist or Some thing is Error . Please try again ! .','booking365') ;?></strong></p>
          <button type="button" class="notice-dismiss">
          <span class="screen-reader-text"><?php esc_html_e('Dismiss this notice.','booking365') ;?></span>
          </button>
        </div>         
     <?php endif ; ?>
   </div><!-- end .col-sm-7 -->
 </div><!-- end .row -->
 <?php endif; ?>
<?php endif ; ?>



<?php
 if(isset($_POST['cat_submit_for_change'])):
      $category = Msbdt_Categorys::msbdt_process_category_update_data(); 
      if( isset($category['action_status']) ):?> 

  <div class = "row">
    <div class = "col-sm-7">
      <?php if($category['action_status'] == 'no_error_data_update_successfully'): ?>
            <div id="message" class="updated notice is-dismissible">
              <p><strong><?php esc_html_e(' Update successful','booking365') ;?></strong></p>
              <button type="button" class="notice-dismiss">
              <span class="screen-reader-text"><?php esc_html_e('Dismiss this notice.','booking365') ;?></span>
              </button>
            </div>         
         <?php endif ; ?>
   </div><!-- end .col-sm-7 -->
 </div><!-- end .row -->
 <?php endif; ?>
<?php endif ; ?>


<?php
 if(isset($_POST['cat_submit_for_delete'])):
      $category = Msbdt_Categorys::msbdt_process_category_delete_data(); 
      if( isset($category['action_status']) ):?> 

  <div class = "row">
    <div class = "col-sm-7">
      <?php if($category['action_status'] == 'delete_successfully'): ?>
            <div id="message" class="updated notice is-dismissible">
              <p><strong><?php esc_html_e('Delete successful','booking365') ;?></strong></p>
              <button type="button" class="notice-dismiss">
                <span class="screen-reader-text">
              <?php esc_html_e('Dismiss this notice.','booking365') ;?></span>
              </button>
            </div>         
         <?php endif ; ?>
   </div><!-- end .col-sm-7 -->
 </div><!-- end .row -->
 <?php endif; ?>
<?php endif ; ?>

      </br>
        <div class="tab-content scheduler_admin">
          <div class="tab-pane active "  
                id ="category" >        
                <table class="table table-bordered textColorForAllPage" 
                        id = "dataTableForService">
                  <thead>
                    <tr>
                      <th><?php esc_html_e('SRL','booking365') ;?></th>
                      <th><?php esc_html_e('Name','booking365') ;?></th>
                      <th><?php esc_html_e('Action','booking365') ;?></th>
                    </tr>
                  </thead>
                  <tbody> 
                        <?php 
                        if(method_exists('Msbdt_Categorys','msbdt_process_category_select_data')) :
                        global $wpdb ;
                        $category = Msbdt_Categorys::msbdt_process_category_select_data();    
                        $categories = $wpdb->get_results( $category['query']['select_all'], OBJECT ) ;
                        endif ; ?> 
                        <?php  $serial_no = 1  ; ?>  
                        <?php foreach ($categories as $cat): ?>
                       <tr>           
                          <td><?php echo esc_html($serial_no); ?></td>
                          <td><?php echo esc_html(ucwords($cat->cat_name)) ; ?></td>
                          <td>                                                                      
                        <span>
                          <a class="button btn-warning" 
                                href="#delete<?php echo $cat->cat_id ; ?>" 
                                data-toggle="modal"><?php  esc_html_e( 'Delete','booking365' );?>
                          </a>
                        </span>                        
                        <div id="delete<?php echo $cat->cat_id;?>" 
                             class="modal fade">                               
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button class="close" type="button" data-dismiss="modal">×</button>
                                      <h4 class="modal-title"><?php  esc_html_e('Delete Category','booking365');?>
                                      </h4>
                                   </div>
                                    <div class="modal-body">                             
                                        <?php msbdt_delete_category_form($cat); ?>     
                                    </div>
                                </div>                  
                             </div>
                        </div>
                        <span><a   class="button btn-primary" 
                           href="#edit<?php echo $cat->cat_id; ?>" 
                           data-toggle="modal"><?php echo esc_html('Edit','booking365');?></a>
                        </span>
                        <div id="edit<?php echo $cat->cat_id; ?>" 
                                 class="modal fade" >                               
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                   <div class="modal-header">
                                     <button class="close" type="button" data-dismiss="modal">×</button>
                                      <h4 class="modal-title"><?php esc_html_e('Edit Category','booking365');?>
                                      </h4>
                                    </div>
                                    <div class="modal-body">
                                    <?php msbdt_edit_category_form($cat); ?>     
                                    </div>
                                </div>                        
                            </div>
                        </div>
                        </td>               
                      </tr>
                       <?php $serial_no++ ?>
                      <?php endforeach ;?>
                  </tbody>
                </table>
              <script type="text/javascript">

                jQuery("#dataTableForService").DataTable({ 
                  dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp", 
                       "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]], 
                          
                  buttons: [ 
                            {extend: 'copy', className: 'btn-sm'},

                            {
                              extend: 'csv', 
                              title: 'ExampleFile',
                              className: 'btn-sm',
                              exportOptions: {columns:[0,1], modifier: {page: 'current'} }
                            },

                            {
                            extend: 'excel', 
                            title: 'ExampleFile',
                            className: 'btn-sm',
                            exportOptions: {columns:[0,1],modifier: {page: 'current'} }

                            }, 

                            {
                            extend: 'pdf', 
                            title: 'ExampleFile',
                            className: 'btn-sm',
                            exportOptions: { columns:[0,1],modifier: {page: 'current'} }
                            },

                           {
                            extend: 'print', className: 'btn-sm',
                            exportOptions: { columns:[0,1], modifier: { page: 'current'}}
                           } 
                     ] });
              </script>
              <style type="text/css">
                  #wpbody-content { 
                    width: 98% !important;
                }
              </style>
         </div><!-- / .tab-pane / #category-->
         <div class="tab-pane"  
                id ="add_category" > 
            <?php msbdt_add_category_form('4') ; ?>                    
         </div><!-- / .tab-pane / #add_category-->
      </div><!-- / .tab-content -->
   </div><!-- / .scheduler_admin -->
</div><!-- / .multi-appointment -->

<?php $scheduler_admin_custom_css = Msbdt_Custom_Admin_Style::msbdt_scheduler_admin_custom_css(); ?>

<?php 

function msbdt_add_category_form($col_label){?>

<form  method = "post" 
       action = "" 
       class  = "row">
  
    <div class = "col-sm-4 form-group">                  
       <label for = "cat_name"><?php esc_html_e('Category Name','booking365'); ?></label>
       <input name = "cat_name";
              type = "text" 
                id = "cat_name"                     
             value = "<?php if(isset($pro->fname)):echo $pro->fname; endif; ?>" 
             class = "form-control">    
    </div>                       
     <div class = "col-sm-12 form-group admin_submit_button_color">      
        <input  type = "submit" 
                name = "cat_submit" 
                id   = "" 
                class= "btn btn-primary" 
                value= "<?php echo esc_attr('Add Category','booking365'); ?>">      
        
     </div>
    </form>
<?php
}

function msbdt_edit_category_form($cat){?>

<form  method = "post" 
       action = "" 
       class  = "row">

    <div class = "col-sm-4 form-group">                  
       <input name = "cat_id"; 
              type = "hidden" 
                id = "cat_name"                     
             value = "<?php if(isset($cat->cat_id)):echo $cat->cat_id; endif; ?>" 
             class = "form-control">    
    </div>      
  
    <div class = "col-sm-4 form-group">                  
       <label for = "cat_name"><?php esc_html_e('Category Name','booking365'); ?></label>
       <input name = "cat_name"; 
              type = "text" 
                id = "cat_name"                     
             value = "<?php if(isset($cat->cat_name)):echo $cat->cat_name; endif; ?>" 
             class = "form-control">    
    </div>                       
     <div class = "col-sm-12 form-group admin_submit_button_color">      
        <input  type = "submit" 
                name = "cat_submit_for_change" 
                id   = "" 
                class= "btn btn-primary" 
                value= "<?php echo esc_attr('Change','booking365'); ?>">      
        
     </div>
    </form>
<?php
}

function msbdt_delete_category_form($cat){?>


<form  method = "post" 
       action = "" 
       class  = "row">

    <div class = "col-sm-4 form-group">                  
       <input name = "cat_id"; 
              type = "hidden" 
                id = "cat_name"                     
             value = "<?php if(isset($cat->cat_id)):echo $cat->cat_id; endif; ?>" 
             class = "form-control">    
    </div>                    
     <div class = "col-sm-12 form-group">      
        <input  type = "submit" 
                name = "cat_submit_for_delete" 
                id   = "" 
                class= "btn btn-primary" 
                value= "<?php echo esc_attr('Delete','booking365'); ?>">      
        
     </div>
    </form>
<?php
}