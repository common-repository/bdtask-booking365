jQuery(document).ready(function() {
	'use strict';
        jQuery('.button_inner').slimScroll({
           height: '20px',
           size: '3px',           
           color: '#5bbc2e'
        });
        
        jQuery('.date_slote').datepicker({
             dateFormat: 'yy-mm-dd'
        });
});