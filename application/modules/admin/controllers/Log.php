<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CodeIgniter Log Controller
 *
 * @author Mike Feng
 */
class Log extends Admin_Controller {
    /**
     * Default route for rendering view
     *
     * @param String $log_date
     */

    function __construct()
    {
        parent::__construct();
        $this->load->library('log_library');
        $this->load->library('form_builder');
    }

    private $script = array(
        'assets/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js',
        'assets/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
    ); 

    private $datepicker_script = array(
        'assets/jquery-ui-1.12.1.custom/jquery-ui.js',
        'assets/dist/admin/date_picker.js',
    );

    private $stylesheet = array(
        // 'assets/datatables/DataTables-1.10.16/css/jquery.dataTables.min.css',
        'assets/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',
        'assets/jquery-ui-1.12.1.custom/jquery-ui.css',

    );

    public function index($log_date = NULL)
	{
        $form = $this->form_builder->create_form('',false,array('autocomplete'=>'off'));

		$this->add_script($this->script,FALSE,'foot');
        $this->add_script($this->datepicker_script,FALSE,'foot');
        $this->add_script('assets/dist/admin/log_viewer.js',FALSE,'foot');
        $this->add_stylesheet($this->stylesheet,FALSE,'screen');
        $this->mPageTitle = 'Log Viewer'; 
        
        if ($log_date == NULL)
        {
        	// default: today
        	$log_date = date('Y-m-d');
        }
        
        $this->mViewData['cols'] = $this->log_library->get_file('log-'. $log_date . '.php');
        $this->mViewData['log_date'] = $log_date;
        $this->mViewData['form'] = $form;
		$this->render('log/logviewer');
	}
}