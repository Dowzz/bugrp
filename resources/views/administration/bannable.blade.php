<?php 
use App\user;
use App\character;
$user = user::where('steamid', $_GET["Id"])->first();
$char = character::where('steamid', $_GET["Id"])->first();
?>
<div class="row">
<input type="text" placeholder="<?php echo $char->nom ?>" disabled>
<input type="text" placeholder="<?php echo $char->prenom ?>" disabled>
</div>
</br></br>
<div class="row">
<input type="text" placeholder="<?php echo $user->steamid ?>" id="steamid" value="<?php echo $user->steamid ?>" disabled>
<input type="text" placeholder="<?php echo $user->email ?>" disabled>
</div>
</br></br>
<div class="row"><textarea name="banreason" placeholder="Motif du ban" id="banreason" cols="30" rows="10"></textarea></div>
<button class="banvalide">Valider le ban</button>
</br></br>
<script>
	$('.banvalide').click(function()
	    {  
	        var steamid=$("#steamid").val();
	        console.log(description);
	            $.ajax({
	            data:({steamid}),
	            type:"post",
	            url: "/banvalide",
	            success: function(msg){
        	{ alert("Le ban est pris en compte. L'utilisateur sera averti automatiquement."); }
       		}
	            });   
	        });
</script>