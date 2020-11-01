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
            'rules' => 'required',
        ],
    ],

    'welcome/signin' => [
        [
            'field' => 'email',
            'label' => 'email',
            'rules' => 'required|valid_email',
        ],

        [
            'field' => 'pseudo',
            'label' => 'pseudo',
            'rules' => 'required|valid_email',
        ],

        [
            'field' => 'password',
            'label' => 'mot de passe',
            'rules' => 'required',
        ],
    ],

    'welcome/new_password' => [
        [
            'field' => 'email',
            'label' => 'email',
            'rules' => 'required',
        ],

        [
            'field' => 'password',
            'label' => 'mot de passe',
            'rules' => 'required',
        ],
    ],

    'back/add_prop' => [
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
]
?>
