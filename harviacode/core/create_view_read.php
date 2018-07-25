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
        $string .= "\n\t\t\t\t<?php echo \$form->bs3_text('".ucfirst(label(empty($row['column_comment'])? $row['column_name']:$row['column_comment']))."','".$row['column_name']."',\$".strtolower($c)."['".$row['column_name']."'],'readonly'); ?>";
    }

}

$string .= "\n\t\t\t\t<?php echo '<button type=\"reset\" class=\"btn btn-default\" onclick=\"location.href=\'".strtolower($c)."\'\">Back</button>' ?>
            \t<?php echo \$form->close(); ?>
            </div>
        </div>
    </div>
</div>
";



$hasil_view_read = createFile($string, $target."views/" . $c_url . "/" . $v_read_file);

?>


