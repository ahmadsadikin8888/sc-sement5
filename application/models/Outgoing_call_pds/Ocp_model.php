<?php
  
Class Ocp_model extends CI_Model
{
   public function create_cdr(string $call_id, string $ext, string $dest)
   {
      $data = array(
         'call_id' => $call_id,
         'ext' => $ext,
         'dest' => $dest
      );
      $insert = $this->db->insert('ocp', $data);
      if ($insert) {
         $response = array();
         $response['error'] = false;
         $response['message'] = 'Successfully added cdr data';
         return $response;
      }
      $response = array();
         $response['error'] = true;
         $response['message'] = $this->db->error();
         return $response;
   }
 
   public function read_cdr()
   {
      $this->db->order_by('call_id', 'DESC');
      $query = $this->db->get('cdr');
      if ($query->num_rows() > 0) {
         $response = array();
         $response['error'] = false;
         $response['message'] = 'Successfully retrieved cdr data';
         foreach ($query->result() as $row) {
            $tempArray = array();
            $tempArray['call_id'] = (int)$row->call_id;
            $tempArray['starttime'] = $row->starttime;
            $tempArray['transtime'] = $row->transtime;
            $tempArray['endtime'] = $row->endtime;
            $tempArray['queue'] = $row->queue;
            $tempArray['exten'] = $row->exten;
            $tempArray['outbound_cid'] = $row->outbound_cid;
            $tempArray['dst'] = $row->dst;
            $tempArray['duration'] = $row->duration;
            $tempArray['billsec'] = $row->billsec;
            $tempArray['a_status'] = $row->a_status;
            $tempArray['b_status'] = $row->b_status;
            $tempArray['pbx_domain'] = $row->pbx_domain;
            $tempArray['recordingfile'] = $row->recordingfile;
            // $tempArray['image'] = 'http://127.0.0.1:8000/image/'.$row->image;
            $response['data'][] = $tempArray;
         }
         return $response;
      }
      $response = array();
      $response['error'] = true;
      $response['message'] = $this->db->error();
      return $response;
   }
 
   public function update_cdr(string $call_id, string $starttime, string $transtime, string $endtime, string $queue, string $exten, string $outbound_cid, 
   string $dst, string $duration, string $billsec, string $a_status, string $b_status, string $pbx_domain, string $recordingfile)
   {
      $count = $this->db->get_where('cdr', array('call_id'=>$call_id))->num_rows();
      if($count > 0) {
         $update = $this->db->query(
            "UPDATE `cdr` 
             SET 
               starttime='$starttime', 
               transtime='$transtime', 
               endtime='$endtime',
               `queue`=$queue, 
               exten=$exten, 
               outbound_cid='$outbound_cid', 
               dst='$dst',
               duration='$duration', 
               billsec='$billsec', 
               a_status='$a_status', 
               b_status='$b_status',
               pbx_domain='$pbx_domain', 
               recordingfile='$recordingfile'
             WHERE call_id = '$call_id' "
         );
         if ($update) {
            $response = array();
            $response['error'] = false;
            $response['message'] = 'Successfully changed cdr data';
            $response['count'] = $count;
            return $response;
         }
      } else {
         $response = array();
         $response['error'] = true;
         $response['message'] = "Data with call_id: ". $call_id ." not found";
         return $response;   
      }
      $response = array();
         $response['error'] = true;
         $response['message'] = $this->db->error();
         return $response;
   }
 
   public function delete_cdr(string $call_id)
   {
      $call_id = $call_id;
      $count = $this->db->get_where('cdr', array('call_id'=>$call_id))->num_rows();
      if($count > 0) {
         $delete = $this->db->query('DELETE FROM `cdr` WHERE call_id = '. $call_id);
         if ($delete) {
            $response = array();
            $response['error'] = false;
            $response['message'] = 'Successfully deleted cdr data';
            return $response;
         }
      } else {
         $response = array();
         $response['error'] = true;
         $response['message'] = "Data with call_id: ". $call_id ." not found";
         return $response;
      }
      $response = array();
      $response['error'] = true;
      $response['message'] = $this->db->error();
      return $response;
   }
}