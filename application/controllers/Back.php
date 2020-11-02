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
        $this->load->model('Votes_model', 'votes');

        $data['user'] = $this->users->selectById($user_id);
        $data['propositions'] = $this->propositions->selectUserProp($user_id);
        $data['count'] = $this->propositions->countProp($user_id);
        $data['allpropositions'] = $this->propositions->getAll();
        $data['votes'] = $this->votes->voted();

        $data['displayuserprop'] = '';
        $data['displayprop'] = '';

        if (count($data['propositions']) > 0 || count($data['allpropositions'])) {
            $data['displayuserprop'] = $this->load->view('partials/user_prop', $data, true);
            $data['displayprop'] = $this->load->view('prop/all_prop', $data, true);
        }

        $this->load->view('partials/header', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('partials/footer');
    }

    public function new_prop()
    {
        $data['title'] = 'DEMOCRATIE 2.0 - Ajouter une proposition';
        $this->load->view('partials/header', $data);
        $this->load->view('prop/new_prop', $data);
        $this->load->view('partials/footer');
    }

    public function add_prop()
    {
        $this->load->library('form_validation');

        $user_id = $this->session->userdata('id');
        $title = $this->input->post("title");
        $text = $this->input->post("text");
        $pour = 1;

        if ($this->form_validation->run() == true) {
            $this->load->model('Propositions_model', 'propositions');
            $this->load->model('Votes_model', 'votes');
            $data = ['user_id' => $user_id, 'title' => $title, 'text' => $text, 'pour' => $pour];
            $this->propositions->addProp($data);

            $prop_id = $this->db->insert_id();
            $data = ['user_id' => $user_id, 'prop_id' => $prop_id];
            $this->votes->setVote($data);
            redirect('back/dashboard');
        } else {
            echo "erreur de saisie";
        }
    }

    public function edit_prop($prop_id)
    {
        $data['title'] = 'DEMOCRATIE 2.0 - Modifier une proposition';
        $this->load->model('Propositions_model', 'propositions');
        $data['prop'] = $this->propositions->selectById($prop_id);

        $this->load->view('partials/header', $data);
        $this->load->view('prop/edit_prop', $data);
        $this->load->view('partials/footer');
    }

    public function edit_done($prop_id)
    {
        $this->edit_prop($prop_id);

        $this->load->library('form_validation');
        $title = $this->input->post("title");
        $text = $this->input->post("text");

        if ($this->form_validation->run() == true) {
            $this->load->model('Propositions_model', 'propositions');
            $data = ['title' => $title, 'text' => $text];
            $this->propositions->updateProp($prop_id, $data);
            redirect('back/dashboard');
        } else {
            echo "erreur";
        }
    }

    public function soumission_prop($prop_id)
    {
        $this->load->model('Propositions_model', 'propositions');
        $data = ['soumission' => 1];
        $this->propositions->soumission($prop_id, $data);
        redirect('back/dashboard');
    }

    public function delete_prop($prop_id)
    {
        $this->load->model('Propositions_model', 'propositions');
        $data['prop'] = $this->propositions->selectById($prop_id);
        $this->propositions->deleteProp($prop_id);
        echo "prop supprimé";
    }

    public function vote_prop($prop_id)
    {
        $data['title'] = "DEMOCRATIE 2.0 - Proposition n°$prop_id";

        $this->load->model('Propositions_model', 'propositions');
        $data['prop'] = $this->propositions->selectById($prop_id);
        $this->load->model('Votes_model', 'votes');

        $data['voted'] = $this->votes->checkvote($prop_id, $data['prop']->user_id);

        if ($data['voted'] == 1) {
            $data['vote'] = 'Vous avez déjà voté pour cette proposition.';
        } else {
            $data['vote'] = $this->load->view('partials/button_vote', $data, true);
        }

        $this->load->view('partials/header', $data);
        $this->load->view('prop/prop', $data);
        $this->load->view('partials/footer');
    }
}
