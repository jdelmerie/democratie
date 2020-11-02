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
    <?foreach ($allpropositions as $proposition) {?>
    <tbody>
        <tr>
            <th scope="row"><?=$proposition->id?></th>
            <td><?=ucfirst($proposition->pseudo)?></td>
            <td><?=$proposition->title?></td>
            <td><?
    foreach ($votes as $vote) {
        if ($proposition->id == $vote->prop_id && $proposition->user_id == $vote->user_id) {
            echo "<strong>oui</strong>";
            break;
        }
    }
    ?></td>
            <td><?=$proposition->pour?></td>
            <td><?=$proposition->contre?></td>
            <td><a href="/back/vote_prop/<?=$proposition->id?>" class="btn btn-primary">Voir</a></td>
            </tr>
    </tbody>
            <?}?>
</table>
