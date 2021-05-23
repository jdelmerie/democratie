<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public $data = [];
    public $title = "Démocratie 2.0";

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Users_model', 'users');
    }

    public function index()
    {
        $data['title'] = $this->title;
        $this->load->view('partials/header', $data);
        $this->load->view('home');
        $this->load->view('partials/footer');
    }

    public function login()
    {
        $pseudo = $this->input->post("pseudo");
        $password = $this->input->post("password");

        if ($this->form_validation->run() == true) {

            $user = $this->users->getUserByPseudo($pseudo);

            if (empty($user)) {
                $this->session->set_flashdata('error', "Erreur de connexion.");
                redirect('welcome/index');
            }

            if ($user && $user->actif == 1 && password_verify($password, $user->password)) {
                $session = session_id();
                $this->users->update($user->id, ['session' => $session]);
                $this->session->set_userdata(['session' => $session, 'logged_in' => true]);
                redirect('back/dashboard');
            }
        }
        $this->index();

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
        $email = $this->input->post("email");
        $pseudo = $this->input->post("pseudo");
        $password = $this->input->post("password");

        if ($this->form_validation->run() == true) {
            $session = session_id();
            $data = ['email' => $email, 'pseudo' => $pseudo, 'password' => password_hash($password, PASSWORD_DEFAULT), 'session' => $session];

            $this->users->add($data);

            $lien = "<a href=" . base_url("/welcome/validation?session=$session") . ">ICI</a>";
            $message = "Pour valider votre compte, cliquez sur le lien : $lien";
            $this->email->from(SMTP_USER, 'Démocratie 2.0');
            $this->email->to($email);
            $this->email->subject('Création de compte pour Démocratie 2.0');
            $this->email->message($message);
            $this->email->send();

            $this->session->set_flashdata('success', "<strong>Votre compte a bien été créé.</strong><br> Vous allez recevoir un email de validation.");
            redirect('welcome/index');
        }
        $this->index();
    }

    public function validation()
    {
        $session = $this->input->get('session', true);
        $user = $this->users->getUser($session);
        if ($user) {
            $this->users->update($user->id, ['actif' => 1]);
            $this->session->set_flashdata('success', 'Votre compte a bien été validé, vous pouvez vous connecter.');
            redirect('welcome/index');
        } else {
            $this->session->set_flashdata('error', "Une erreur s'est produite.");
            redirect('welcome/index');
        }
    }

    public function forgotten_password()
    {
        $data['title'] = $this->title . ' - Mot de passe oublié';
        $this->load->view('partials/header', $data);
        $this->load->view('partials/forgotten_password');
        $this->load->view('partials/footer');
    }

    public function new_password()
    {

        $email = $this->input->post("email");
        $password = $this->input->post("password");

        if ($this->form_validation->run() == true) {

            $user = $this->users->getUserByEmail($email);

            if ($user) {
                $this->users->update($user->id, ['password' => password_hash($password, PASSWORD_DEFAULT)]);
                $this->session->set_flashdata('success', 'Votre mot de passe a été modifié, vous pouvez vous connecter.');
            } else {
                $this->session->set_flashdata('error', "Une erreur s'est produite.");
            }
            redirect('welcome/forgotten_password');
        }
        $this->forgotten_password();
    }

}
