<?php

class Visiteur extends CI_Controller {
   public function __construct()
   {
      parent::__construct();
      $this->load->helper('url');
      $this->load->helper('assets');
      $this->load->library("pagination");
      $this->load->model('ModeleProduit'); // chargement modèle, obligatoire
      $this->load->model('ModeleUtilisateur');
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
    public function VoirUnProduit($noArticle = NULL) // valeur par défaut de noArticle = NULL
    {
      $DonneesInjectees['unProduit'] = $this->ModeleProduit->RetournerProduit($noArticle);
      if (empty($DonneesInjectees['unProduit']))
      {   // pas d'article correspondant au n°
          show_404();
      }
      $DonneesInjectees['TitreDeLaPage'] = $DonneesInjectees['unProduit']['LIBELLE'];
      // ci-dessus, entrée ['cTitre'] de l'entrée ['unArticle'] de $DonneesInjectees
      $this->load->view('template/entete');
      $this->load->view('visiteurs/VoirUnProduit', $DonneesInjectees);
      $this->load->view('template/baspage');
    }
    public function InscriptionDuClient()
    {
        if (is_null($this->session->identifiant)) 
          {
                    $this->load->helper('form');
                    $DonneesInjectees['TitreDeLaPage'] = 'Inscription';
                      if ($this->input->post('boutonAjouter')) // On test si le formulaire a été posté.
                        {
                            // le bouton 'submit', boutonAjouter est <> de NULL, on a posté quelque chose.
                            $DonneesAInserer = array(
                                'NOCLIENT' => NULL,
                                'NOM' => $this->input->post('txtNom'),
                                'PRENOM' => $this->input->post('txtPrenom'),
                                'ADRESSE' => $this->input->post('txtAdresse'),
                                'VILLE' => $this->input->post('txtVille'),
                                'CODEPOSTAL' => $this->input->post('txtCP'),
                                'EMAIL' => $this->input->post('txtEmail'),
                                'MOTDEPASSE' => $this->input->post('txtMotDePasse'),
                                'PROFIL' => 'client'

                            );
                            $this->ModeleUtilisateur->AjouterNouveauClient($DonneesAInserer);
                            $this->load->helper('url');
                            $this->load->view('Visiteurs/InscriptionReussie');

                        }
                      else
                        {
                            $this->load->view('template/Entete');
                            $this->load->view('Visiteurs/InscriptionClient', $DonneesInjectees);
                            $this->load->view('template/baspage');
                        }
                 }
                else
                 {
                   redirect('Visiteur/AfficherLaPage');
                 }

        }
  }
