
<?php
use App\user;
use App\character;
$user = (Auth::user());
$whitelist=$user->whitelist;
$admin=$user->admin;
$id=$user->id;
$steamid=$user->steamid;
$char= character::where('steamid', $steamid)->first();

if ($whitelist==0) {
	?>
	<h2>Rejoignez la communauté !</h2>
		<h4>Première étape : Validation via steam</h4>
		<?php

		if ($steamid==0) {
			?>
			<a href="/steamlogin"><img src="{{URL::asset('/img/sits_01.png')}}"></a>
			</br></br>
		<?php
		}else {
			?>
			<h2><?php echo $user->username ?></h2>
			<img src="<?php echo $user->avatar?>">
			</br></br></br>
			<?php
		}
		?>
		<h4>Seconde étape, demande d'adhésion a la Whitelist</h4>
		<ul id="liste">
			<input type="hidden" id="steamid" value="<?php echo $steamid ?>">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<input type="hidden" id="user_id" value="<?php echo $id ?>">
			<li><input type="text" id="nom" placeholder="Nom du personnage">
			<input type="text" id="prenom" placeholder="Prénom du personnage"></li>
			</br></br>
			<p>Description rp</p>
			<li><textarea rows="4" cols="50" id="description"></textarea></li>
			</br></br>
			<p>Dites nous en quelques mots pourquoi nous devrions valider votre candidature</p>
			<li><textarea rows="4" cols="50" id="reason"></textarea></li>
			</br></br>
			</ul>
			<button class="btn btn-elegant btn-sm" id="envoi_soumission" type="submit">Envoyer ma demande</button>*
			</br></br>
<?php
}else{
	?>
	<div class="row">
		<div class="col-md-6">
			<img src="<?php echo $user->avatar?>">
			<h2><?php echo $user->username ?></h2>
		</div>
		<div class="col-md-6"></div>
			<h3>Prenom : <?php echo $char->prenom ?></h3>
			<h3>Nom : <?php echo $char->nom ?></h3>
			<h4>Description : <?php echo $char->description ?></h4>
		</div>
	<div class="col-md-12">
	<h1>Dernières News !</h1>
	<h1>Changelog</h1>
	</div>
	</div>






<?php
}
?>
<script>
	$('#envoi_soumission').click(function()
	    {   
	        var user=$("#user_id").val();
	        var nom=$("#nom").val();
	        var prenom=$("#prenom").val();
	        var description=$("#description").val();
	        var reason=$("#reason").val();
	        var steamid=$("#steamid").val();
	        console.log(steamid, user, nom, prenom, description, reason);
	            $.ajax({
	            data:({steamid, user, nom, prenom, description, reason}),
	            type:"post",
	            url: "/recorddemande",
	            success: function(msg){
        	{ alert("Votre demande d'adhésion va être vu par un admin. Vous serez informé dès la validation"); }
        }
	            });
	        });

</script>

