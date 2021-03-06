<div class="container">
    <div class="row p-3">
        <h3>Nouveau mot de passe</h3>
        <h5>Pour réinitialiser votre mot de passe, veuillez saisir votre email puis le nouveau mot de passe.</h5>

        <div class="col-6 text-justify">
            <form method="POST" action="<?echo base_url('/welcome/new_password'); ?>">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input name="email"  value="<?php echo set_value('email'); ?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <?php echo form_error('email', ' <small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Nouveau mot de passe</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                    <?php echo form_error('password', ' <small class="text-danger">', '</small>'); ?>
                </div>
                <button type="submit" class="btn btn-primary">Réinitialiser le mot de passe</button>
            </form>
            <a href="/welcome/index">Revenir sur la page d'accueil</a>
            <?if ($this->session->flashdata('error')) {?>
<div class="alert alert-danger" role="alert">
<?echo $this->session->flashdata('error') ?>
</div>
<?} else if ($this->session->flashdata('success')) {?>
<div class="alert alert-success" role="alert">
<?echo $this->session->flashdata('success') ?>
</div>
<?}?>
        </div>
    </div>
</div>