<?php

class Administrateur extends CI_Controller 
{
   public function __construct()
   {
      parent::__construct();
      $this->load->helper('url');
      $this->load->helper('assets');
      $this->load->library("pagination");
      $this->load->model('ModeleProduit'); // chargement modèle, obligatoire
   }
   public function AjouterUnProduitAModifier()
    {
        if (!is_null($this->session->identifiant)) : 
            {
                if ($this->session->statut =='admin')
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
    ?>