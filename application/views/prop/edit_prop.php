<div class="container">
    <div class="pt-5">
        <div class="pb-3">
            <h2>Modifier une nouvelle proposition</h2>
        </div>

        <form method="POST" action="<?echo base_url("back/edit_done/$prop->id") ?>">
            <div class="form-group">
                <strong>Titre</strong><?php echo form_error('title', ' <small class="text-danger">', '</small>'); ?>
                <input type="text" class="form-control" value="<?php echo $prop->title ?>" name="title" placeholder="Entrez le titre de votre proposition ici">
            </div>
            <div class="form-group">
                <strong>Texte </strong><?php echo form_error('text', ' <small class="text-danger">', '</small>'); ?>
                <textarea class="form-control" name="text" cols="30" rows="10" placeholder="Entrez votre proposition ici"><?php echo $prop->text ?></textarea>
                <small class="form-text text-muted">Lorsque vous créez une proposition, vous votez forcément pour elle.</small>
            </div>
            <input class="btn btn-primary" type="submit" value="Modifier la proposition">&nbsp;
            <a class="btn btn-warning" href="/back/soumission_prop/<?=$prop->id?>">Soumettre au vote</a>
        </form>
        <hr>
        <a href="/back/dashboard">Revenir au tableau de bord</a>
    </div>
</div>