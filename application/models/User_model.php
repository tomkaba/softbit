<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
 
 
class Picture_model extends CI_Model
{
 
	public function read($id=0){
       
	   if($id>0) $this->db->where('autoid',$id);
	   $this->db->from('pictures');
	   $query=$this->db->get();
       return ($id>0) ? $query->row_array():$query->result_array();
	
	}
 
	public function insert($data){
		if(!isset($data['filename'])||!isset($data['title'])) return FALSE;
		
		$db_data=array(
			'filename' => $data['filename'],
			'title' => $data['title']
		);
		
		$this->db->insert('pictures',$db_data);
		
		return $this->db->insert_id();
	}
 
 
 
	public function counters() {
		$this->db->from('pictures');
		$data['posts_cnt']=$this->db->get()->num_rows();

		$this->db->from('views');
		$data['views_cnt']=$this->db->get()->row()->cnt;
		
		echo json_encode($data);
		return TRUE;
	}
 
}