<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Best_time_model extends CI_Model {
   
   function __construct(){
        parent::__construct();

        $dbDaPros = $this->load->database('default', TRUE);
        $dbPayment = $this->load->database('payment', TRUE);
   }	
	
   public function getDataPayment(){
        $dbPayment = $this->load->database('payment', TRUE);

        $dbPayment->order_by('no_internet, date', 'ASC');
        return $dbPayment->get('payment')->result_array();
    }

    public function getDataDistinctPayment(){
        $dbPayment = $this->load->database('payment', TRUE);

        $dbPayment->group_by('no_internet');
        $dbPayment->order_by('no_internet, date', 'ASC');
        return $dbPayment->get('payment')->result_array();
    }

    public function getByNoInet($noInet) {
        $dbPayment = $this->load->database('payment', TRUE);
        $dbPayment->where('date >= DATE_ADD(NOW(), INTERVAL -3 MONTH)');
        $dbPayment->order_by('no_internet, date', 'ASC');
        return $dbPayment->get_where('payment', ["no_internet" => $noInet])->result_array(); 
    }

   public function getDataPros(){
        $dbPros = $this->load->database('default', TRUE);

        return $dbPros->get('data_lead')->result_array();
    }

    public function updateBestTime($noSpeedy, $bestTimeAvg, $bestTimePercentil){
        $dbPros = $this->load->database('default', TRUE);
        
        $data = array(
            'best_time_avg' => $bestTimeAvg,
            'best_time_percentil' => $bestTimePercentil
        );

        $queryUpdateBestTime = $dbPros->where('no_speedy', $noSpeedy)->update('data_lead', $data);

        return $queryUpdateBestTime;
    }

};