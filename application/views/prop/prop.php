<div class="container">
    <div class="row mt-5">
        <div class="col-8">
            <h2>Propositon n°<?=$proposition->id?></h2>
        </div>
        <div class="col-4">
            <a href="/back/dashboard">Revenir au tableau de bord</a>
        </div>
    </div>
    <hr>
    <h3><?=ucfirst($proposition->title)?></h3>
    <p><?=ucfirst($proposition->text)?></p>

    <h4>Votes</h4>
    <ul>
        <li>Pour : <?=$proposition->pour?></li>
        <li>Contre : <?=$proposition->contre?></li>
    </ul>

<?if ($voted == 1) {?>
        <p class="text-danger font-weight-bold">Vous avez déjà voté pour cette proposition.</p>
<?} else {?>
        <a href="/back/action?id=<?=$proposition->id?>&vote=pour" class="btn btn-success">Pour</a>
        <a href="/back/action?id=<?=$proposition->id?>&vote=contre" class="btn btn-danger">Contre</a>
<?}?>
<?if ($this->session->flashdata('success')) {?>
<div class="alert alert-success" role="alert">
<?echo $this->session->flashdata('success') ?>
</div>
<?} else if ($this->session->flashdata('error')) {?>
<div class="alert alert-success" role="alert">
<?echo $this->session->flashdata('error') ?>
</div>
<?}?>


    <hr>
    <h4>Ajouter un commentaire</h4>
    <form method="POST" action="<?echo base_url("back/add_comment/$proposition->id") ?>">
        <div class="form-group">
            <textarea name="comment" class="form-control" rows="3" placeholder="Laisser un commentaire"></textarea>
            <?php echo form_error('comment', ' <small class="text-danger">', '</small>'); ?>
        </div>
        <input class="btn btn-primary" type="submit" value="Publier">
    </form>

   <?if (isset($comments) && count($comments)) {?>
    <?foreach ($comments as $comment) {
    setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
    $time = $heure_fr = strftime('%e %B %Y à %H:%M', strtotime($comment->time));
    ?>
<hr>
<div class="border p-3 m-3">
    <p><strong><?=ucfirst($comment->pseudo)?></strong><br><em>Le <?=$time?></em></p>
    <p><?=$comment->comment?></p>
</div>
<?}?>
<?}?>
</div>
</div>

