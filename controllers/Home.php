<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->view('home/home', array('returnURL'=>$this->input->get('returnURL')));	
	}

	public function mainpage()
	{
		$this->load->view('template/header');
		$this->load->view('home/main');
		$this->load->view('template/footer');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->load->helper('url');
		redirect('/');
	}
	
	public function test()
	{
		$this->load->view('test');
	}

}
