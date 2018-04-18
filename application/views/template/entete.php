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
  B {
    color : ForestGreen;
  }
  /* Hide the carousel text when the screen is less than 600 pixels wide */
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
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
          <li class="active"><a href="http://127.0.0.1/projet/index.php/Visiteur/AfficherLaPage#">Accueil</a></li>
          <li><a href="http://127.0.0.1/projet/index.php/Visiteur/AfficherTousLesArticles#">Voir tous les produits</a></li>
          <li><a href="#">Voir le panier</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <?php if (!is_null($this->session->identifiant)) : ?>
       <?php echo '<B>Utilisateur connecté : </B> <B>'.$this->session->identifiant.'</B>&nbsp;&nbsp;';?>
       <a href="<?php echo site_url('Visiteur/seDeconnecter') ?>">Se déconnecter</a>&nbsp;&nbsp;
       <?php if ($this->session->statut==1) : ?>
          <a href="<?php echo site_url('administrateur/ajouterUnArticle') ?>">Ajouter un article</a>&nbsp;&nbsp;
       <?php endif; ?>
       <?php else : ?>
          <li><a href="http://127.0.0.1/projet/index.php/Visiteur/seConnecter#"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>
       <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
