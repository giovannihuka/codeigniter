$(document).on({
    change: function() {
        var ref_provinceid = $(this).val();
        if(ref_provinceid){
            $.ajax({
                type:'POST',
                url:'store/get_regencylist',
                data:'province_id=' + ref_provinceid,
                success:function(data){
                    $('#ref_regencies').parent().parent().html(data);
                    $('#ref_regencies').trigger("change");
                    $('#ref_districts').trigger("change");
                    $('#ref_villages').trigger("change");
                }
            }); 
        } 
    }
}, "#ref_provinceid");

$(document).on({
    change: function() {
        var regency_id = $(this).val();
        if(regency_id){
            $.ajax({
                type:'POST',
                url:'store/get_districtlist',
                data:'regency_id=' + regency_id,
                success:function(data){
                    $('#ref_districts').parent().parent().html(data);
                    $('#ref_districts').trigger("change");
                    $('#ref_villages').trigger("change");
                }
            }); 
        }
    }
}, "#ref_regencies");

$(document).on({
    change: function() {
        var district_id = $(this).val();
        if(district_id){
            $.ajax({
                type:'POST',
                url:'store/get_villagelist',
                data:'district_id=' + district_id,
                success:function(data){
                    $('#ref_villages').parent().parent().html(data);
                    $('#ref_villages').trigger("change");
                }
            }); 
        } 
    }
}, "#ref_districts");

