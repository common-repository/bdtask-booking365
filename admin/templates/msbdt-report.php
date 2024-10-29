<?php
/**
 * @package    admin
 * @subpackage admin/templates
 * @author     bdtask<bdtask@gmail.com>
 */

/**=============================
     status
     1 = active
     2 = inactive
     3 = delete
     4 = request => #dda108
     5 = approve => 
     6 = reject

===================================*/  
?>

<div class = "multi-appointment row scheduler_admin" > 
   <table class="table table-bordered textColorForAllPage" id = "dataTableForAppointment">
      <thead>
          <tr>
          <th><?php esc_html_e('SRL','booking365') ;?></th>
          <th><?php esc_html_e('Professional','booking365') ;?></th>
          <th><?php esc_html_e('Name','booking365') ;?></th>
          <th><?php esc_html_e('Email','booking365') ;?></th>
          <th><?php esc_html_e('Contact No','booking365') ;?></th>
          <th><?php esc_html_e('Date','booking365') ;?></th>
          <th><?php esc_html_e('Time','booking365') ;?></th>
          <th><?php esc_html_e('Payment','booking365') ;?></th>
          <th><?php esc_html_e('Status','booking365') ;?></th>
          </tr>
          </thead>
          <tbody> 
                <?php 
                if(method_exists('Msbdt_Booking','msbdt_mas_booking')) :
                global $wpdb ;
                $args['status'] = '5'; // for approved
                $booking_sql = Msbdt_Booking::msbdt_mas_booking( $args );    
                $results = $wpdb->get_results( $booking_sql, OBJECT ) ;
                endif ; ?> 
                <?php  $serial_no = 1  ; ?>  
                <?php foreach ($results as $result): ?> 
                <tr>
                  <td><?php                   
                   echo $serial_no;
                   ?>
                  </td>                
                  <td><?php 
                    $professional = Msbdt_Professional::msbdt_select_professional( $result->pro_id );
                    $professional = $wpdb->get_row($professional['query']['select']);
                    echo ucwords($professional->fname.' '.$professional->lname) ; 
                   ;?></td>                
                  <td><?php echo esc_html(ucwords($result->name)); ?></td>
                  <td><?php echo esc_html($result->email); ?></td>
                  <td><?php echo esc_html($result->phone); ?></td>
                  <td><?php 
                  $date  = new DateTime($result->date);
                  $date = $date->format('m-d-Y');
                  echo $date; ?></td>
                 
                  <td><?php 
                       $start_time = new DateTime($result->date.' '.$result->start_time);
                       $start_time = $start_time->format('H:i');
                       $end_time = new DateTime($result->end_time);
                       $end_time = $end_time->format('H:i');
                       echo $start_time.' - '.$end_time; ?></td>

                   <td>
                  <?php echo ucwords($result->payment); ?>
                  <?php if($result->payment=='card'): ?>
                   <span><a   class="button btn-primary" 
                           href="#edit<?php echo $result->id ; ?>" 
                           data-toggle="modal"><?php echo esc_html('Details','booking365');?></a>
                        </span>
                        <div id="edit<?php echo $result->id; ?>" 
                                 class="modal fade" >                               
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                   <div class="modal-header">
                                     <button class="close" type="button" data-dismiss="modal">×</button>
                                      <h4 class="modal-title"><?php esc_html_e('Card Details','booking365');?>
                                      </h4>
                                    </div>
                                    <div class="modal-body">
                                    <?php msbdt_paymentcard_info($result->id); ?>     
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->                               
                            </div><!-- /.modal -->
                        </div><!-- #edit --> 
                      <?php endif ; ?> 
                      </td>
                  
                   <td><?php  
                        if($result->status !== '4'):
                           if($result->status == '5'):  esc_html_e('Approve','booking365');
                           elseif($result->status =='6'): esc_html_e('Reject','booking365'); 
                           endif ;
                        else: esc_html_e('Request','booking365');
                        endif;

                   ?></td>

               </tr> 
             <?php  $serial_no++ ; ?> 
          <?php endforeach ; ?>
          </tbody>
        </table>   
    </div><!-- / .multi-appointment -->
<?php msbdt_datatable_calling_for_report(); ?>
<?php $scheduler_admin_custom_css = Msbdt_Custom_Admin_Style::msbdt_scheduler_admin_custom_css(); ?>
<?php 
function msbdt_paymentcard_info( $id ){
  $paymentcard =  Msbdt_Booking::msbdt_payment_card_info_recoder($id);
  ?>
  <p><?php echo esc_html('Card Number','booking365');?> : <?php echo esc_html($paymentcard->card_number); ?> </p>
  
  <p><?php echo esc_html('Expiry Date','booking365');?> :  <?php echo esc_html($paymentcard->card_exp_date); ?> </p>
 
  <p><?php echo esc_html('CVS Code','booking365');?> :  <?php echo esc_html($paymentcard->card_cvs_code); ?></p>
 
  <?php
} 
function msbdt_datatable_calling_for_report(){?> 
  <script type="text/javascript">
    jQuery("#dataTableForAppointment").DataTable({ 
      dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp", 
           "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]], 
              
      buttons: [ 
                {extend: 'copy', className: 'btn-sm'},

                {
                  extend: 'csv', 
                  title: 'Report',
                  className: 'btn-sm',
                  exportOptions: {columns:[0,1,2,3,4,5,6,7], modifier: {page: 'current'} }
                },

                {
                extend: 'excel', 
                title: 'Report',
                className: 'btn-sm',
                exportOptions: {columns:[0,1,2,3,4,5,6,7],modifier: {page: 'current'} }

                }, 

                {
                extend: 'pdf', 
                title: 'Report',
                className: 'btn-sm',
                exportOptions: { columns:[0,1,2,3,4,5,6,7],modifier: {page: 'current'} }
                },

               {
                extend: 'print', className: 'btn-sm',
                exportOptions: { columns:[0,1,2,3,4,5,6,7], modifier: { page: 'current'}}
               } 
         ] });
  </script>
  <style type="text/css">
         #wpbody-content { width: 98% !important;}
         .multiselect {
           width: 200px;
          }

  </style>
<?php 
}
