<?php

$string = "<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class " . $c . " extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        \$this->load->model('$m');
        \$this->load->library('form_builder');
        \$this->load->model('common_model','common_ref');";

if ($jenis_tabel <> 'reguler_table') {
    $string .= "        \n\t    \$this->load->library('datatables');";
}
        
$string .= "
    }";

if ($jenis_tabel == 'reguler_table') {
    
$string .= "\n\n    public function index()
    {
        \$q = urldecode(\$this->input->get('q', TRUE));
        \$start = intval(\$this->input->get('start'));
        
        if (\$q <> '') {
            \$config['base_url'] = base_url() . '$c_url/index.html?q=' . urlencode(\$q);
            \$config['first_url'] = base_url() . '$c_url/index.html?q=' . urlencode(\$q);
        } else {
            \$config['base_url'] = base_url() . '$c_url/index.html';
            \$config['first_url'] = base_url() . '$c_url/index.html';
        }

        \$config['per_page'] = 10;
        \$config['page_query_string'] = TRUE;
        \$config['total_rows'] = \$this->" . $m . "->total_rows(\$q);
        \$$c_url = \$this->" . $m . "->get_limit_data(\$config['per_page'], \$start, \$q);

        \$this->load->library('pagination');
        \$this->pagination->initialize(\$config);

        \$data = array(
            '" . $c_url . "_data' => \$$c_url,
            'q' => \$q,
            'pagination' => \$this->pagination->create_links(),
            'total_rows' => \$config['total_rows'],
            'start' => \$start,
        );
        \$this->load->view('$c_url/$v_list', \$data);
    }";

} else {

$string .="\n\n    private \$script = array(
        'assets/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js',
        'assets/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
        'assets/dist/admin/".strtolower($c).".js',
    ); ";

$string .="\n\n    private \$stylesheet = array(
        // 'assets/datatables/DataTables-1.10.16/css/jquery.dataTables.min.css',
        'assets/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',
    );";

$string .= "\n\n    private \$datepicker_script = array(
        'assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
        'assets/dist/admin/date_picker.js',
    );";

$string .= "\n\n    private \$phoneformat_script = array(
        'assets/grocery_crud/js/jquery_plugins/jquery.maskedinput.js',
        'assets/dist/admin/phone_format.js',
    );";

$string .= "\n\n    private \$location_script = array(
        'assets/dist/admin/geolocation_list.js',
    );";

$string .= "\n\n    private \$glo_category_script = array(
        'assets/dist/admin/prod_categorization.js',
    );";
    
$string .="\n\n    public function index()
    {
        \$this->add_script(\$this->script,FALSE,'foot');
        \$this->add_stylesheet(\$this->stylesheet,FALSE,'screen');
        \$this->mPageTitle = 'Daftar ". $title ."'; 
        \$this->render('$c_url/$v_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');

        /*
        * If need to filterize data on the list
        * remove comments below
        */
        
        // \$userid = \$this->ion_auth->get_user_id();
        // \$username = \$this->ion_auth->get_user_name();
        // \$contractid = \$this->ion_auth->get_contract_id();
        
        // if (\$contractid !== '1')
        // {
        //     echo \$this->" . $m . "->json(\$contractid);
        // }
        // else
        // {
            echo \$this->" . $m . "->json();
        // }

        /* ------------------------------------------------- */

    }";

}

$string_read = "\n";

$string_read .= "
    public function read(\$id)
    {
        \$form = \$this->form_builder->create_form();

        \$row = \$this->".$m."->get_by_id(\$id);
            
            if (\$row)
            {\n
                \$data = array (\n
";

foreach ($non_pk as $row) {
        if (!in_array($row['column_name'], $additional_field_time) && !in_array($row['column_name'], $additional_field_id)) {
            $string_read .= "\t\t\t\t\t'". $row['column_name'] ."' => \$row->". $row['column_name'] .",\n";
        } 
}

$string_read .= "
                );
            }

        \$this->mViewData['".strtolower($c)."'] = \$data;
        \$this->mPageTitle = '".$title."';
        \$this->mViewData['form'] = \$form;
        \$this->render('".strtolower($c)."/".strtolower($table_name)."_read');
    }";

$string .= $string_read;
    
$string .= "\n
    public function delete(\$id) 
    {
        \$row = \$this->".$m."->get_by_id(\$id);

        if (\$row) {
            \$this->".$m."->set_primary_key('".$pk."');
            \$this->".$m."->delete(\$id);
            \$this->".$m."->set_primary_key('id');
            \$this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/$c_url'));
        } else {
            \$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/$c_url'));
        }
    }\n";

$string_rules = "\n/* 
Please copy this section into ../application/modules/admin/config/form_validation.php\n
\t'".$c_url."/create' => array(\n\t\t";

foreach ($non_pk as $row){

    if (!in_array($row['column_name'], $additional_field_time) && !in_array($row['column_name'], $additional_field_id) && !in_array($row['column_name'], $field_name)) 
    {
        $int = $row['data_type'] == 'int' || $row['data_type'] == 'double' || $row['data_type'] == 'decimal' ? '|numeric' : '';
        $string_rules .=
        "\tarray(
            \t'field'\t\t => '".$row['column_name']."',
            \t'label'\t\t => '".ucfirst(label(empty($row['column_comment'])? $row['column_name']:$row['column_comment']))."',
            \t'rules'\t\t => 'trim|required$int',
        \t),
        ";
    }
}

$string_rules .= "),\n";

$string_rules .= "\n
\t'".$c_url."/update' => array(\n\t\t";

foreach ($non_pk as $row){

    if (!in_array($row['column_name'], $additional_field_time) && !in_array($row['column_name'], $additional_field_id) && !in_array($row['column_name'], $field_name)) 
    {
        $int = $row['data_type'] == 'int' || $row['data_type'] == 'double' || $row['data_type'] == 'decimal' ? '|numeric' : '';
        $string_rules .=
        "\tarray(
            \t'field'\t\t => '".$row['column_name']."',
            \t'label'\t\t => '".ucfirst(label(empty($row['column_comment'])? $row['column_name']:$row['column_comment']))."',
            \t'rules'\t\t => 'trim|required$int',
        \t),
        ";
    }
}

$string_rules .= "),\n
*/\n";

if ($export_excel == '1') {
    $string .= "\n\n    public function excel()
    {
        \$this->load->helper('exportexcel');
        \$namaFile = \"$table_name.xls\";
        \$judul = \"$table_name\";
        \$tablehead = 0;
        \$tablebody = 1;
        \$nourut = 1;
        //penulisan header
        header(\"Pragma: public\");
        header(\"Expires: 0\");
        header(\"Cache-Control: must-revalidate, post-check=0,pre-check=0\");
        header(\"Content-Type: application/force-download\");
        header(\"Content-Type: application/octet-stream\");
        header(\"Content-Type: application/download\");
        header(\"Content-Disposition: attachment;filename=\" . \$namaFile . \"\");
        header(\"Content-Transfer-Encoding: binary \");

        xlsBOF();

        \$kolomhead = 0;
        xlsWriteLabel(\$tablehead, \$kolomhead++, \"No\");";
foreach ($non_pk as $row) {
        $column_name = label($row['column_name']);
        $string .= "\n\txlsWriteLabel(\$tablehead, \$kolomhead++, \"$column_name\");";
}
$string .= "\n\n\tforeach (\$this->" . $m . "->get_all() as \$data) {
            \$kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber(\$tablebody, \$kolombody++, \$nourut);";
foreach ($non_pk as $row) {
        $column_name = $row['column_name'];
        $xlsWrite = $row['data_type'] == 'int' || $row['data_type'] == 'double' || $row['data_type'] == 'decimal' ? 'xlsWriteNumber' : 'xlsWriteLabel';
        $string .= "\n\t    " . $xlsWrite . "(\$tablebody, \$kolombody++, \$data->$column_name);";
}
$string .= "\n\n\t    \$tablebody++;
            \$nourut++;
        }

        xlsEOF();
        exit();
    }";
}

if ($export_word == '1') {
    $string .= "\n\n    public function word()
    {
        header(\"Content-type: application/vnd.ms-word\");
        header(\"Content-Disposition: attachment;Filename=$table_name.doc\");

        \$data = array(
            '" . $table_name . "_data' => \$this->" . $m . "->get_all(),
            'start' => 0
        );
        
        \$this->load->view('" . $c_url ."/". $v_doc . "',\$data);
    }";
}

if ($export_pdf == '1') {
    $string .= "\n\n    function pdf()
    {
        \$data = array(
            '" . $table_name . "_data' => \$this->" . $m . "->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
        \$html = \$this->load->view('" . $c_url ."/". $v_pdf . "', \$data, true);
        \$this->load->library('pdf');
        \$pdf = \$this->pdf->load();
        \$pdf->WriteHTML(\$html);
        \$pdf->Output('" . $table_name . ".pdf', 'D'); 
    }";
}

$string_create = "
    public function create()
    {
        \$form = \$this->form_builder->create_form();

        \$this->add_script(\$this->datepicker_script,FALSE,'foot');
        \$this->add_script(\$this->phoneformat_script,FALSE,'foot');
        \$this->add_stylesheet(\$this->stylesheet,FALSE,'screen');

        \$userid = \$this->ion_auth->get_user_id();
        \$username = \$this->ion_auth->get_user_name();
        \$contractid = \$this->ion_auth->get_contract_id();
        
        if (\$form->validate())
        {\n";

foreach ($non_pk as $row) {
    if (!in_array($row['column_name'], $additional_field_time) && !in_array($row['column_name'], $additional_field_id) && !in_array($row['column_name'], $field_name)) {
        $string_create .= "\t\t\t$" . $row['column_name'] ." = \$this->input->post('". $row['column_name'] ."');\n";
    } 
}
    
$string_create .= "
    \t\t\$data = \$this->".$m."->
        \tinsert(array
                (\n";
            
            foreach ($non_pk as $row) {
                if (!in_array($row['column_name'], $additional_field_time) && !in_array($row['column_name'], $additional_field_id) && !in_array($row['column_name'], $field_name)) {
                    $string_create .= "\t\t\t\t\t'". $row['column_name'] ."' => $". $row['column_name'] .",\n";
                } 
                elseif (in_array($row['column_name'], $additional_field_time)) 
                {
                    $string_create .= "\t\t\t\t\t'". $row['column_name'] ."' => time(),\n";
                }
                elseif (!in_array($row['column_name'], $field_name))
                {
                    $string_create .= "\t\t\t\t\t'". $row['column_name'] ."' => \$userid,\n";
                }
            }
            
            $string_create .= "\t\t\t\t)
            );

            if (\$data)
            {
                \$this->system_message->set_success('New data inserted successfully');
            }
            else
            {
                // \$errors = \$this->system_message->errors();
                \$this->system_message->set_error(\$this->system_message->errors());
            }
            
            refresh();
        }

        \$this->mViewData['".strtolower($c)."'] = \$this->".$m."->get_all();
        \$this->mPageTitle = 'Registrasi ". $title ."';
        \$this->mViewData['form'] = \$form;
        \$this->render('".strtolower($c)."/".strtolower($table_name)."_form');
        \n";
    
$string_create .= "\t}";

$string_update = "\n";

$string_update .= "
    public function update(\$id)
    {
        \$form = \$this->form_builder->create_form();

        \$this->add_script(\$this->datepicker_script,FALSE,'foot');
        \$this->add_script(\$this->phoneformat_script,FALSE,'foot');
        \$this->add_stylesheet(\$this->stylesheet,FALSE,'screen');

        \$userid = \$this->ion_auth->get_user_id();
        \$username = \$this->ion_auth->get_user_name();
        \$contractid = \$this->ion_auth->get_contract_id();

        if (\$form->validate())
        {\n";

foreach ($non_pk as $row) {
    if (!in_array($row['column_name'], $additional_field_time) && !in_array($row['column_name'], $additional_field_id)) 
    {
        $string_update .= "\t\t\t$" . $row['column_name'] ." = \$this->input->post('". $row['column_name'] ."');\n";
    }
}

$string_update .= "
            \$this->".$m."->set_primary_key('".$pk."');

            \$data = \$this->".$m."->
            update(\$id,
                array
                (\n";

foreach ($non_pk as $row) {
    if (!in_array($row['column_name'], $additional_field_time) && !in_array($row['column_name'], $additional_field_id)) {
        $string_update .= "\t\t\t\t\t'". $row['column_name'] ."' => $". $row['column_name'] .",\n";
    } 
    elseif (in_array($row['column_name'], $additional_update_time)) 
    {
        $string_update .= "\t\t\t\t\t'". $row['column_name'] ."' => time(),\n";
    }
    elseif (in_array($row['column_name'], $additional_update_id)) 
    {
        $string_update .= "\t\t\t\t\t'". $row['column_name'] ."' => \$userid,\n";
    }
}
            
$string_update .= "\t\t\t\t)
    );

    \$this->".$m."->set_primary_key('id');

    if (\$data)
    {
        \$this->system_message->set_success('Data updated successfully');
    }
    else
    {
        // \$errors = \$this->system_message->errors();
        \$this->system_message->set_error(\$this->system_message->errors());
    }

    refresh();

    } else {

    \$row = \$this->".$m."->get_by_id(\$id);

    if (\$row)
    {\n
        \$data = array (\n";

foreach ($non_pk as $row) {
        if (!in_array($row['column_name'], $additional_field_time) && !in_array($row['column_name'], $additional_field_id)) {
            $string_update .= "\t\t\t\t\t'". $row['column_name'] ."' => \$row->". $row['column_name'] .",\n";
        } 
}
    
$string_update .= "\t\t\t\t\t'button' => 'Update',
                );
            }

        }

        \$this->mViewData['".strtolower($c)."'] = \$data;
        \$this->mPageTitle = 'Ubah ". $title ."';
        \$this->mViewData['form'] = \$form;
        \$this->render('".strtolower($c)."/".strtolower($table_name)."_update');
        \n";
    
$string_update .= "\t}";

$string .= $string_create."\n".$string_update;
// ."\n*/";

$string .= "\n\n".$string_rules."\n}\n/* End of file $c_file */
/* Location: ./application/controllers/$c_file */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator ".date('Y-m-d H:i:s')." */";


$hasil_controller = createFile($string, $target . "controllers/" . $c_file);

?>