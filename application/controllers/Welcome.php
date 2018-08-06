<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	public function counters()
	{
		$this->db->from('pictures');
		$data['posts_cnt']=$this->db->get()->num_rows();

		$this->db->from('views');
		$data['views_cnt']=$this->db->get()->row()->cnt;
		
		echo json_encode($data);
		return TRUE;
	
	}
	
	public function zip()
	{
		$this->db->select('title');
		$this->db->select('filename');
		$this->db->from('pictures');
		
		$pictures=$this->db->get()->result_array();
	
		$csvfilename="csv_".time()."_".(rand()%1000).".csv";
		$f=fopen('./downloads/'.$csvfilename,"w+");
		
		$archivefilename="archive_".time()."_".(rand()%1000).".zip";
		$zip= new ZipArchive();
		$zip->open('./downloads/'.$archivefilename, ZIPARCHIVE::CREATE );
		
		
		foreach($pictures as $p)
		{
			fputcsv($f,$p);
			
			$r=$zip->addFile('./uploads/'.$p['filename'],$p['filename']);
			//var_dump($r);
		}
		fclose($f);
		
		$r=$zip->addFile('./downloads/'.$csvfilename,$csvfilename);
		//var_dump($r);
		$zip->close();
		
		
		header("Content-type: application/zip"); 
		header("Content-Disposition: attachment; filename=$archivefilename");
		header("Content-length: " . filesize('./downloads/'.$archivefilename));
		header("Pragma: no-cache"); 
		header("Expires: 0"); 
		readfile('./downloads/'.$archivefilename);
	}
	
	
	public function index()
	{
		if($this->input->post('submit'))
		{
			$config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 20000;
			$config['max_width']            = 1920;
            $config['max_height']           = 1080;

            $this->load->library('upload', $config);
			
            if ( ! $this->upload->do_upload('userfile'))
                $data['error']=$this->upload->display_errors();
            else
            {
                $data = array('upload_data' => $this->upload->data());
				
				$db_data=array(
					'title' => strlen($this->input->post('title'))?$this->input->post('title'):"",
					'filename' => $data['upload_data']['file_name']
				);
				
				$insertId=$this->db->insert('pictures',$db_data);
				if(!$insertId)
				{
					$data['error']=$this->db->error();
				}
				
					
				$data['info']='Image successfully uploaded';
            }
		}
		
		
		$this->db->set('cnt','cnt+1',FALSE);
		$this->db->update('views');
		
		$this->db->from('pictures');
		$this->db->order_by('autoid','desc');
		$data['pictures']=$this->db->get()->result();
		
		$this->db->from('pictures');
		$data['posts_cnt']=$this->db->get()->num_rows();

		$this->db->from('views');
		$data['views_cnt']=$this->db->get()->row()->cnt;
		
		$data['view']='main';
		$this->load->view('layout',$data);
	}
}
