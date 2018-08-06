<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Picture_model extends CI_Model
{
 
	public function read($id=0){
       if($id>0) $this->db->where('autoid',$id);
	   $this->db->from('pictures');
	   $query=$this->db->get();
       return $query->result_array();
	}
 
	public function insert($data){
		if(!isset($data['filename'])||!isset($data['title'])) return FALSE;
		
		
		$new_name=(rand()%1000)."_".time()."_".basename($data['filename']);
		
		if(copy($data['filename'],'./uploads/'.$new_name))
		{
			$db_data=array(
				'filename' => $new_name,
				'title' => $data['title']
			);
			
			$this->db->insert('pictures',$db_data);
			return array($this->db->insert_id(),$new_name);
		}
		else
			return FALSE;
	}
 
 
 
	public function counters() {
		$this->db->from('pictures');
		$data['posts_cnt']=$this->db->get()->num_rows();

		$this->db->from('views');
		$data['views_cnt']=$this->db->get()->row()->cnt;
		
		return $data;
	}
 
}