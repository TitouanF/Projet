
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    
    <?php 
     echo' <div class="carousel-inner" role="listbox">';
     $id = '<div class="item active">';
      foreach ($lesProduits as $unproduit):
          echo $id ;
          echo anchor('Visiteur/VoirUnProduit/'.$unproduit['NOPRODUIT'],img($unproduit['NOMIMAGECAROUSEL']));
          echo '<div class="carousel-caption">';
          echo ' <h3>'.$unproduit['LIBELLE'].'</h3>';
          echo ' <p>'.$unproduit['DETAIL'].'</p></div> </div>';
          $id = '<div class="item">';
      endforeach 
    ?>  
            </div>
    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Précédent</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Suivant</span>
    </a>
</div>
  
<div class="container text-center">    
  <h3>Que vendons-nous </h3><br>
</div><br>
</body>
