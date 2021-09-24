<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Idms_model extends CI_Model {
   
   public $id;

   function __construct(){
        parent::__construct();
   }	
	
   public function get_total_order_wa(){
        $this->db->select('COUNT(1) as total_order');
        $this->db->from('PRANPC.DUNNING_WA');
        return $this->db->get()->result();
		// return $this->db->get('t_absensi')->result_array();
   }

   public function get_total_proses_wa(){
        $this->db->select('COUNT(1) as total_proses');
        $this->db->from('IDEAS.P_DUNNING_WA');
        $this->db->where('status !=', '0');
        return $this->db->get()->result();
   }

   public function get_total_tagihan_wa(){
        $this->db->select('SUM(tagihan)');
        $this->db->from('IDEAS.P_DUNNING_WA');
        return $this->db->get()->result();
   }

   public function get_total_order_sms(){
        $this->db->select('COUNT(1) as total_order');
        $this->db->from('PRANPC.DUNNING_SMS');
        return $this->db->get()->result();
        // return $this->db->get('t_absensi')->result_array();
    }

    public function get_total_proses_sms(){
        $this->db->select('COUNT(1) as total_proses');
        $this->db->from('idmsdb.dunning_sms');
        $this->db->where('status', 1);
        return $this->db->get()->result();
    }

    public function get_total_tagihan_sms(){
        $this->db->select('SUM(tagihan)');
        $this->db->from('idmsdb.dunning_sms');
        $this->db->where('status', 1);
        return $this->db->get()->result();
    }

    public function get_total_payment_sms(){
        $this->db->select('SUM(rp_bayar) as total_payment');
        $this->db->from('IDEAS.REPORT_SMS');
        $this->db->where('rp_bayar !=', 0);
        return $this->db->get()->result();
    }

    public function get_total_order_email(){
        $this->db->select('COUNT(1) as total_order');
        $this->db->from('PRANPC.DUNNING_EMAIL');
        return $this->db->get()->result();
        // return $this->db->get('t_absensi')->result_array();
    }

    public function get_total_proses_email(){
        $this->db->select('COUNT(1) as total_proses');
        $this->db->from('idmsdb.dunning_email');
        $this->db->where('status', 1);
        return $this->db->get()->result();
    }

    public function get_total_tagihan_email(){
        $this->db->select('SUM(tagihan)');
        $this->db->from('idmsdb.dunning_email');
        $this->db->where('status', 1);
        return $this->db->get()->result();
    }

    public function get_total_payment_email(){
        $this->db->select('SUM(rp_bayar) as total_payment');
        $this->db->from('IDEAS.REPORT_EMAIL');
        $this->db->where('rp_bayar !=', 0);
        return $this->db->get()->result();
    }

    public function get_total_order_ovr(){
        $this->db->select('COUNT(1) as total_order');
        $this->db->from('PRANPC.DUNNING_OVR');
        return $this->db->get()->result();
        // return $this->db->get('t_absensi')->result_array();
    }

    public function get_total_proses_ovr(){
        $this->db->select('COUNT(1) as total_proses');
        $this->db->from('idmsdb.dunning_ovr');
        $this->db->where('status', 1);
        return $this->db->get()->result();
    }

    public function get_total_tagihan_ovr(){
        $this->db->select('SUM(tagihan)');
        $this->db->from('idmsdb.dunning_ovr');
        return $this->db->get()->result();
    }

    public function get_total_payment_ovr(){
        $this->db->select('SUM(rp_bayar) as total_payment');
        $this->db->from('IDEAS.REPORT_OVR');
        $this->db->where('rp_bayar !=', 0);
        return $this->db->get()->result();
    }

    public function get_total_order_tvms(){ 
        $this->db->select('COUNT(1) as total_order');
        $this->db->from('IDEAS.POTENSI_RT');
        $this->db->where('tgl_input', 'DATE_FORMAT(SYSDATE(), "%Y%m%d")');
        return $this->db->get()->result();
        // return $this->db->get('t_absensi')->result_array();
    }

    public function get_total_proses_tvms(){
        $this->db->select('COUNT(1) as total_proses');
        $this->db->from('idmsdb.tvms_broadcast');
        $this->db->where('result !=', '');
        return $this->db->get()->result();
    }

    public function get_total_tagihan_tvms(){
        $this->db->select('SUM(tagihan)');
        $this->db->from('idmsdb.tvms_broadcast');
        return $this->db->get()->result();
    }

    public function get_total_payment_tvms(){
        $this->db->select('SUM(rp_bayar) as total_payment');
        $this->db->from('IDEAS.REPORT_TVMS');
        $this->db->where('rp_bayar !=', 0);
        return $this->db->get()->result();
    }

    public function get_total_order_obc(){
        $this->db->select('COUNT(1) as total_order');
        $this->db->from('IDEAS.ideas_api_header');
        $this->db->like('tgl_input', 'R', 'after');
        return $this->db->get()->result();
        // return $this->db->get('t_absensi')->result_array();
    }

    public function get_total_proses_obc(){
        $this->db->select('COUNT(1) as total_proses');
        $this->db->from('TRANS');
        return $this->db->get()->result();
    }

    public function get_total_tagihan_obc(){
        $this->db->select('SUM(TOT_BAYAR) AS total_order');
        $this->db->from('TRANS');
        return $this->db->get()->result();
    }

    public function get_total_payment_obc(){
        $this->db->select('SUM(rp_bayar) as total_payment');
        $this->db->from('IDEAS.REPORT_OBC');
        $this->db->where('rp_bayar !=', 0);
        return $this->db->get()->result();
    }

};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-01-31 15:28:46 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
