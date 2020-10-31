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
    <?foreach ($propositions as $proposition) { 
        $soumisson = $proposition->soumission == 1 ? 'Oui' : 'Non';
        $color = $proposition->soumission == 1 ? 'text-success' : 'text-danger'; 
        ?>
    <tbody>
        <tr>
            <th scope="row"><?=$proposition->id?></th>
            <td><?=$proposition->title?></td>
            <td class="font-weight-bold <?=$color?>"><?=$soumisson?></td>
            <td><?=$proposition->pour?></td>
            <td><?=$proposition->contre?></td>
            <? if ($proposition->soumission == 0) { ?>
            <td><a href="/back/edit_prop/<?=$proposition->id?>" class="btn btn-primary">Modifier</a></td>
            <td><a href="/back/delete_prop/<?=$proposition->id?>" class="btn btn-danger">Supprimer</a></td>
            <?}?>
        </tr>
    </tbody>
    <?}?>
</table>
