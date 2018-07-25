<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contract extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Contract_model');
        $this->load->library('form_builder');
        $this->load->model('common_model','common_ref');        
	    $this->load->library('datatables');
    }

    private $script = array(
        'assets/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js',
        'assets/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
        'assets/dist/admin/contract.js',
    ); 

    private $stylesheet = array(
        // 'assets/datatables/DataTables-1.10.16/css/jquery.dataTables.min.css',
        'assets/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',
    );

    private $datepicker_script = array(
        'assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
        'assets/dist/admin/date_picker.js',
    );

    private $phoneformat_script = array(
        'assets/grocery_crud/js/jquery_plugins/jquery.maskedinput.js',
        'assets/dist/admin/phone_format.js',
    );

    private $location_script = array(
        'assets/dist/admin/geolocation_list.js',
    );

    private $glo_category_script = array(
        'assets/dist/admin/prod_categorization.js',
    );

    public function index()
    {
        $this->add_script($this->script,FALSE,'foot');
        $this->add_stylesheet($this->stylesheet,FALSE,'screen');
        $this->mPageTitle = 'Daftar Profil Grosir'; 
        $this->render('contract/contracts_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');

        /*
        * If need to filterize data on the list
        * remove comments below
        */
        
        // $userid = $this->ion_auth->get_user_id();
        // $username = $this->ion_auth->get_user_name();
        // $contractid = $this->ion_auth->get_contract_id();
        
        // if ($contractid !== '1')
        // {
        //     echo $this->Contract_model->json($contractid);
        // }
        // else
        // {
            echo $this->Contract_model->json();
        // }

        /* ------------------------------------------------- */

    }

    public function read($id)
    {
        $form = $this->form_builder->create_form();

        $row = $this->Contract_model->get_by_id($id);
            
            if ($row)
            {

                $data = array (

					'company_name' => $row->company_name,
					'db_name' => $row->db_name,
					'server_ip' => $row->server_ip,
					'pic_name' => $row->pic_name,
					'company_address' => $row->company_address,
					'company_phone1' => $row->company_phone1,
					'company_phone2' => $row->company_phone2,
					'pic_phone' => $row->pic_phone,
					'email_address' => $row->email_address,
					'contract_date' => $row->contract_date,
					'start_date' => $row->start_date,
					'terminate_date' => $row->terminate_date,

                );
            }

        $this->mViewData['contract'] = $data;
        $this->mPageTitle = 'Profil Grosir';
        $this->mViewData['form'] = $form;
        $this->render('contract/contracts_read');
    }

    public function delete($id) 
    {
        $row = $this->Contract_model->get_by_id($id);

        if ($row) {
            $this->Contract_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/contract'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/contract'));
        }
    }

    public function create()
    {
        $form = $this->form_builder->create_form();
        $this->add_script($this->datepicker_script,FALSE,'foot');
        $this->add_script($this->phoneformat_script,FALSE,'foot');

        $userid = $this->ion_auth->get_user_id();
        $username = $this->ion_auth->get_user_name();
        $contractid = $this->ion_auth->get_contract_id();
        
        if ($form->validate())
        {
			$company_name = $this->input->post('company_name');
			$db_name = $this->input->post('db_name');
			$server_ip = $this->input->post('server_ip');
			$pic_name = $this->input->post('pic_name');
			$company_address = $this->input->post('company_address');
			$company_phone1 = $this->input->post('company_phone1');
			$company_phone2 = $this->input->post('company_phone2');
			$pic_phone = $this->input->post('pic_phone');
			$email_address = $this->input->post('email_address');
			$contract_date = $this->input->post('contract_date');
			$start_date = $this->input->post('start_date');
			$terminate_date = $this->input->post('terminate_date');

    		$data = $this->Contract_model->
        	insert(array
                (
					'company_name' => $company_name,
					'db_name' => $db_name,
					'server_ip' => $server_ip,
					'pic_name' => $pic_name,
					'company_address' => $company_address,
					'company_phone1' => $company_phone1,
					'company_phone2' => $company_phone2,
					'pic_phone' => $pic_phone,
					'email_address' => $email_address,
                    'contract_date' => ($contract_date === '0000-00-00' || empty($contract_date))? NULL:$contract_date,
                    'start_date' => ($start_date === '0000-00-00' || empty($start_date))? NULL:$start_date,
                    'terminate_date' => ($terminate_date === '0000-00-00' || empty($terminate_date))? NULL:$terminate_date,
                    'status_data' => 'Aktif',
					'create_userid' => $userid,
					'update_userid' => $userid,
					'create_time' => time(),
					'update_time' => time(),
				)
            );

            if ($data)
            {
                $this->system_message->set_success('New data inserted successfully');
            }
            else
            {
                // $errors = $this->system_message->errors();
                $this->system_message->set_error($this->system_message->errors());
            }
            
            refresh();
        }

        $this->mViewData['contract'] = $this->Contract_model->get_all();
        $this->mPageTitle = 'Registrasi Profil Grosir';
        $this->mViewData['form'] = $form;
        $this->render('contract/contracts_form');
        
	}


    public function update($id)
    {
        $form = $this->form_builder->create_form();
        $this->add_script($this->datepicker_script,FALSE,'foot');
        $this->add_script($this->phoneformat_script,FALSE,'foot');

        $userid = $this->ion_auth->get_user_id();
        $username = $this->ion_auth->get_user_name();
        $contractid = $this->ion_auth->get_contract_id();

        if ($form->validate())
        {
			$company_name = $this->input->post('company_name');
			$db_name = $this->input->post('db_name');
			$server_ip = $this->input->post('server_ip');
			$pic_name = $this->input->post('pic_name');
			$company_address = $this->input->post('company_address');
			$company_phone1 = $this->input->post('company_phone1');
			$company_phone2 = $this->input->post('company_phone2');
			$pic_phone = $this->input->post('pic_phone');
			$email_address = $this->input->post('email_address');
			$contract_date = $this->input->post('contract_date');
			$start_date = $this->input->post('start_date');
			$terminate_date = $this->input->post('terminate_date');
            $status_data = $this->input->post('status_data');

            $this->Contract_model->set_primary_key('contract_id');

            $data = $this->Contract_model->
            update($id,
                array
                (
					'company_name' => $company_name,
					'db_name' => $db_name,
					'server_ip' => $server_ip,
					'pic_name' => $pic_name,
					'company_address' => $company_address,
					'company_phone1' => $company_phone1,
					'company_phone2' => $company_phone2,
					'pic_phone' => $pic_phone,
					'email_address' => $email_address,
					'contract_date' => ($contract_date === '0000-00-00' || empty($contract_date))? NULL:$contract_date,
					'start_date' => ($start_date === '0000-00-00' || empty($start_date))? NULL:$start_date,
					'terminate_date' => ($terminate_date === '0000-00-00' || empty($terminate_date))? NULL:$terminate_date,
                    'status_data' => $status_data,
					'update_userid' => $userid,
					'update_time' => time(),
				)
    );

    $this->Contract_model->set_primary_key('id');

    if ($data)
    {
        $this->system_message->set_success('Data updated successfully');
    }
    else
    {
        // $errors = $this->system_message->errors();
        $this->system_message->set_error($this->system_message->errors());
    }

    refresh();

    } else {

    $row = $this->Contract_model->get_by_id($id);

    if ($row)
    {

        $data = array (
					'company_name' => $row->company_name,
					'db_name' => $row->db_name,
					'server_ip' => $row->server_ip,
					'pic_name' => $row->pic_name,
					'company_address' => $row->company_address,
					'company_phone1' => $row->company_phone1,
					'company_phone2' => $row->company_phone2,
					'pic_phone' => $row->pic_phone,
					'email_address' => $row->email_address,
					'contract_date' => $row->contract_date,
					'start_date' => $row->start_date,
					'terminate_date' => $row->terminate_date,
                    'status_data' => $row->status_data,
					'button' => 'Update',
                );
            }

        }

        $this->mViewData['status_list'] = $this->common_ref->status_list();
        $this->mViewData['contract'] = $data;
        $this->mPageTitle = 'Ubah Profil Grosir';
        $this->mViewData['form'] = $form;
        $this->render('contract/contracts_update');
        
	}


/* 
Please copy this section into ../application/modules/admin/config/form_validation.php

	'contract/create' => array(
			array(
            	'field'		 => 'company_name',
            	'label'		 => 'Nama Grosir',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'db_name',
            	'label'		 => 'Nama Database',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'server_ip',
            	'label'		 => 'Server IP',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'pic_name',
            	'label'		 => 'Nama Pemilik',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'company_address',
            	'label'		 => 'Alamat Grosir',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'company_phone1',
            	'label'		 => 'Telepon',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'company_phone2',
            	'label'		 => 'Telepon Lain',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'pic_phone',
            	'label'		 => 'Hand Phone',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'email_address',
            	'label'		 => 'Email',
            	'rules'		 => 'trim|required|valid_email',
        	),
        ),


	'contract/update' => array(
			array(
            	'field'		 => 'company_name',
            	'label'		 => 'Nama Grosir',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'db_name',
            	'label'		 => 'Nama Database',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'server_ip',
            	'label'		 => 'Server IP',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'pic_name',
            	'label'		 => 'Nama Pemilik',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'company_address',
            	'label'		 => 'Alamat Grosir',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'company_phone1',
            	'label'		 => 'Telepon',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'company_phone2',
            	'label'		 => 'Telepon Lain',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'pic_phone',
            	'label'		 => 'Hand Phone',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'email_address',
            	'label'		 => 'Email',
            	'rules'		 => 'trim|required|valid_email',
        	),
        ),

*/

}
/* End of file Contract.php */
/* Location: ./application/controllers/Contract.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2018-07-24 12:44:03 */