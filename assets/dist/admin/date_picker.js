$(function() {
    //Date picker
    $('.datepicker').datepicker({
      	autoclose: true,
    	dateFormat: 'yy-mm-dd',
        orientation: 'auto',
        todayBtn: true,
    	todayHighlight: true,
    	changeMonth: true,
    	changeYear: true,
        yearRange: '-20:+0',
    });
});
