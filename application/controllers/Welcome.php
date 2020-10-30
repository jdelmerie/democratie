<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public $data = [];

    public function index()
    {
        $data['title'] = 'DEMOCRATIE 2.0';

        $this->load->view('partials/header', $data);
        $this->load->view('home');
        $this->load->view('partials/footer');
    }

    public function login()
    {
        $this->load->library('form_validation');

        $data['message'] = 'Erreur de connexion';

        $pseudo = $this->input->post("pseudo");
        $password = $this->input->post("password");

        if ($this->form_validation->run() == true) {

            $this->load->model('Users_model', 'users');
            $user = $this->users->selectUser($pseudo);

            if ($pseudo == $user->pseudo && $password == $user->password) {
                $user_session = ['pseudo' => $pseudo, 'password' => $password, 'id' => $user->id, 'logged_in' => true];
                $this->session->set_userdata($user_session);
				redirect('back/dashboard');
            } else {
                echo "connexion pas ok";
            }
        } else {
            echo "connexion pas ok";
        }
	}
	
	public function logout()
    {
        $user = ['pseudo, password, id, logged_in'];
        $this->session->unset_userdata($user);
        $this->session->sess_destroy();
        redirect('welcome/index');
    }
}
