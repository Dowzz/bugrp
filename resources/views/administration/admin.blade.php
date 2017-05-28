
<div class="container">
	<div class="row">
        <div class="col-md-11 col-md-offset-1">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#en_attente" data-toggle="tab">En attente</a></li>
                    <li><a href="#valides" data-toggle="tab">Joueur Validés</a></li>
                  </ul>
                  <div id="myTabContent" class="tab-content">
                    <div class="tab-pane active in" id="en_attente">
						<h1>Demande de Whitelist</h1>
						<table>
							 	<thead>
							       <tr class="lignerequete">
							       		<th class="colonne_req">Steamid</th>
							           	<th class="colonne_req">Nom</th>
							           	<th class="colonne_req">Prénom</th>
							           	<th class="colonne_req">Description</th>
							           	<th class="colonne_req">motivation</th>
							       </tr>
							   	</thead>
						<?php
						use App\Soumission;
						$soumission= soumission::orderBy('id', 'desc')->distinct()->get();
						foreach ($soumission as $sub) {
							$user_id = $sub->user_id;
							$req_id = $sub->id;
							$steam_id= $sub->steamid;
							 ?>
								   <tr class="lignerequete" value="{{$sub->id}}">
								   		<td class="colonne_req">{{ $sub->steamid }}</td>
								      	<td class="colonne_req" id="nom">{{ $sub->nom }}</td>
								       	<td class="colonne_req" id="prenom">{{ $sub->prenom }}</td>
								       	<td class="colonne_req" id="description">{{ $sub->description }}</td>
								       	<td class="colonne_req">{{ $sub->reason }}</td>
								       	<td class="colonne_req"><button class="ajout_whitelist">Valider</button></td>
								       	<td class="colonne_req"><button class="refus_whitelist">Supprimer</button></td>
								       	<input type="hidden" id="user_id" value= {{$user_id}}>
								       	<input type="hidden" id="req_id" value = {{$req_id}}>
								       	<input type="hidden" id="steamid" value = {{$steam_id}}>
								   </tr>							  
							
							 <?php
						}?>
						</table>
					</div>
					   <div class="tab-pane fade" id="valides">
					   <h1>Liste des joueurs Validés</h1>
					   <table>
					   		<thead>
							       <tr class="lignerequete">
							           	<th class="colonne_req">Email</th>
							           	<th class="colonne_req">Username</th>
							           	<th class="colonne_req">Steamid</th>
							           	<th class="colonne_req">Nom du personnage</th>
							           	<th class="colonne_req">prénom du personnage</th>

							       </tr>
							   	</thead>
					   <?php
					   use App\user;
					   use App\character;
					   $users=user::where('whitelist', 1)->orderBy('id', 'desc')->distinct()->get();
					   foreach ($users as $whitelisted) {
					   	$steamid = $whitelisted->steamid;
					   	$char= character::where('steamid', $steamid)->first();
					   	?>
					   	<tr class="lignerequete" value="{{$sub->id}}">
					       <td class="colonne_req">{{ $whitelisted->email }}</td>
					       <td class="colonne_req">{{ $whitelisted->username }}</td>
					       <td class="colonne_req">{{ $whitelisted->steamid }}</td>
					       <td class="colonne_req">{{ $char->nom }}</td>
					       <td class="colonne_req">{{ $char->prenom }}</td>
					       <td class="colonne_req"><button class="Banbutton" data-toggle="modal" data-target="#Banmodal" rel="<?php echo $steamid ?>">BAN</button></td>
						</tr>
						<?php					   	
					   }
					   ?>
                    </div>
                    <div id="Banmodal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-text">
                    <p>Chargement en cours...</p>
                </div>


        <script>                   	
        $('.ajout_whitelist').click(function()
	    {   
	        var user=$("#user_id").val();
	        var steamid=$("#steamid").val();
	        var nom=$("#nom").text();
	        var prenom=$("#prenom").text();
	        var description=$("#description").text();
	        console.log(description);
	            $.ajax({
	            data:({user, steamid, nom, prenom, description}),
	            type:"post",
	            url: "/ajout_whitelist",
	            });
	        });
        $('.refus_whitelist').on('click', function(e)
	    {
    		$(this).closest("tr").fadeOut(500,function() {
    		var req_id =$(this).attr('value');
    		console.log(req_id);
		    $.ajax({
		        data:({req_id:req_id}),
		        type:"post",
		        url: "/refus_whitelist",
		      });
    		$(this).remove();
    		});
    	});
    	 $(".Banbutton").click(function(oEvt){
    oEvt.preventDefault();
    var Id=$(this).attr("rel");
        $(".modal-text").fadeIn(1000).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
        $.ajax({
            type:"GET",
            data : "Id="+Id,
            url:"{{ url('bannable') }}",
            error:function(msg){
                $(".modal-text").addClass("tableau_msg_erreur").fadeOut(800).fadeIn(800).fadeOut(400).fadeIn(400).html('<div style="margin-right:auto; margin-left:auto; text-align:center">Impossible de charger cette page</div>');
            },
            success:function(data){
                $(".modal-text").fadeIn(1000).html(data);
            }
        });
    });      
    	</script>