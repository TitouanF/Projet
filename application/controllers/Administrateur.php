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
   public function AjouterUnProduit()
    {
        if (!is_null($this->session->identifiant)) : 
            {   
                if ($this->session->statut =='admin')
                 {
                    $this->load->helper('form');
                    $DonneesInjectees['TitreDeLaPage'] = 'Ajouter un article';
                      if ($this->input->post('boutonAjouter')) // On test si le formulaire a été posté.
                        {
                            // le bouton 'submit', boutonAjouter est <> de NULL, on a posté quelque chose.
                            $DonneesAInserer = array(
                                'NOCATEGORIE' => $this->input->post('txtCategorie'),
                                'NOMARQUE' => $this->input->post('txtNoMarque'),
                                'LIBELLE' => $this->input->post('txtLibelle'),
                                'DETAIL' => $this->input->post('txtDetail'),
                                'PRIXHT' => $this->input->post('txtPrixHT'),
                                'TAUXTVA' => $this->input->post('txtTVA'),
                                'NOMIMAGE' => $this->input->post('txtNomImage'),
                                'QUANTITEENSTOCK' => $this->input->post('txtQuantite'),
                                'DATEAJOUT' => date("Y-m-d"), //changer pour que la date soit prise auto
                                'DISPONIBLE' => $this->input->post('txtDisponible'),
                                'NOMIMAGECAROUSEL' => $this->input->post('txtNomImageCarousel'),
                            );
                            $this->modeleProduit->insererUnProduit($DonneesAInserer);
                            $this->load->helper('url');
                            $this->load->view('Administrateur/insertionReussie');

                        }
                      else
                        {
                            $this->load->view('template/Entete');
                            $DonneesInjectees['lesCategories'] = $this->ModeleProduit->RetournerCategorie();
                            $DonneesInjectees['lesMarques'] = $this->ModeleProduit->RetournerMarque();
                            $this->load->view('Administrateur/AjouterUnProduitHTML5', $DonneesInjectees);
                            $this->load->view('template/baspage');
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