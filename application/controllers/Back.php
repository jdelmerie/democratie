<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Back extends CI_Controller
{
    public $data = [];

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') != true) {
            $this->session->set_flashdata('error_co', 'Vous devez être connecté pour accédérer à cette page.');
            return redirect('welcome/index');
        }
    }

    public function dashboard()
    {
        $data['title'] = 'Démocratie 2.0 - Tableau de bord';
        $user_id = $this->session->userdata('id');

        $this->load->model('Users_model', 'users');
        $this->load->model('Propositions_model', 'propositions');
        $this->load->model('Votes_model', 'votes');

        $data['user'] = $this->users->selectById($user_id);
        $data['propositions'] = $this->propositions->selectUserProp($user_id);
        $data['count'] = $this->propositions->countProp($user_id);
        $data['allpropositions'] = $this->propositions->getAll();
        $data['votes'] = $this->votes->voted();

        if (count($data['propositions']) > 0) {
            $data['displayuserprop'] = $this->load->view('partials/user_prop', $data, true);
        } else {
            $data['displayuserprop'] = '';
        }

        if (count($data['allpropositions']) > 0) {
            $data['displayprop'] = $this->load->view('prop/all_prop', $data, true);
        } else {
            $data['displayprop'] = '';
        }

        $this->load->view('partials/header', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('partials/footer');
    }

    public function new_prop()
    {
        $data['title'] = 'Démocratie 2.0 - Ajouter une proposition';
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
            $this->session->set_flashdata('success', "Proposition ajoutée.");
            redirect('back/dashboard');
        } else {
            $this->session->set_flashdata('error', "Veuillez remplir les champs.");
            redirect('back/new_prop');
        }
    }

    public function edit_prop($prop_id)
    {
        $data['title'] = 'Démocratie 2.0 - Modifier une proposition';
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
            $this->session->set_flashdata('success', "Proposition modifiée.");
            redirect('back/dashboard');
        } else {
            $this->session->set_flashdata('error', "Veuillez remplir les champs.");
            redirect("back/edit_prop/$prop_id");
        }
    }

    public function soumission_prop($prop_id)
    {
        $this->load->model('Propositions_model', 'propositions');
        $data = ['soumission' => 1];
        $this->propositions->soumission($prop_id, $data);
        $this->session->set_flashdata('success', "Votre proposition a bien été soumise aux votes.");
        redirect('back/dashboard');
    }

    public function delete_prop($prop_id)
    {
        $this->load->model('Propositions_model', 'propositions');
        $data['prop'] = $this->propositions->selectById($prop_id);
        $this->propositions->deleteProp($prop_id);
        $this->session->set_flashdata('success', "Votre proposition a bien été supprimée.");
        redirect('back/dashboard');
    }

    public function vote_prop($prop_id)
    {
        $data['title'] = "Démocratie 2.0 - Proposition n°$prop_id";
        $user_id = $this->session->userdata('id');
        $this->load->model('Propositions_model', 'propositions');
        $this->load->model('Votes_model', 'votes');

        $data['prop'] = $this->propositions->selectById($prop_id);
        $data['voted'] = $this->votes->checkvote($prop_id, $user_id);

        $this->load->model('Commentaires_model', 'commentaires');
        $data['comments'] = $this->commentaires->selectAll($prop_id);

        if (count($data['comments']) > 0) {
            $data['displaycom'] = $this->load->view('partials/comments_view', $data, true);
        } else {
            $data['displaycom'] = '';
        }

        if ($data['voted'] == 1) {
            $data['novote'] = 'display: block;';
            $data['vote'] = 'display: none;';
        } else {
            $data['vote'] = 'display: block;';
            $data['novote'] = 'display: none;';
        }

        $this->load->view('partials/header', $data);
        $this->load->view('prop/prop', $data);
        $this->load->view('partials/footer');
    }

    public function action()
    {
        $user_id = $this->session->userdata('id');
        $vote = $this->input->get('vote', true);
        $prop_id = $this->input->get('id', true);

        $this->load->model('Propositions_model', 'propositions');
        
        $data['prop'] = $this->propositions->selectById($prop_id);

        if ($vote == 'pour') {
            $data['prop']->pour++;
        } else if ($vote == 'contre') {
            $data['prop']->contre++;
        } else {
            echo "on ne peut voter que pour ou contre.";
        }


        $data = ['id' => $prop_id, 'pour' => $data['prop']->pour, 'contre' => $data['prop']->contre];
        $this->propositions->updateProp($prop_id, $data);
        $this->load->model('Votes_model', 'votes');
        $datavote = ['user_id' => $user_id, 'prop_id' => $prop_id];
        $this->votes->setVote($datavote);
        $this->session->set_flashdata('success_vote', "Votre vote a bien été enregistré.");
        $this->vote_prop($prop_id);
    }

    public function add_comment($prop_id)
    {
        $this->load->library('form_validation');
        $comment = $this->input->post("comment");
        $user_id = $this->session->userdata('id');

        if ($this->form_validation->run() == true) {
            $this->load->model('Commentaires_model', 'commentaires');
            $data = ['comment' => $comment, 'user_id' => $user_id, 'prop_id' => $prop_id];
            $this->commentaires->add($data);
            $this->vote_prop($prop_id);
        }
    }
}
