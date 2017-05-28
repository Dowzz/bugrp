
<?php
use App\user;
$user = (Auth::user());
$whitelist=$user->whitelist;
$admin=$user->admin;
$id=$user->id;
if ($whitelist==0) {
	?>
	<h2>Rejoignez la communauté !</h2>
		<ul id="liste">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<input type="hidden" id="user_id" value="<?php echo $id ?>">
			<li><input type="text" id="nom" placeholder="Nom du personnage">
			<input type="text" id="prenom" placeholder="Prénom du personnage"></li>
			</br></br>
		<li><textarea rows="4" cols="50" id="description" placeholder="Description rp"></textarea></li>
		</br></br>
		<li><textarea rows="4" cols="50" id="reason" placeholder="Dites nous en quelques mots pourquoi nous devrions valider votre candidature"></textarea></li>
		</ul>
		<button class="btn btn-elegant btn-sm" id="envoi_soumission" type="submit">Envoyer ma demande</button>
<?php
}else{
	?>


	<h1>Dernières News !</h1>
	</br></br></br></br></br>
	<h1>Changelog</h1>






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
	        console.log(user, nom, prenom, description,reason);
	            $.ajax({
	            data:({user, nom, prenom, description, reason}),
	            type:"post",
	            url: "/recorddemande",
	            });
	        });

</script>

