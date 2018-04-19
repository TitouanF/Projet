<?php

class Client extends CI_Controller 
{
   public function __construct()
   {
      parent::__construct();
      $this->load->helper('url');
      $this->load->helper('assets');
      $this->load->library("pagination");
      $this->load->model('ModeleProduit'); // chargement modèle, obligatoire
   }
   function creationPanier()
   {
        if (!isset($_SESSION['panier']))
        {
            $_SESSION['panier']=array();
            $_SESSION['panier']['LIBELLE'] = array();
            $_SESSION['panier']['QUANTITE'] = array();
            $_SESSION['panier']['PRIXTTC'] = array();
            $_SESSION['panier']['verrou'] = false;
        }
    return true;
  }
  function ajouterArticle($libelle,$quantite,$prixttc){

    //Si le panier existe
    if (creationPanier() && !isVerrouille())
    {
       //Si le produit existe déjà on ajoute seulement la quantité
       $positionProduit = array_search($libelleProduit,  $_SESSION['panier']['libelleProduit']);
 
       if ($positionProduit !== false)
       {
          $_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit ;
       }
       else
       {
          //Sinon on ajoute le produit
          array_push( $_SESSION['panier']['libelleProduit'],$libelleProduit);
          array_push( $_SESSION['panier']['qteProduit'],$qteProduit);
          array_push( $_SESSION['panier']['prixProduit'],$prixProduit);
       }
    }
    else
    echo "Un problème est survenu veuillez contacter l'administrateur du site.";
 }
   public function VoirPanier()
   {
        if (!is_null($this->session->identifiant)) : 
            {
                if ($this->session->statut =='client')
                    {
                        
                    }
                else
                    {
                        redirect('Visiteur/AfficherLaPage');
                    }
            }
        else :
            {
                redirect('Visiteur/seConnecter');
            }
        endif ;
        }
   }
