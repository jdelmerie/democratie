<div class="container">
    <div class="row pt-5">
        <div class="col-10">
            <h2>Bienvenue <?=ucfirst($user->pseudo)?></h2>
        </div>
        <div class="col-2">
            <a href="/welcome/logout">Se déconnecter</a>
        </div>
    </div>
    <div class="pt-3">
        <h3>Vos propositions</h3>
        <p>Nombre de propositions : <?=$count?></p>


<?if ($this->session->flashdata('success')) {?>
<div class="alert alert-success" role="alert">
<?echo $this->session->flashdata('success') ?>
</div>
<?}?>

<?if (isset($userProps) && count($userProps)) {?>
       <hr>
<table class="table text-center">
    <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Titre</th>
            <th scope="col">Soumise au vote</th>
            <th scope="col">Pour</th>
            <th scope="col">Contre</th>
            <th scope="col">Modifier</th>
            <th scope="col">Supprimer</th>
        </tr>
    </thead>
    <?foreach ($userProps as $userProp) {
    $soumisson = $userProp->soumission == 1 ? 'Oui' : 'Non';
    $color = $userProp->soumission == 1 ? 'text-success' : 'text-danger';
    ?>
    <tbody>
        <tr>
            <th scope="row"><?=$userProp->id?></th>
            <td><?=$userProp->title?></td>
            <td class="font-weight-bold <?=$color?>"><?=$soumisson?></td>
            <td><?=$userProp->pour?></td>
            <td><?=$userProp->contre?></td>
            <?if ($userProp->soumission == 0) {?>
            <td><a href="/back/edit_prop/<?=$userProp->id?>" class="btn btn-primary">Modifier</a></td>
            <td><a href="/back/delete_prop/<?=$userProp->id?>" class="btn btn-danger">Supprimer</a></td>
            <?}?>
        </tr>
    </tbody>
    <?}?>


</table>
<?}?>
        <a class="btn btn-success" href="/back/new_prop">Ajouter une proposition</a>
    </div>

    <?if (isset($propositions) && count($propositions)) {?>
    <hr>
<h3>Propositions soumises au vote</h3>
<table class="table text-center">
    <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Utilisateur</th>
            <th scope="col">Titre</th>
            <th scope="col">Déjà voté</th>
            <th scope="col">Pour</th>
            <th scope="col">Contre</th>
            <th scope="col">Voir</th>
        </tr>
    </thead>
    <?foreach ($propositions as $proposition) {?>
    <tbody>
        <tr>
            <th scope="row"><?=$proposition->id?></th>
            <td><?=ucfirst($proposition->pseudo)?></td>
            <td><?=$proposition->title?></td>
            <td>
<?foreach ($votes as $vote) {
    if ($proposition->id == $vote->prop_id) {
        echo "<strong>oui</strong>";
    }
}?>
            </td>
            <td><?=$proposition->pour?></td>
            <td><?=$proposition->contre?></td>
            <td><a href="/back/vote_prop/<?=$proposition->id?>" class="btn btn-primary">Voir</a></td>
            </tr>
    </tbody>
    <?}?>
</table>
<?}?>
</div>