<?
$config = [
    'welcome/login' => [
        [
            'field' => 'pseudo',
            'label' => 'pseudo',
            'rules' => 'required',
        ],

        [
            'field' => 'password',
            'label' => 'mot de passe',
            'rules' => 'required|trim|min_length[8]',
        ],
    ],

    'welcome/signin' => [
        [
            'field' => 'email',
            'label' => 'email',
            'rules' => 'required|trim|valid_email|is_unique[users.email]',
        ],

        [
            'field' => 'pseudo',
            'label' => 'pseudo',
            'rules' => 'required|is_unique[users.pseudo]',
        ],

        [
            'field' => 'password',
            'label' => 'mot de passe',
            'rules' => 'required|trim|min_length[8]',
        ],
    ],

    'welcome/new_password' => [
        [
            'field' => 'email',
            'label' => 'email',
            'rules' => 'required|trim|valid_email',
        ],

        [
            'field' => 'password',
            'label' => 'mot de passe',
            'rules' => 'required|trim|min_length[8]',
        ],
    ],

    'back/add_prop' => [
        [
            'field' => 'title',
            'label' => 'titre',
            'rules' => 'required',
        ],

        [
            'field' => 'text',
            'label' => 'texte',
            'rules' => 'required',
        ],
    ],

    'back/edit_done' => [
        [
            'field' => 'title',
            'label' => 'title',
            'rules' => 'required',
        ],

        [
            'field' => 'text',
            'label' => 'text',
            'rules' => 'required',
        ],
    ],

    'back/add_comment' => [
        [
            'field' => 'comment',
            'label' => 'commentaire',
            'rules' => 'required',
        ],
    ],
]
?>
