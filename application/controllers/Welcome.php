<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	var $user;
	public function __construct()
	{
		parent::__construct();
		$this->user = $this->session->userdata('user');
		if (!$this->user) {
			$this->session->set_flashdata('notify', '<div class="badge badge-info">Silahkan login!</div>');
			redirect(base_url('user/login'));
		}
	}
	public function index()
	{
		$data['user'] = $this->user;
		$this->load->view('templates/header', $data);
	}
}
