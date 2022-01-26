<?php
  
Class Ocp_model extends CI_Model
{
   public function create_ocp(string $call_id, string $ext, string $dest)
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
         $response['message'] = 'Successfully added ocp data';
         return $response;
      }
      $response = array();
         $response['error'] = true;
         $response['message'] = $this->db->error();
         return $response;
   }
 
   public function read_ocp()
   {
      $this->db->order_by('call_id', 'DESC');
      $query = $this->db->get('ocp');
      if ($query->num_rows() > 0) {
         $response = array();
         $response['error'] = false;
         $response['message'] = 'Successfully retrieved ocp data';
         foreach ($query->result() as $row) {
            $tempArray = array();
            $tempArray['call_id'] = (int)$row->call_id;
            $tempArray['ext'] = $row->ext;
            $tempArray['dest'] = $row->dest;
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
 
   public function update_ocp(string $call_id, string $ext, string $dest)
   {
      $count = $this->db->get_where('ocp', array('call_id'=>$call_id))->num_rows();
      if($count > 0) {
         $update = $this->db->query(
            "UPDATE `ocp` 
             SET 
               ext='$ext', 
               dest='$dest'
             WHERE call_id = '$call_id' "
         );
         if ($update) {
            $response = array();
            $response['error'] = false;
            $response['message'] = 'Successfully changed ocp data';
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
 
   public function delete_ocp(string $call_id)
   {
      $call_id = $call_id;
      $count = $this->db->get_where('ocp', array('call_id'=>$call_id))->num_rows();
      if($count > 0) {
         $delete = $this->db->query('DELETE FROM `ocp` WHERE call_id = '. $call_id);
         if ($delete) {
            $response = array();
            $response['error'] = false;
            $response['message'] = 'Successfully deleted ocp data';
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