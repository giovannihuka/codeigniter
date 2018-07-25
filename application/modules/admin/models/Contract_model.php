<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contract_model extends MY_Model
{

    public $table = 'contracts';
    public $id = 'contract_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json($contract_id = NULL) {
        $this->datatables->select('contract_id,company_name,db_name,server_ip,pic_name,company_address,company_phone1,company_phone2,pic_phone,email_address,contract_date,start_date,terminate_date,status_data,create_userid,update_userid,create_time,update_time');
        $this->datatables->from('contracts');

        // add this line for join
        //$this->datatables->join('table2', 'contracts.field = table2.field');

        // Remove the comment to add filtering data
        // if ($contract_id !== NULL)
        // {
        //     $this->datatables->where('[a.]contract_id', $contract_id);
        // }        
        
        $this->datatables->add_column('action', anchor(site_url('admin/contract/read/$1'),'<i class=\'fa fa-eye\'></i>')."&nbsp&nbsp".anchor(site_url('admin/contract/update/$1'),'<i class=\'fa fa-pencil-square-o\'></i>')."&nbsp&nbsp".anchor(site_url('admin/contract/delete/$1'),'<i class=\'fa fa-trash-o\'></i>','onclick="javasciprt: return confirm(\'Anda yakin ?\')"'), 'contract_id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('contract_id', $q);
	$this->db->or_like('company_name', $q);
	$this->db->or_like('db_name', $q);
	$this->db->or_like('server_ip', $q);
	$this->db->or_like('pic_name', $q);
	$this->db->or_like('company_address', $q);
	$this->db->or_like('company_phone1', $q);
	$this->db->or_like('company_phone2', $q);
	$this->db->or_like('pic_phone', $q);
	$this->db->or_like('email_address', $q);
	$this->db->or_like('contract_date', $q);
	$this->db->or_like('start_date', $q);
	$this->db->or_like('terminate_date', $q);
    $this->db->or_like('status_data', $q);
	$this->db->or_like('create_userid', $q);
	$this->db->or_like('update_userid', $q);
	$this->db->or_like('create_time', $q);
	$this->db->or_like('update_time', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('contract_id', $q);
	$this->db->or_like('company_name', $q);
	$this->db->or_like('db_name', $q);
	$this->db->or_like('server_ip', $q);
	$this->db->or_like('pic_name', $q);
	$this->db->or_like('company_address', $q);
	$this->db->or_like('company_phone1', $q);
	$this->db->or_like('company_phone2', $q);
	$this->db->or_like('pic_phone', $q);
	$this->db->or_like('email_address', $q);
	$this->db->or_like('contract_date', $q);
	$this->db->or_like('start_date', $q);
	$this->db->or_like('terminate_date', $q);
    $this->db->or_like('status_data', $q);
	$this->db->or_like('create_userid', $q);
	$this->db->or_like('update_userid', $q);
	$this->db->or_like('create_time', $q);
	$this->db->or_like('update_time', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    // function insert($data)
    // {
    //     $this->db->insert($this->table, $data);
    // }

    // update data
    // function update($id, $data)
    // {
    //     $this->db->where($this->id, $id);
    //     $this->db->update($this->table, $data);
    // }

    // delete data
    // function delete($id)
    // {
    //     $this->db->where($this->id, $id);
    //     $this->db->delete($this->table);
    // }

}

/* End of file Contract_model.php */
/* Location: ./application/models/Contract_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Custom Codeigniter CRUD Generator 2018-07-24 12:44:03 */