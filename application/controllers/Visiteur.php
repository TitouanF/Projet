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
    $DonneesInjectees['lesCategories'] = $this->ModeleProduit->RetournerCategorie();
    $this->load->view('template/entete',$DonneesInjectees);  
      $DonneesInjectees['lesProduits'] = $this->ModeleProduit->RetournerProduit();
      $this->load->view('Visiteurs/index', $DonneesInjectees);
      $this->load->view('template/baspage');
    }
    public function AfficherTousLesArticles() // lister tous les articles
    { 
      $DonneesInjectees['lesDates'] = $this->ModeleProduit->RetournerDate();
      $DonneesInjectees['lesCategories'] = $this->ModeleProduit->RetournerCategorie();
       $this->load->view('template/entete',$DonneesInjectees);  
       $DonneesInjectees['lesProduits'] = $this->ModeleProduit->RetournerProduit();
       $this->load->view('Visiteurs/VoirTousLesProduits', $DonneesInjectees);
       $this->load->view('template/baspage');
     }
     public function AfficherProduitRechercher($recherche = null) // lister tous les articles
     { 
       $recherche = $this->input->post('txtRechercher');
       $DonneesInjectees['lesDates'] = $this->ModeleProduit->RetournerDate();
       $DonneesInjectees['lesCategories'] = $this->ModeleProduit->RetournerCategorie();
        $this->load->view('template/entete',$DonneesInjectees);  
        $DonneesInjectees['lesProduits'] = $this->ModeleProduit->RetournerProduitRechercher($recherche);     
        $this->load->view('Visiteurs/VoirTousLesProduits', $DonneesInjectees);
        $this->load->view('template/baspage');
      }
     public function AfficherProduitCategorie($Categorie = null) // lister tous les articles
     { 
      $DonneesInjectees['lesDates'] = $this->ModeleProduit->RetournerDate();
       $DonneesInjectees['lesCategories'] = $this->ModeleProduit->RetournerCategorie();
        $this->load->view('template/entete',$DonneesInjectees);  
        $DonneesInjectees['lesProduits'] = $this->ModeleProduit->RetournerProduitParCategorie($Categorie);
        $this->load->view('Visiteurs/VoirTousLesProduits', $DonneesInjectees);
        $this->load->view('template/baspage');
      }
      public function AfficherProduitParDate($Date = null) // lister tous les articles
     { 
      $DonneesInjectees['lesDates'] = $this->ModeleProduit->RetournerDate();
       $DonneesInjectees['lesCategories'] = $this->ModeleProduit->RetournerCategorie();
        $this->load->view('template/entete',$DonneesInjectees);  
        $DonneesInjectees['lesProduits'] = $this->ModeleProduit->RetournerProduitParDate($Date);
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
              $DonneesInjectees['lesCategories'] = $this->ModeleProduit->RetournerCategorie();
               $this->load->view('template/entete',$DonneesInjectees);  
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
                    $this->session->noClient = $UtilisateurRetourne->NOCLIENT;
                    $this->session->identifiant = $UtilisateurRetourne->EMAIL;
                    $this->session->motdepasse = $UtilisateurRetourne->MOTDEPASSE;
                    $this->session->statut = $UtilisateurRetourne->PROFIL;
                    $DonneesInjectees['EMAIL'] = $Utilisateur['EMAIL'];
                    $DonneesInjectees['lesCategories'] = $this->ModeleProduit->RetournerCategorie();
                    $this->load->view('template/entete',$DonneesInjectees);  
                    $this->load->view('Visiteurs/ConnexionReussie', $DonneesInjectees);
                    $this->load->view('template/baspage');
                }
              else
                {    
                  // utilisateur non trouvé on renvoie le formulaire de connexion
                  $DonneesInjectees['lesCategories'] = $this->ModeleProduit->RetournerCategorie();
                  $this->load->view('template/entete',$DonneesInjectees);  
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
      $this->load->helper('form');
      $DonneesInjectees['unProduit'] = $this->ModeleProduit->RetournerProduit($noArticle);
      if ($this->input->post('boutonModifier')) // On test si le formulaire a été posté.
      {
          // le bouton 'submit', boutonAjouter est <> de NULL, on a posté quelque chose.
          $infosAModifier = array(                       
              'NOCATEGORIE' => $this->input->post('txtCategorie'),
              'NOMARQUE' => $this->input->post('txtMarque'),
              'NOPRODUIT' => $this->input->post('txtNoProduit'),
              'LIBELLE' => $this->input->post('txtLibelle'),
              'DETAIL' => $this->input->post('txtDetail'),
              'PRIXHT' => $this->input->post('nouveauPrix'),
              'TAUXTVA' => $this->input->post('nouveauTauxTVA'),    
              'NOMIMAGE' => $this->input->post('txtNomImage'),  
              'NOMIMAGECAROUSEL' => $this->input->post('txtNomImageCarousel'),  
              'QUANTITEENSTOCK' => $this->input->post('nouvelleQuantitee'),
              'DISPONIBLE' => $this->input->post('txtDisponible'),              
          );
          $this->ModeleProduit->ModifierInfosProduits($infosAModifier);
          $this->load->helper('url');
          $this->load->view('Clients/modificationReussie');
      }
      else
      {
      $DonneesInjectees['lesMarques'] = $this->ModeleProduit->RetournerMarque();
      $DonneesInjectees['TitreDeLaPage'] = $DonneesInjectees['unProduit']['LIBELLE'];
      // ci-dessus, entrée ['cTitre'] de l'entrée ['unArticle'] de $DonneesInjectees
      $DonneesInjectees['lesCategories'] = $this->ModeleProduit->RetournerCategorie();
      $this->load->view('template/entete',$DonneesInjectees);  
      $this->load->view('Visiteurs/VoirUnProduit', $DonneesInjectees);
      $this->load->view('template/baspage');
    }
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
                          $DonneesInjectees['lesCategories'] = $this->ModeleProduit->RetournerCategorie();
                          $this->load->view('template/entete',$DonneesInjectees);  
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
