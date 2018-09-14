<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// NOTE: this controller inherits from MY_Controller instead of Admin_Controller,
// since no authentication is required
class Login extends MY_Controller {

	/**
	 * Login page and submission
	 */
	public function index()
	{
		$this->load->library('form_builder');
		$form = $this->form_builder->create_form();

		// $this->add_stylesheet('http://localhost/sig/assets/dist/admin/adminlte.min.css',FALSE,'screen');

		if ($form->validate())
		{
			// passed validation
			$identity = $this->input->post('username');
			$password = $this->input->post('password');
			$remember = ($this->input->post('remember')=='on');

			// [IMPORTANT] override database tables to update Frontend Users instead of Admin Users
            // $this->ion_auth_model->tables = array(
            //     'users'				=> 'users',
            //     'groups'			=> 'groups',
            //     'users_groups'		=> 'users_groups',
            //     'login_attempts'	=> 'login_attempts',
            // );

			
			if ($this->ion_auth->login($identity, $password, $remember))
			{
				// login succeed
				$messages = $this->ion_auth->messages();
				$this->system_message->set_success($messages);
				var_dump($this->mModule);
				redirect($this->mModule);
			}
			else
			{
				// login failed
				$errors = $this->ion_auth->errors();
				$this->system_message->set_error($errors);
				refresh();
			}
		}
		
		// display form when no POST data, or validation failed
		$this->mViewData['form'] = $form;
		// $this->mBodyClass = 'login-page';
		$this->render('login', 'full_width');
	}
}