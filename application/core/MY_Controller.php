<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
  public $title = ' | POLRESTA PALEMBANG';
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
	}

	public function template($data, $template = 'admin')
	{
	    if ($template == 'admin') {
	      return $this->load->view('admin/template/layout', $data);
	    }
	    elseif ($template == 'kabag_sumda') {
	      return $this->load->view('kabag_sumda/template/layout', $data);
	    }
      elseif ($template == 'admin-gudang') {
	      return $this->load->view('admin-gudang/template/layout', $data);
	    }
	}

	public function POST($name)
	{
		return $this->input->post($name);
	}

	public function flashmsg($msg, $type = 'success',$name='msg')
	{
		return $this->session->set_flashdata($name, '<div class="alert alert-'.$type.' alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$msg.'</div>');
	}

	public function upload($id, $directory, $tag_name = 'userfile')
	{
		if ($_FILES[$tag_name])
		{
			$upload_path = realpath(APPPATH . '../assets/img/' . $directory . '/');
			@unlink($upload_path . '/' . $id . '.jpg');
			$config = [
				'file_name' 		=> $id . '.jpg',
				'allowed_types'		=> 'jpg|png|bmp|jpeg',
				'upload_path'		=> $upload_path
			];
			$this->load->library('upload');
			$this->upload->initialize($config);
			return $this->upload->do_upload($tag_name);
		}
		return FALSE;
	}

	public function dump($var)
	{
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}
}
