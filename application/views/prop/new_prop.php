<div class="container">
    <div class="pt-5">
        <div class="pb-3">
            <h2>Soumettre une nouvelle proposition</h2>
        </div>

        <form method="POST" action="<? echo base_url('back/add_prop')  ?>">
            <div class="form-group">
                <strong>Titre</strong>
                <input type="text" class="form-control" name="title" placeholder="Entrez le titre de votre proposition ici">
            </div>
            <div class="form-group">
                <strong>Texte</strong>
                <textarea class="form-control" name="text" cols="30" rows="10" placeholder="Entrez votre proposition ici"></textarea>
                <small class="form-text text-muted">Lorsque vous créez une proposition, vous votez forcément pour elle.</small>
            </div>
            <input class="btn btn-primary" type="submit" value="Créer la proposition">
        </form>
        <hr>
        <a href="/back/dashboard">Revenir au tableau de bord</a>
    </div>
</div>