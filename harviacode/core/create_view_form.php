<?php 

$string = "
<?php echo \$form->messages(); ?>

<div class=\"row\">
    <div class=\"col-md-6\">
        <div class=\"box box-primary\">
            <div class=\"box-body\">
                <?php echo \$form->open(); ?>";

foreach ($non_pk as $row) {
    //if ($row['column_name'] == 'create_time' || $row['column_name'] == 'update_time')
    if (in_array($row['column_name'], $additional_field_time) || in_array($row['column_name'], $additional_field_id) || in_array($row['column_name'], $field_name)) {
        $string .= "\n\t\t\t\t<?php echo \$form->bs3_text_hidden('".ucfirst(label(empty($row['column_comment'])? $row['column_name']:$row['column_comment']))."','".$row['column_name']."'); ?>";
    } else {
        $string .= "\n\t\t\t\t<?php echo \$form->bs3_text('".ucfirst(label(empty($row['column_comment'])? $row['column_name']:$row['column_comment']))."','".$row['column_name']."','','','','Masukkan ".ucfirst(label(empty($row['column_comment'])? $row['column_name']:$row['column_comment']))."'); ?>";
    }
}

$string .= "\n\t\t\t\t<?php echo \$form->bs3_submit('Create'); ?>
            \t<?php echo '<button type=\"reset\" class=\"btn btn-default\" onclick=\"location.href=\'".strtolower($c)."\'\">Cancel</button>' ?>
            \t<?php echo \$form->close(); ?>
            </div>
        </div>
    </div>
</div>
";


$hasil_view_form = createFile($string, $target."views/" . $c_url . "/" . $v_form_file);

?>