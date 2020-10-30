<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Back extends CI_Controller
{

    public $data = [];

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') != true) {
            return redirect('welcome/index');
        }
    }

    public function dashboard()
    {
        $data['title'] = 'DEMOCRATIE 2.0 - Tableau de bord';
        $user_id = $this->session->userdata('id');

        

        $this->load->view('partials/header', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('partials/footer');
    }
}
