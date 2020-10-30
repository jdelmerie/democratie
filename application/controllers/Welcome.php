<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public $data = [];

	public function index()
	{
		$data['title'] = 'DEMOCRATIE 2.0';

		$this->load->view('partials/header', $data);
		$this->load->view('home');
		$this->load->view('partials/footer');
	}
}
