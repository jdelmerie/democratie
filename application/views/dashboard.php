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
        <hr>

<?if ($this->session->flashdata('success')) {?>
<div class="alert alert-success" role="alert">
<?echo $this->session->flashdata('success') ?>
</div>
<?}?>

        <?echo $displayuserprop ?>
        <a class="btn btn-success" href="/back/new_prop">Ajouter une proposition</a>
    </div>
    <?echo $displayprop ?>
</div>