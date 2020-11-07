<div class="container">
    <div class="pt-5">
        <div class="pb-3">
            <h2>Modifier une nouvelle proposition</h2>
        </div>

        <form method="POST" action="<? echo base_url("/back/edit_done/$prop->id")  ?>">
            <div class="form-group">
                <strong>Titre *</strong>
                <input type="text" class="form-control" name="title" placeholder="Entrez le titre de votre proposition ici" value="<?=$prop->title?>">
            </div>
            <div class="form-group">
                <strong>Texte *</strong>
                <textarea class="form-control" name="text" cols="30" rows="10" placeholder="Entrez votre proposition ici"><?=$prop->text?></textarea>
            </div>
            <input class="btn btn-primary" type="submit" value="Modifier la proposition">&nbsp;
            <a class="btn btn-warning" href="/back/soumission_prop/<?=$prop->id?>">Soumettre au vote</a>
        </form><hr>
<?if ($this->session->flashdata('error')) {?>
<div class="alert alert-danger" role="alert">
<?echo $this->session->flashdata('error') ?>
</div>
<?}?>
        <a href="/back/dashboard">Revenir au tableau de bord</a>
    </div>
</div>