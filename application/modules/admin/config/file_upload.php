<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['upload_path'] = $upload_url;
$config['allowed_types'] = "gif|jpg|png|jpeg|pdf";
$config['overwrite'] => TRUE;
$config['max_size'] => "2MB"; // Can be set to particular file size , here it is 2 MB(2048 Kb)
$config['max_height'] => "768";
$config['max_width'] => "1024";