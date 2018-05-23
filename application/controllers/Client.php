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
      $this->load->model('ModeleUtilisateur');
   }
   public function AjouterProduitPanier()
   {
       $data = array(
        'id'=>$this->input->post('produit_id'),
        'qty'=>1,
        'price'=>$this->input->post('prix'),
        'name'=>$this->input->post('nom')
       );

       $this->cart->insert($data);
       redirect("Client/VoirPanier");
   }
   public function update()
   {
       $data = array(
           'rowid'=> $this->input->post('rowid'),
           'qty'=>$this->input->post('quantity')
       );
       $this->cart->update($data);
       redirect($_SERVER['HTTP_REFERER']);
   }
   public function supprimer()
   {
        $data = array(
            'rowid'=> $this->uri->segment(3),
            'qty'=>0
        );
        $this->cart->update($data);
        redirect($_SERVER['HTTP_REFERER']);
   }
   public function ViderPanier()
   {
       $this->cart->destroy();
       redirect($_SERVER['HTTP_REFERER']);
   }
   public function VoirPanier()
   {
    if (!is_null($this->session->identifiant))
    {
        if ($this->session->statut =='client')
        {
            $DonneesInjectees['lesCategories'] = $this->ModeleProduit->RetournerCategorie();
                    $this->load->view('template/entete',$DonneesInjectees);  
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
   public function ModifierClient()
   {
    if (!is_null($this->session->identifiant)) 
    {
              $this->load->helper('form');
              $DonneesInjectees['TitreDeLaPage'] = 'Inscription';
                if ($this->input->post('boutonAjouter')) // On test si le formulaire a été posté.
                  {
                      // le bouton 'submit', boutonAjouter est <> de NULL, on a posté quelque chose.
                      $donneesAModifier = array(
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
                      $this->ModeleUtilisateur->AjouterNouveauClient($donneesAModifier);
                      $this->load->helper('url');
                      $this->load->view('Visiteurs/InscriptionReussie');

                  }
                else
                  {
                      $mail = $this->session->identifiant;
                      $motdepasse = $this->session->motdepasse;
                    $utilisateurRetourner =  $this->ModeleUtilisateur->retournerInfosUtilisateur($mail,$motdepasse);
                    $DonneesInjectees['lesCategories'] = $this->ModeleProduit->RetournerCategorie();
                    $this->load->view('template/entete',$DonneesInjectees);
                    $DonneesInjectees['NOCLIENT'] = $utilisateurRetourner->NOCLIENT;
                    $DonneesInjectees['NOM'] = $utilisateurRetourner->NOM;
                    $DonneesInjectees['PRENOM'] = $utilisateurRetourner->PRENOM;
                    $DonneesInjectees['ADRESSE'] = $utilisateurRetourner->ADRESSE;
                    $DonneesInjectees['VILLE'] = $utilisateurRetourner->VILLE;
                    $DonneesInjectees['CODEPOSTAL'] = $utilisateurRetourner->CODEPOSTAL;
                    $DonneesInjectees['EMAIL'] = $utilisateurRetourner->EMAIL;
                    $DonneesInjectees['MOTDEPASSE'] = $utilisateurRetourner->MOTDEPASSE;
                      $this->load->view('Clients/ModifierInfosClients', $DonneesInjectees);
                      $this->load->view('template/baspage');
                  }
     }
    else
    {
        redirect('Visiteur/AfficherLaPage');
    }

  }
   
   public function ValiderPanier()
   {
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
   }
   
}