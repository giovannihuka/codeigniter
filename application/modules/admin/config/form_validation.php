<?php

/**
 * Config file for form validation
 * Reference: http://www.codeigniter.com/user_guide/libraries/form_validation.html
 * (Under section "Creating Sets of Rules")
 */

$config = array(

	// Admin User Login
	'login/index' => array(
		array(
			'field'		=> 'username',
			'label'		=> 'Username',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'password',
			'label'		=> 'Password',
			'rules'		=> 'required',
		),
	),

	// Create User
	'user/create' => array(
		array(
			'field'		=> 'first_name',
			'label'		=> 'First Name',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'last_name',
			'label'		=> 'Last Name',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'username',
			'label'		=> 'Username',
			'rules'		=> 'is_unique[users.username]',				// use email as username if empty
		),
		array(
			'field'		=> 'email',
			'label'		=> 'Email',
			'rules'		=> 'required|valid_email|is_unique[users.email]',
		),
		array(
			'field'		=> 'password',
			'label'		=> 'Password',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'retype_password',
			'label'		=> 'Retype Password',
			'rules'		=> 'required|matches[password]',
		),
	),

	// Reset User Password
	'user/reset_password' => array(
		array(
			'field'		=> 'new_password',
			'label'		=> 'New Password',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'retype_password',
			'label'		=> 'Retype Password',
			'rules'		=> 'required|matches[new_password]',
		),
	),

	// Create Admin User
	'panel/admin_user_create' => array(
		array(
			'field'		=> 'username',
			'label'		=> 'Username',
			'rules'		=> 'required|is_unique[users.username]',
		),
		array(
			'field'		=> 'first_name',
			'label'		=> 'First Name',
			'rules'		=> 'required',
		),
		/* Admin User can have no email
		array(
			'field'		=> 'email',
			'label'		=> 'Email',
			'rules'		=> 'valid_email|is_unique[users.email]',
		),*/
		array(
			'field'		=> 'password',
			'label'		=> 'Password',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'retype_password',
			'label'		=> 'Retype Password',
			'rules'		=> 'required|matches[password]',
		),
	),

	// Reset Admin User Password
	'panel/admin_user_reset_password' => array(
		array(
			'field'		=> 'new_password',
			'label'		=> 'New Password',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'retype_password',
			'label'		=> 'Retype Password',
			'rules'		=> 'required|matches[new_password]',
		),
	),

	// Admin User Update Info
	'panel/account_update_info' => array(
		array(
			'field'		=> 'username',
			'label'		=> 'Username',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'password',
			'label'		=> 'Password',
			'rules'		=> 'required',
		),
        array(
            'field'     => 'first_name',
            'label'     => 'First Name',
            'rules'     => 'trim|required',
        ),
        array(
            'field'     => 'last_name',
            'label'     => 'Last Name',
            'rules'     => 'trim|required',
        ),

	),

	// Admin User Change Password
	'panel/account_change_password' => array(
		array(
			'field'		=> 'new_password',
			'label'		=> 'New Password',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'retype_password',
			'label'		=> 'Retype Password',
			'rules'		=> 'required|matches[new_password]',
		),
	),

	// Contract Management
	'contract/create' => array(
			array(
            	'field'		 => 'company_name',
            	'label'		 => 'Nama Grosir',
            	'rules'		 => 'trim|required',
        	),
			array(
            	'field'		 => 'company_status',
            	'label'		 => 'Status Grosir',
            	'rules'		 => 'trim|required|is_selected[Status]',
        	),
        	array(
            	'field'		 => 'db_name',
            	'label'		 => 'Nama Database',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'server_ip',
            	'label'		 => 'Server IP',
            	'rules'		 => 'trim',
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
            	'rules'		 => 'trim',
        	),
        	array(
            	'field'		 => 'company_phone2',
            	'label'		 => 'Telepon Lain',
            	'rules'		 => 'trim',
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
            	'field'		 => 'company_status',
            	'label'		 => 'Status Grosir',
            	'rules'		 => 'trim|required|is_selected[Status]',
        	),
        	array(
            	'field'		 => 'db_name',
            	'label'		 => 'Nama Database',
            	'rules'		 => 'trim|required',
        	),
        	array(
            	'field'		 => 'server_ip',
            	'label'		 => 'Server IP',
            	'rules'		 => 'trim',
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
            	'rules'		 => 'trim',
        	),
        	array(
            	'field'		 => 'company_phone2',
            	'label'		 => 'Telepon Lain',
            	'rules'		 => 'trim',
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
);