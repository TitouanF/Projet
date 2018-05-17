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