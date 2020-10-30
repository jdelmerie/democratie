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

        $this->load->model('Users_model', 'users');
        $this->load->model('Propositions_model', 'propositions');  

        $data['user'] = $this->users->selectById($user_id);
        $data['propositions'] = $this->propositions->selectUserProp($user_id);
        $data['count'] = $this->propositions->countProp($user_id);

        $data['displayprop'] = '';

        if (count($data['propositions']) > 0) {
            $data['displayprop'] = $this->load->view('partials/user_prop', $data, true);
        }

        // if (count($data['propositions']) > 0) {
        //     echo "y a des prop";
        // } else {
        //     echo "pas de prop";
        // }

        // print_r($data);

        $this->load->view('partials/header', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('partials/footer');
    }
}
