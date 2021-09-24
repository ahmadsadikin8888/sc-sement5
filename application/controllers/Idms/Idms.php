<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Idms extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Idms/Idms_model', 'idms_model');
	}

	public function index()
	{
		$data['totalOrderWa'] = $this->showTotalOrderWa();
        $data['totalProsesWa'] = $this->showTotalProsesWa();
        $data['totalTagihanWa'] = $this->showTotalTagihanWa();

        $data['totalOrderSms'] = $this->showTotalOrderSms();
        $data['totalProsesSms'] = $this->showTotalProsesSms();
        $data['totalTagihanSms'] = $this->showTotalTagihanSms();
        $data['totalPaymentSms'] = $this->showTotalPaymentSms();

        $data['totalOrderEmail'] = $this->showTotalOrderEmail();
        $data['totalProsesEmail'] = $this->showTotalProsesEmail();
        $data['totalTagihanEmail'] = $this->showTotalTagihanEmail();
        $data['totalPaymentEmail'] = $this->showTotalPaymentEmail();

        $data['totalOrderOvr'] = $this->showTotalOrderOvr();
        $data['totalProsesOvr'] = $this->showTotalProsesOvr();
        $data['totalTagihanOvr'] = $this->showTotalTagihanOvr();
        $data['totalPaymentOvr'] = $this->showTotalPaymentOvr();

        $data['totalOrderTvms'] = $this->showTotalOrderTvms();
        $data['totalProsesTvms'] = $this->showTotalProsesTvms();
        $data['totalTagihanTvms'] = $this->showTotalTagihanTvms();
        $data['totalPaymentTvms'] = $this->showTotalPaymentTvms();

        $data['totalOrderObc'] = $this->showTotalOrderObc();
        $data['totalProsesObc'] = $this->showTotalProsesObc();
        $data['totalTagihanObc'] = $this->showTotalTagihanObc();
        $data['totalPaymentObc'] = $this->showTotalPaymentObc();
        
		$this->load->view('Idms/idms_view',$data);
	}

	public function showTotalOrderWa(){
        return $this->idms_model->get_total_order_wa();
   }

   public function showTotalProsesWa(){
        return $this->idms_model->get_total_proses_wa();
   }

   public function showTotalTagihanWa(){
        return $this->idms_model->get_total_tagihan_wa();
   }

   public function showTotalOrderSms(){
        return $this->idms_model->get_total_order_sms();
    }

    public function showTotalProsesSms(){
        return $this->idms_model->get_total_proses_sms();
    }

    public function showTotalTagihanSms(){
        return $this->idms_model->get_total_tagihan_sms();
    }

    public function showTotalPaymentSms(){
        return $this->idms_model->get_total_payment_sms();
    }

    public function showTotalOrderEmail(){
        return $this->idms_model->get_total_order_email();
    }

    public function showTotalProsesEmail(){
        return $this->idms_model->get_total_proses_email();
    }

    public function showTotalTagihanEmail(){
        return $this->idms_model->get_total_tagihan_email();
    }

    public function showTotalPaymentEmail(){
        return $this->idms_model->get_total_payment_email();
    }

    public function showTotalOrderOvr(){
        return $this->idms_model->get_total_order_ovr();
    }

    public function showTotalProsesOvr(){
        return $this->idms_model->get_total_proses_ovr();
    }

    public function showTotalTagihanOvr(){
        return $this->idms_model->get_total_tagihan_ovr();
    }

    public function showTotalPaymentOvr(){
        return $this->idms_model->get_total_payment_ovr();
    }

    public function showTotalOrderTvms(){
        return $this->idms_model->get_total_order_tvms();
    }

    public function showTotalProsesTvms(){
        return $this->idms_model->get_total_proses_tvms();
    }

    public function showTotalTagihanTvms(){
        return $this->idms_model->get_total_tagihan_tvms();
    }

    public function showTotalPaymentTvms(){
        return $this->idms_model->get_total_payment_tvms();
    }

    public function showTotalOrderObc(){
        return $this->idms_model->get_total_order_obc();
    }

    public function showTotalProsesObc(){
        return $this->idms_model->get_total_proses_obc();
    }

    public function showTotalTagihanObc(){
        return $this->idms_model->get_total_tagihan_obc();
    }

    public function showTotalPaymentObc(){
        return $this->idms_model->get_total_payment_obc();
    }

}
