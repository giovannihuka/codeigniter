$(function() {
    //Date picker
    $('#datepicker').datepicker({
      	autoclose: true,
        changeYear: true,
        yearRange: 'yy-80:yy+0',
    	format: 'yyyy-mm-dd',
        orientaion: 'bottom',
        todayBtn: true,
    	todayHighlight: true,
    });
});

jQuery(function($){
    $('#phone_num1').mask('(9999) 999-99999', {autoclear: false});
    $('#phone_num2').mask('(9999) 999-99999', {autoclear: false});
    $('#phone_office').mask('(999) 999-99999', {autoclear: false});
});
