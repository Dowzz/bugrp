
<div class="container">
	<div class="row">
        <div class="span12">
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
							 ?>
								   <tr class="lignerequete" value="{{$sub->id}}">
								       <td class="colonne_req">{{ $sub->nom }}</td>
								       <td class="colonne_req">{{ $sub->prenom }}</td>
								       <td class="colonne_req">{{ $sub->description }}</td>
								       <td class="colonne_req">{{ $sub->reason }}</td>
								       <td class="colonne_req"><button class="btn btn-elegant ajout_whitelist">Valider</button></td>
								       <td class="colonne_req"><button class="btn btn-elegant refus_whitelist">Supprimer</button></td>
								       <input type="hidden" id="user_id" value= {{$user_id}}>
								       <input type="hidden" id="req_id" value = {{$req_id}}>
								   </tr>							  
							
							 <?php
						}?>
						</table>
					</div>
					   <div class="tab-pane fade" id="valides">

     
                     
                     

                    </div>

                    <script>
                    	
        $('.ajout_whitelist').click(function()
	    {   
	        var user=$("#user_id").val();
	        console.log(user);
	            $.ajax({
	            data:({user}),
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
                    </script>