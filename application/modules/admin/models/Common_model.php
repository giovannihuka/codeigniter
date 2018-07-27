<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_model extends MY_Model
{

    function __construct()
    {
        parent::__construct();
    }

    /*
     *  Dropdown list nama client
     */
    function contract_list()
    {
        $this->db->from('contracts');
        $this->db->where('terminate_date is null');
        $this->db->order_by('company_name','asc');
        $result = $this->db->get();

        $return = array();
        // $return[0] = '-- Pilih Nama Grosir --';

        if ($result->num_rows() > 0) 
        {
            foreach ($result->result_array() as $row) {
                # code...
                $return[$row['contract_id']] = $row['company_name'];
            }
        }

        return $return;

    }

    function contract_status()
    {
        $this->db->from('ref_constatus');
        $this->db->order_by('contract_statusid','asc');
        $result = $this->db->get();

        $return = array();
        $return[0] = '-- Pilih Status --';

        if ($result->num_rows() > 0) 
        {
            foreach ($result->result_array() as $row) {
                # code...
                $return[$row['contract_statusid']] = $row['status_name'];
            }
        }

        return $return;

    }

    /*
     *  Dropdown list nama propinsi
     */
    function province_list()
    {
    	$this->db->from('ref_provinces');
        $this->db->order_by('id','asc');
    	$result = $this->db->get();

        $return = array();
        $return[0] = '-- Pilih Propinsi --';

        if ($result->num_rows() > 0) 
        {
            foreach ($result->result_array() as $row) {
                $return[$row['id']] = $row['name'];
            }
        }

        return $return;    	
    }

    /*
     *  Dropdown list nama kabupaten (dependensi province_id
     *  dari province_list)
     */
    function regency_list($province_id)
    {
    	$this->db->from('ref_regencies');
    	$this->db->where('province_id = '. $province_id);
        $this->db->order_by('name','asc');
    	$result = $this->db->get();

        $return = array();

        if ($result->num_rows() > 0) 
        {
            $return[0] = '-- Pilih Kabupaten --';
            foreach ($result->result_array() as $row) {
                $return[$row['id']] = $row['name'];
            }
        } else {
            $return[0] = '-- Pilih Kabupaten --';
        }

        return $return;    	
    }

     /*
     *  Dropdown list nama kecamatan (dependensi regency_id
     *  dari regency_list)
     */
    function district_list($regency_id)
    {
    	$this->db->from('ref_districts');
    	$this->db->where('regency_id',$regency_id);
        $this->db->order_by('name','asc');
    	$result = $this->db->get();

        $return = array();

        if ($result->num_rows() > 0) 
        {
            $return[0] = '-- Pilih Kecamatan --';
            foreach ($result->result_array() as $row) {
                $return[$row['id']] = $row['name'];
            }
        } else {
            $return[0] = '-- Pilih Kecamatan --';
        }

        return $return;    	
    }  

    /*
     *  Dropdown list nama kelurahan (dependensi district_id
     *  dari district_list)
     */
    function village_list($district_id)
    {
    	$this->db->from('ref_villages');
    	$this->db->where('district_id',$district_id);
        $this->db->order_by('name','asc');
    	$result = $this->db->get();

        $return = array();

        if ($result->num_rows() > 0) 
        {
            $return[0] = '-- Pilih Kelurahan --';
            foreach ($result->result_array() as $row) {
                $return[$row['id']] = $row['name'];
            }
        } else {
            $return[0] = '-- Pilih Kelurahan --';
        }

        return $return;    	
    }   

    /*
     *  Dropdown list Aktif / Tidak Aktif
     *  untuk status data
     */
    function status_list()
    {
        $this->db->from('ref_status');
        $this->db->order_by('id','asc');
        $result = $this->db->get();

        $return = array('');

        if ($result->num_rows() > 0)
        {
            $return[0] = '-- Pilih Status --';
            foreach ($result->result_array() as $row) {
                $return[$row['string_status']] = $row['string_status'];
            }
        } else {
            $return[0] = '-- Pilih Status --';
        }

        return $return;     
    }  

    /*
     * Function untuk merubah tampilan angka dalam satuan Rp.
    */

    function rupiah($angka)
    {
        $hasil_rupiah = 'Rp ' . number_format($angka,0,',','.');

        return $hasil_rupiah;
    }

}