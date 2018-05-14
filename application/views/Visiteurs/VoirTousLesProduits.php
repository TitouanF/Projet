<div class="container text-center">    
  <h3>Que vendons-nous </h3><br>
  
  <div class="row">
      <?php foreach($lesProduits as $unproduit):
              echo' <div class="col-sm-4">';
              echo anchor('Visiteur/VoirUnProduit/'.$unproduit['NOPRODUIT'],img($unproduit['NOMIMAGE']));
              echo'<p>'.anchor('Visiteur/VoirUnProduit/'.$unproduit['NOPRODUIT'],$unproduit['LIBELLE']).'</p>';
              echo'</div>';
            endforeach ?>
   </div>
   <div>
  </div>
</div>