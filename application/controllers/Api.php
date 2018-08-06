<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Api extends CI_Controller{
 
       public function __construct() {
	    
				parent::__construct();
               $this->load->model('picture_model');
       }    
	   
       public function get($id=0)
	   {
           $r = $this->picture_model->read($id);
           if($r!==FALSE) 
		   {
			echo json_encode($r);
			return TRUE;
		   }
		   else return FALSE;
       }
	   
       public function post($title="",$filename=""){
		   
		    if(strlen($title)) $data['title']=$title;
		    else $data['title']=$this->input->post('title');
		   
		    if(strlen($filename)) $data['filename']=$filename;
		    elseif (strlen($this->input->post('filename'))) $data['filename']=$this->input->post('filename');
		    else $data['filename']='https://onaliternote.files.wordpress.com/2016/11/wp-1480230666843.jpg';
		   
			$r = $this->picture_model->insert($data);
			if($r!==FALSE) 
			{
				echo json_encode($r);
				return TRUE;
			}
			else return FALSE;
           
       }
	   
	   public function counters() {
			echo json_encode($this->picture_model->counters());
			return TRUE;
	   }
   
 
}