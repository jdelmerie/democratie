<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public $data = [];

    public function index()
    {
        $data['title'] = 'Démocratie 2.0';

        $this->load->view('partials/header', $data);
        $this->load->view('home');
        $this->load->view('partials/footer');
    }

    public function login()
    {
        $this->load->library('form_validation');

        $pseudo = $this->input->post("pseudo");
        $password = $this->input->post("password");

        if ($this->form_validation->run() == true) {

            $this->load->model('Users_model', 'users');
            $user = $this->users->selectUser($pseudo);

            if ($pseudo == $user->pseudo && $user->actif == 1 && password_verify($password, $user->password)) {
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

    public function signin()
    {
        $this->load->library('form_validation');
        $this->load->library('email');

        $email = $this->input->post("email");
        $pseudo = $this->input->post("pseudo");
        $password = $this->input->post("password");

        $hash = password_hash($password, PASSWORD_DEFAULT);

        if ($this->form_validation->run() == true) {
            $this->load->model('Users_model', 'users');
            $data = ['email' => $email, 'pseudo' => $pseudo, 'password' => $hash, 'actif' => 0];
            $this->users->addUser($data);
            $user_id = $this->db->insert_id();
            $this->sendmail($user_id, $hash, $email);
            redirect('welcome/index');
        } else {
            echo "erreur de saisie";
        }
    }

    public function sendmail($user_id, $hash, $email)
    {
        $lien_validation = "<a href='http://democratie.local/welcome/checkuser?id=$user_id&hash=$hash'>ICI</a>";
        $objet = 'Création de compte pour Démocratie 2.0';
        $message = "Pour valider votre compte, cliquez sur le lien : $lien_validation";

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp-delmerie.alwaysdata.net';
        $config['smtp_port'] = 587;
        $config['smtp_user'] = 'delmerie@alwaysdata.net';
        $config['smtp_pass'] = 'Sebastian18*"&';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = true;
        $this->email->initialize($config);

        $this->email->from('delmerie@alwaysdata.net', 'No Reply');
        $this->email->to($email);
        $this->email->subject($objet);
        $this->email->message($message);
        $this->email->send();
    }

    public function checkUser()
    {
        $id = $this->input->get('id', true);

        $this->load->model('Users_model', 'users');
        $user = $this->users->selectById($id);

        if ($user->id == $id) {
            $data = ['actif' => 1];
            $this->users->validation($id, $data);
            redirect('welcome/index');
        }
    }

    public function forgotten_password()
    {
        $data['title'] = 'Démocratie 2.0 - Mot de passe oublié';

        $this->load->view('partials/header', $data);
        $this->load->view('partials/forgotten_password');
        $this->load->view('partials/footer');
    }

    public function new_password()
    {
        $this->load->library('form_validation');

        $email = $this->input->post("email");
        $password = $this->input->post("password");

        if ($this->form_validation->run() == true) {
            $this->load->model('Users_model', 'users');
            $user = $this->users->selectByEmail($email);
            $new_password = password_hash($password, PASSWORD_DEFAULT);
            $data = ['password' => $new_password];
            $this->users->updatePwd($data, $email);
            redirect('dashboard/index');
        } else {
            echo "Erreur";
        }
    }
}
