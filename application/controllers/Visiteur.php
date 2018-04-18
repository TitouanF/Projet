<?php

class Visiteur extends CI_Controller {
   public function __construct()
   {
      parent::__construct();
      $this->load->helper('url');
      $this->load->helper('assets');
      $this->load->library("pagination");
      $this->load->model('ModeleProduit'); // chargement modèle, obligatoire
   } // __construct
   public function AfficherLaPage() // lister tous les articles
   {
      $this->load->view('template/entete');
      $DonneesInjectees['lesCategories'] = $this->ModeleProduit->RetournerCategorie();
      $DonneesInjectees['lesProduits'] = $this->ModeleProduit->RetournerProduit();
      $this->load->view('Visiteurs/index', $DonneesInjectees);
      $this->load->view('template/baspage');
    }
    public function AfficherTousLesArticles() // lister tous les articles
    {
       $this->load->view('template/entete');
       $DonneesInjectees['lesCategories'] = $this->ModeleProduit->RetournerCategorie();
       $DonneesInjectees['lesProduits'] = $this->ModeleProduit->RetournerProduit();
       $this->load->view('Visiteurs/VoirTousLesProduits', $DonneesInjectees);
       $this->load->view('template/baspage');
     }
    public function AjouterUnProduitAModifier()
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
    public function seConnecter()
      {
        $this->load->model('ModeleUtilisateur');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $DonneesInjectees['TitreDeLaPage'] = 'Se connecter';
        $this->form_validation->set_rules('txtEMAIL', 'Email', 'required');
        $this->form_validation->set_rules('txtMotDePasse', 'Mot de passe', 'required');
        // Les champs txtIdentifiant et txtMotDePasse sont requis
        // Si txtMotDePasse non renseigné envoi de la chaine 'Mot de passe' requis
        if ($this->form_validation->run() === FALSE)
          {  // échec de la validation
              // cas pour le premier appel de la méthode : formulaire non encore appelé
              $this->load->view('template/entete');
              $this->load->view('Visiteurs/Connexion', $DonneesInjectees); // on renvoie le formulaire
              $this->load->view('template/baspage');
          }
        else
          {  // formulaire validé
            $Utilisateur = array( // cIdentifiant, cMotDePasse : champs de la table tabutilisateur
              'EMAIL' => $this->input->post('txtEMAIL'),
              'MOTDEPASSE' => $this->input->post('txtMotDePasse'),
            ); // on récupère les données du formulaire de connexion
            // on va chercher l'utilisateur correspondant aux Id et MdPasse saisis
            $UtilisateurRetourne = $this->ModeleUtilisateur->retournerUtilisateur($Utilisateur);
              if (!($UtilisateurRetourne == null))
                {    // on a trouvé, identifiant et statut (droit) sont stockés en session
                    $this->load->library('session');
                    $this->session->identifiant = $UtilisateurRetourne->EMAIL;
                    $this->session->statut = $UtilisateurRetourne->PROFIL;
                    $DonneesInjectees['EMAIL'] = $Utilisateur['EMAIL'];
                    $this->load->view('template/entete');
                    $this->load->view('Visiteurs/ConnexionReussie', $DonneesInjectees);
                    $this->load->view('template/baspage');
                }
              else
                {    
                  // utilisateur non trouvé on renvoie le formulaire de connexion
                    $this->load->view('template/entete');
                    $this->load->view('Visiteurs/Connexion', $DonneesInjectees);
                    $this->load->view('template/baspage');
                }  
            }
      }
      public function seDeConnecter() { // destruction de la session = déconnexion
        $this->session->sess_destroy();
        redirect('Visiteur/AfficherLaPage');
    }
    public function voirUnArticle($noArticle = NULL) // valeur par défaut de noArticle = NULL
    {
      $DonneesInjectees['unArticle'] = $this->ModeleProduit->retournerArticles($noArticle);
      if (empty($DonneesInjectees['unArticle']))
      {   // pas d'article correspondant au n°
          show_404();
      }
      $DonneesInjectees['TitreDeLaPage'] = $DonneesInjectees['unArticle']['cTitre'];
      // ci-dessus, entrée ['cTitre'] de l'entrée ['unArticle'] de $DonneesInjectees
      $this->load->view('template/entete');
      $this->load->view('visiteur/VoirUnProduit', $DonneesInjectees);
      $this->load->view('template/baspage');
    }
  }
