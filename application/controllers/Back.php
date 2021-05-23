<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Back extends CI_Controller
{
    public $data = [];
    public $user;
    public $title = "Démocratie 2.0";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model', 'users');
        $this->load->model('Propositions_model', 'propositions');
        $this->load->model('Votes_model', 'votes');
        $this->load->model('Commentaires_model', 'commentaires');
        $this->user = $this->users->getUser($this->session->userdata('session'));
        if ($this->session->userdata('logged_in') != true) {
            $this->session->set_flashdata('error_co', 'Vous devez être connecté pour accédérer à cette page.');
            return redirect('welcome/index');
        }
    }

    public function dashboard()
    {
        $data['title'] = $this->title . ' - Tableau de bord';
        $data['user'] = $this->user;
        $data['userProps'] = $this->propositions->getUserProps($this->user->id);
        $data['count'] = count($data['userProps']);
        $data['propositions'] = $this->propositions->getAll();
        $data['votes'] = $this->votes->getUsersVote($this->user->id);
        $this->load->view('partials/header', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('partials/footer');
    }

    public function new_prop()
    {
        $data['title'] = $this->title . ' - Ajouter une proposition';
        $this->load->view('partials/header', $data);
        $this->load->view('prop/new_prop', $data);
        $this->load->view('partials/footer');
    }

    public function add_prop()
    {
        $title = $this->input->post("title");
        $text = $this->input->post("text");

        if ($this->form_validation->run() == true) {
            $this->propositions->add(['user_id' => $this->user->id, 'title' => $title, 'text' => $text, 'pour' => 1]);
            $this->votes->add(['user_id' => $this->user->id, 'prop_id' => $this->db->insert_id()]);
            $this->session->set_flashdata('success', "Proposition ajoutée.");
            redirect('back/dashboard');
        }
        $this->new_prop();
    }

    public function edit_prop($id)
    {
        $data['title'] = $this->title . ' - Modifier une proposition';
        $data['prop'] = $this->propositions->findById($id);
        $this->load->view('partials/header', $data);
        $this->load->view('prop/edit_prop', $data);
        $this->load->view('partials/footer');
    }

    public function edit_done($id)
    {
        $title = $this->input->post("title");
        $text = $this->input->post("text");

        if ($this->form_validation->run() == true) {
            $this->propositions->update($id, ['title' => $title, 'text' => $text]);
            $this->session->set_flashdata('success', "Proposition modifiée.");
            redirect('back/dashboard');
        }
        $this->edit_prop($id);
    }

    public function soumission_prop($id)
    {
        $this->propositions->update($id, ['soumission' => 1]);
        $this->session->set_flashdata('success', "Votre proposition a bien été soumise aux votes.");
        redirect('back/dashboard');
    }

    public function delete_prop($id)
    {
        $this->propositions->delete($id);
        $this->session->set_flashdata('success', "Votre proposition a bien été supprimée.");
        redirect('back/dashboard');
    }

    public function vote_prop($id)
    {
        $data['title'] = $this->title . " - Proposition n°$id";
        $data['proposition'] = $this->propositions->findById($id);
        $data['voted'] = $this->votes->checkUserVote($id, $this->user->id);
        $data['comments'] = $this->commentaires->getAll($id);

        // echo "<pre>";
        // print_r($data['comments']);
        // echo "</pre>";

        $this->load->view('partials/header', $data);
        $this->load->view('prop/prop', $data);
        $this->load->view('partials/footer');
    }

    public function action()
    {
        $vote = $this->input->get('vote', true);
        $prop_id = $this->input->get('id', true);
        $prop = $this->propositions->findById($prop_id);

        if ($vote == 'pour') {
            $prop->pour++;
        } else if ($vote == 'contre') {
            $prop->contre++;
        } else {
            $this->session->set_flashdata('success', "On ne peut voter que pour ou contre.");
            redirect("back/vote_prop/$prop_id");
        }

        $this->propositions->update($prop_id, ['id' => $prop_id, 'pour' => $prop->pour, 'contre' => $prop->contre]);
        $this->votes->add(['user_id' => $this->user->id, 'prop_id' => $prop_id]);
        $this->session->set_flashdata('success', "Votre vote a bien été enregistré.");
        redirect("back/vote_prop/$prop_id");
    }

    public function add_comment($id)
    {
        $comment = $this->input->post("comment");

        if ($this->form_validation->run() == true) {
            $this->commentaires->add(['comment' => $comment, 'user_id' => $this->user->id, 'prop_id' => $id]);
            $this->session->set_flashdata('success', "Votre commentaire a bien été ajouté.");
            redirect("back/vote_prop/$id");
        }
        $this->vote_prop($id);
    }
}
