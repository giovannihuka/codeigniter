<?php
error_reporting(0);
require_once 'helper.php';
$res = '';
$get_setting = readJSON('settingjson.cfg');

if (isset($_POST['save'])) {

    $target = $_POST['target'];
    $js_target = $_POST['js_target'];

    $string = '{
"target": "' . $target . '",
"js_target": "' . $js_target . '",
"copyassets": "0"
}';

    $hasil_setting = createFile($string, 'settingjson.cfg');
    $res = '<p>Setting Updated</p>';
}
?>
<!doctype html>
<html>
    <head>
        <title>Harviacode Codeigniter CRUD Generator</title>
        <link rel="stylesheet" href="bootstrap.min.css"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="col-md-6">
                <?php echo $res; ?>
                <form action="setting.php" method="POST">

                    <div class="form-group">
                        <label>Target Folder Application</label>
                        <div class="row">
                            <?php $target = $_POST['target'] ? $_POST['target'] : $get_setting->target; ?>
                            <div class="col-md-6">
                                <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                    <label>
                                        <input type="radio" name="target" value="../application/modules/admin/" <?php echo $target == '../application/modules/admin/' ? 'checked' : ''; ?>>
                                        ../application/modules/admin/
                                    </label>
                                </div>                            
                            </div>
                            <div class="col-md-6">
                                <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                    <label>
                                        <input type="radio" name="target" value="output/" <?php echo $target == 'output/' ? 'checked' : ''; ?>>
                                        output/
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>Target Folder Script</label>
                        <div class="row">
                            <?php $js_target = $_POST['js_target'] ? $_POST['js_target'] : $get_setting->js_target; ?>
                            <div class="col-md-6">
                                <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                    <label>
                                        <input type="radio" name="js_target" value="../assets/dist/admin/" <?php echo $js_target == '../assets/dist/admin/' ? 'checked' : ''; ?>>
                                        ../assets/dist/admin/
                                    </label>
                                </div>                            
                            </div>
                            <div class="col-md-6">
                                <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                    <label>
                                        <input type="radio" name="js_target" value="output/js/" <?php echo $js_target == 'output/js/' ? 'checked' : ''; ?>>
                                        output/js/
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="submit" value="Save" name="save" class="btn btn-primary" />
                    <a href="../index.php" class="btn btn-default">Back</a>
                </form>
            </div>
            <div class="col-md-4">

            </div>
        </div>
    </body>
</html>

