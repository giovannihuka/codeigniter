<?php 

$string = "
    <div class=\"row\">
        <div class=\"col-md-12\">
            <div class=\"box box-danger\">
                <div class=\"box-body\">
                    <div class=\"row\" style=\"margin-bottom: 4px\">
                        <div class=\"col-md-8\">
                            <div style=\"margin-top: 4px\"  id=\"message\">
                                <?php echo \$this->session->userdata('message') <> '' ? \$this->session->userdata('message') : ''; ?>
                            </div>
                        </div>
                        <div class=\"col-md-4 text-right\">
                            <?php echo anchor(site_url('admin/".$c_url."/create'), 'Create', 'class=\"btn btn-primary\"'); ?>";

if ($export_excel == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('admin/".$c_url."/excel'), 'Excel', 'class=\"btn btn-primary\"'); ?>";
}
if ($export_word == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('admin/".$c_url."/word'), 'Word', 'class=\"btn btn-primary\"'); ?>";
}
if ($export_pdf == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('admin/".$c_url."/pdf'), 'PDF', 'class=\"btn btn-primary\"'); ?>";
}

$string .=
"                    </div>
                </div>
                <div class=\"table-responsive\">";

$string .= "\n\t    
        <table class=\"table table-bordered table-striped nowrap\" id=\"mytable\" style=\"width: 100%\">
            <thead>
                <tr>
                    <th width=\"45px\">No</th>";
foreach ($non_pk as $row) {
    if (!in_array($row['column_name'], $additional_field_time) && !in_array($row['column_name'], $additional_field_id))
    {
        $string .= "\n\t\t    <th>" . label(empty($row['column_comment'])? $row['column_name']:$row['column_comment']) . "</th>";
    }
}
$string .= "\n\t\t    <th width=\"80px\">Aksi</th>
                </tr>
            </thead>";

$column_non_pk = array();
foreach ($non_pk as $row) {
    if (!in_array($row['column_name'], $additional_field_time) && !in_array($row['column_name'], $additional_field_id))
    {
        $column_non_pk[] .= "\n\t\t\t\t\t\t{\"data\": \"".$row['column_name']."\"},";
    }
}

// $col_non_pk = implode(','.PHP_EOL,$column_non_pk);
$col_non_pk = implode('',$column_non_pk);

$string .= "
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>";

$string_js = "$(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        \"iStart\": oSettings._iDisplayStart,
                        \"iEnd\": oSettings.fnDisplayEnd(),
                        \"iLength\": oSettings._iDisplayLength,
                        \"iTotal\": oSettings.fnRecordsTotal(),
                        \"iFilteredTotal\": oSettings.fnRecordsDisplay(),
                        \"iPage\": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        \"iTotalPages\": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var t = $(\"#mytable\").dataTable({
                    initComplete: function() {
                        var api = this.api();
                        $('#mytable_filter input')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                            }
                        });
                    },
                    oLanguage: {
                        sProcessing: \"loading...\"
                    },
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    pageLength: 25,
                    ajax: {\"url\": \"".$c_url."/json\", \"type\": \"POST\"},
                    columns: [
                        {
                            \"data\": \"$pk\",
                            \"orderable\": false
                        },".$col_non_pk."
                        {
                            \"data\" : \"action\",
                            \"orderable\": false,
                            \"className\" : \"text-center\"
                        }
                    ],
                    order: [[0, 'desc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });
            });";


$hasil_view_list = createFile($string, $target."views/" . $c_url . "/" . $v_list_file);
$hasil_js = createFile($string_js, $js_target. $dt_js_file);

?>