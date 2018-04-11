<?php

class Visiteur extends CI_Controller {
   public function __construct()
   {
      parent::__construct();
      $this->load->helper('url');
      $this->load->helper('assets'); // helper 'assets' ajouté a Application
      $this->load->library("pagination");
      $this->load->model('ModeleProduit'); // chargement modèle, obligatoire
   } // __construct
   public function AfficherLaPage() // lister tous les articles
   {
      $DonneesInjectees['lesCategories'] = $this->ModeleProduit->AfficherLesCategories();
      $DonneesInjectees['lesProduits'] = $this->ModeleProduit->AfficherLesProduits();
      $this->load->view('client/index', $DonneesInjectees);
    }
    public function AjouterUnProduit()
    {
      $this->load->helper('form');
      $this->load->library('form_validation');
      $DonneesInjectees['TitreDeLaPage'] = 'Ajouter un article';
      $this->form_validation->set_rules('txtprenom', 'prenom', 'required');
      $this->form_validation->set_rules('txtnom', 'nom', 'required');
      if ($this->form_validation->run() === FALSE)
      {   // formulaire non validé, on renvoie le formulaire
        $this->load->view('client/AjouterUnClient', $DonneesInjectees);
      }
      else
      {
     $donneesAInserer = array(
   'prenomclient' => $this->input->post('txtprenom'),
   'nomclient' => $this->input->post('txtnom'),
     ); // cTitre, cTexte, cNomFichierImage : champs de la table tabarticle
     $this->ModeleClient->insererUnClient($donneesAInserer); // appel du modèle
     $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
     $this->load->view('client/insertionReussie');
      }
    }
  }
