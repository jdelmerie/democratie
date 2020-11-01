<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="container">

<h2 class="text-center p-3">Bienvenue. (faire un topo sur le projet)</h2>

	<div class="row p-3">

		<div class="col-6 text-justify">
			<h3>Connexion</h3>
			<form method="POST" action="<? echo base_url('/welcome/login'); ?>">
				<div class="form-group">
					<label for="exampleInputEmail1">Utilisateur</label>
					<input name="pseudo" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Mot de passe</label>
					<input name="password" type="password" class="form-control" id="exampleInputPassword1">
				</div>
				<button type="submit" class="btn btn-primary">Se connecter</button>
			</form>
		</div>

		<div class="col-6 text-center">
			<img src="https://img.aws.la-croix.com/2019/05/24/1201024131/Je-votela-liste_0_730_511.jpg" width="350px">
		</div>
	</div>

	<div class="mt-5 text-justify bg-light p-3 border border-secondary">
        <div class="p-1">
            <h3>Pas encore inscrit ?</h3>
            <h5>Pour vous inscrire à notre plateforme et avoir la chance de voter des propostions, veuillez vous inscrire !</h5>
		</div>

		<form method="POST" action="<? echo base_url('/welcome/signin'); ?>">
			<div class="row">
				<div class="col-sm-4">
					<span>Email<input name="email" type="email" class="form-control"></span>
				</div>
				<div class="col-sm-4">
					<span>Pseudo<input name="pseudo" type="text" class="form-control"></span>
				</div>
				<div class="col-sm-4">
					<span>Mot de passe<input name="password" type="password" class="form-control"></span>
				</div>
			</div><br>
			<div class="text-right">
				<button type="submit" class="btn btn-primary">S'inscrire</button>
			</div>
		</form>
	</div>
</div>
