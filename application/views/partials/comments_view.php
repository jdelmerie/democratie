<? foreach ($comments as $comment) {
    setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
    $time = $heure_fr = strftime('%e %B %Y à %H:%M', strtotime($comment->time));
    ?>
<hr>
<div class="border p-3 m-3">
    <p><strong><?=ucfirst($comment->pseudo)?></strong><br><em>Le <?=$time?></em></p>
    <p><?=$comment->comment?></p>
</div>
<?}?>