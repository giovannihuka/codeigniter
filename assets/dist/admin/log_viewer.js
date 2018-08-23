$(document).ready(function(){
   var href = window.location.href,
       newUrl = href.substring(0, href.indexOf('&'))
   window.history.replaceState({}, '', newUrl);
});

$(document).on(
    "change","#log_date",function() 
    {
        if ($("#log_date").val() !== "")
        {
            window.location.href =  window.location.href + 'log/index/' + $("#log_date").val();
        } 
    }
);