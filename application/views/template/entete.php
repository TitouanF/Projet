<html>
<head>
  <title>Site marchand</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }  
  .carousel-inner img {
      width: 100%; /* Set width to 100% */
      margin: auto;
      min-height:200px;
  }
  .dropdown:hover {
            background-color: #454545;
            color: white;
        }
 
        .dropdown-menu .sub-menu {
            left: 100%;
            position: absolute;
            top: -4px;
            visibility: hidden;
            margin-top: 0;
        }
 
        .dropdown-menu li:hover .sub-menu {
            visibility: visible;
        }
 
        .dropdown:hover .dropdown-menu {
            display: block;
        }
        }
    </style>
  </head>
  <body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
        </button>
        <a class="navbar-brand" href="http://127.0.0.1/projet/index.php/Visiteur/AfficherLaPage#"><img src="<?= base_url() ?>assets/images/logo.ico " alt="LOGO" /></a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
        <li class="active"><a href="http://127.0.0.1/projet/index.php/Visiteur/AfficherLaPage#">Accueil <span class="glyphicon glyphicon-home"></a></li>
          <li><a href="http://127.0.0.1/projet/index.php/Visiteur/AfficherTousLesArticles#"> Voir tous les produits <span class="glyphicon glyphicon-th-list"></a></li>
          <li><a href="http://127.0.0.1/projet/index.php/Visiteur/AfficherLesProduitsAvecPagination"> Voir produits avec pagination <span class="glyphicon glyphicon-th-list"></a></li>
            <?php
            if (!is_null($this->session->identifiant)) : 
              {
                if ($this->session->statut =='client')
                    {
                      echo '<li><a href="http://127.0.0.1/projet/index.php/Client/VoirPanier">Voir le panier <span class="glyphicon glyphicon-shopping-cart"></span></a></li>';
                    }
              }
            endif;
            ?>
            
            <?php
            if (!is_null($this->session->identifiant)) : 
              {
                if ($this->session->statut =='admin')
                    {
                      echo '<li><a href="http://127.0.0.1/projet/index.php/Administrateur/AjouterUnProduit">Ajouter un produit <span class="glyphicon glyphicon-plus"></span></a></li>';
                    }
              }
            endif;
            ?>
               <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
               </span>  Voir par catégorie <span class="glyphicon glyphicon-file"> <b class="caret"> </b></a>
               <ul class="dropdown-menu">
                <li class="dropdown dropdown-submenu">
                <?php foreach ($lesCategories as $uneCategorie):
                                echo'<li>' .anchor('Visiteur/AfficherProduitCategorie/'.$uneCategorie['NOCATEGORIE'],$uneCategorie['LIBELLE']).'" class="dropdown-toggle" data-toggle="dropdown"></a></li>'; 
                   
                      endforeach
                ?>
                </li>
               </ul>
               </li>
               <?php echo form_open('Visiteur/AfficherProduitRechercher', array('class' => 'navbar-form navbar-left')); ?>
               <div class="form-group">
                 <input name="txtRechercher" type="text" class="form-control" placeholder="Recherche">
                 <?php echo form_close();?>
                </div>

               
        </ul>
     
        <ul class="nav navbar-nav navbar-right">
        <?php if (!is_null($this->session->identifiant)) :
        if (!is_null($this->session->identifiant)) : 
              {
                if ($this->session->statut =='client')
                    {
                      echo '<li><a href="http://127.0.0.1/projet/index.php/Client/ModifierClient">Modifier informations compte <span class="glyphicon glyphicon-user"></span></a></li>';
                    }
              }
        endif
              ?>
        <li><a> <?php echo '<B>Utilisateur : </B> <B>'.$this->session->identifiant.' </B>&nbsp;&nbsp;';?> </a></li>
        <li><a href="<?php echo site_url('Visiteur/seDeconnecter') ?>">Se déconnecter <span class="glyphicon glyphicon-log-out">&nbsp;&nbsp;</a></li>
       <?php else : ?>
          <li><a href="http://127.0.0.1/projet/index.php/Visiteur/seConnecter#"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>
       <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
