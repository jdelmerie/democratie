<div class="container">
    <div class="row mt-5">
        <div class="col-8">
            <h2>Propositon n°<?=$prop->id?></h2>
        </div>
        <div class="col-4">
            <a href="/back/dashboard">Revenir au tableau de bord</a>
        </div>
    </div>
    <hr>
    <h1><?=ucfirst($prop->title)?></h1>
    <p><?=ucfirst($prop->text)?></p>

    <h3>Votes</h3>
    <ul>
        <li>Pour : <?=$prop->pour?></li>
        <li>Contre : <?=$prop->contre?></li>
    </ul>

    <div style="<?echo $novote ?>">
        <p class="text-danger font-weight-bold">Vous avez déjà voté pour cette proposition.</p>
    </div>

    <div style="<?echo $vote ?>">
        <a href="/back/action?id=<?=$prop->id?>&vote=pour" class="btn btn-success">Voter Pour</a>
        <a href="/back/action?id=<?=$prop->id?>&vote=contre" class="btn btn-danger">Voter Contre</a>
    </div>
    
    <hr>
    <h4>Ajouter un commentaire</h4>
    <form method="POST" action="<?echo base_url("back/add_comment/$prop->id") ?>">
        <div class="form-group">
            <textarea name="comment" class="form-control" rows="3" placeholder="Laisser un commentaire"></textarea>
        </div>
        <input class="btn btn-primary" type="submit" value="Publier">
    </form>


    <?echo $displaycom ?>

</div>
</div>

