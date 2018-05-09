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
   public function VoirPanier()
   {
    if (!is_null($this->session->identifiant))
    {
        if ($this->session->statut =='client')
        {
            $this->load->view('template/Entete');
            $this->load->view('Clients/Panier');
            $this->load->view('template/baspage');
        }
      else
      {
        redirect('Visiteur/AfficherLaPage');
      }
    }
    else
    {
        redirect('Visiteur/seConnecter');
    }
   }
   
}