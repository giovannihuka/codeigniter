<?php 

$string = "
<?php echo \$form->messages(); ?>

<div class=\"row\">
    <div class=\"col-md-6\">
        <div class=\"box box-primary\">
            <div class=\"box-body\">
                <?php echo \$form->open(); ?>";



foreach ($non_pk as $row) {
    if (!in_array($row['column_name'], $additional_field_time) && !in_array($row['column_name'], $additional_field_id))
    {
        if ($row['data_type'] == 'date') {
            $string .= "\n\t\t\t\t<?php echo \$form->bs3_date('".ucfirst(label(empty($row['column_comment'])? $row['column_name']:$row['column_comment']))."','".$row['column_name']."',\$".strtolower($c)."['".$row['column_name']."'],'','','Masukkan ".ucfirst(label(empty($row['column_comment'])? $row['column_name']:$row['column_comment']))."'); ?>";
        } elseif (strpos($row['column_name'],'phone') || strpos($row['column_name'],'phone') !== false) {
            $string .= "\n\t\t\t\t<?php echo \$form->bs3_phone('".ucfirst(label(empty($row['column_comment'])? $row['column_name']:$row['column_comment']))."','".$row['column_name']."',\$".strtolower($c)."['".$row['column_name']."'],'','','Masukkan ".ucfirst(label(empty($row['column_comment'])? $row['column_name']:$row['column_comment']))."'); ?>";
        } elseif (strpos($row['column_name'],'status') || strpos($row['column_name'],'status') !== false) {
            $string .= "\n\t\t\t\t<?php echo \$form->bs3_dropdown('".ucfirst(label(empty($row['column_comment'])? $row['column_name']:$row['column_comment']))."','".$row['column_name']."','',\$".strtolower($c)."['".$row['column_name']."'],'','Pilih ".ucfirst(label(empty($row['column_comment'])? $row['column_name']:$row['column_comment']))."'); ?>";
        } else {
            $string .= "\n\t\t\t\t<?php echo \$form->bs3_text('".ucfirst(label(empty($row['column_comment'])? $row['column_name']:$row['column_comment']))."','".$row['column_name']."',\$".strtolower($c)."['".$row['column_name']."'],'','','Masukkan ".ucfirst(label(empty($row['column_comment'])? $row['column_name']:$row['column_comment']))."'); ?>";
        }
    }
}

$string .= "\n\t\t\t\t<?php echo \$form->bs3_submit('Update'); ?>
            \t<?php echo '<button type=\"reset\" class=\"btn btn-default\" onclick=\"location.href=\'".strtolower($c)."\'\">Cancel</button>' ?>
            \t<?php echo \$form->close(); ?>
            </div>
        </div>
    </div>
</div>
";


$hasil_view_update = createFile($string, $target."views/" . $c_url . "/" . $v_update_file);

?>