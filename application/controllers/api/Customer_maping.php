<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Customer_maping extends CI_Controller
{

    public function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Custom_model/Pelanggan_model', 'pelanggan');
        $this->load->model('Custom_model/Payment_model', 'payment');
        $this->load->model('Custom_model/Profiling_model', 'profiling');
        // $this->load->database();
    }

    public function mapping_channel()
    {
        $pelanggan = $this->pelanggan->get_results();
        $n = 0;
        if ($pelanggan['num'] > 0) {
            foreach ($pelanggan['results'] as $p) {
                $channel = $this->get_channel($p->no_internet);
                if ($channel) {
                    $this->pelanggan->edit(array("id" => $p->id), array("channel" => $channel));
                }

                $n++;
            }
        }
        echo $n;
    }
    public function mapping_besttime()
    {
        $pelanggan = $this->pelanggan->get_results();
        $n = 0;
        if ($pelanggan['num'] > 0) {
            foreach ($pelanggan['results'] as $p) {
                $besttime = $this->get_besttime($p->no_internet);
                if ($besttime) {
                    $this->pelanggan->edit(array("id" => $p->id), array("besttime" => $besttime));
                }

                $n++;
            }
        }
        echo $n;
    }
    public function get_channel($no_internet)
    {
        $channel = $this->profiling->get_row(array("no_internet" => $no_internet));
        if ($channel) {
            return $channel->opsi_call;
        } else {
            return 5;
        }
    }
    public function get_besttime($no_internet)
    {
        $payment = $this->payment->get_results();
        $n = 0;
        $date = 0;
        $rundown = 1;
        if ($payment['num'] > 0) {
            foreach ($payment['results'] as $p) {
                $n++;
                $date = $p->hari + $date;
            }
        }
        $avg = $date / $n;
        if ($avg > 1) {
            $rundown = $avg - 1;
        }
        return $rundown;
    }
}
