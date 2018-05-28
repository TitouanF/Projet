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
                $this->load->library('email');
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
                $DonneesInjectees['lesCategories'] = $this->ModeleProduit->RetournerCategorie();
                $this->load->view('template/entete',$DonneesInjectees);  
                $this->load->view('Clients/Panier');
                $this->load->view('template/baspage');
            }


        public function ModifierClient()
            {
                $this->load->helper('form');
                $DonneesInjectees['TitreDeLaPage'] = 'Modification infos';
                    if ($this->input->post('boutonModifier')) // On test si le formulaire a été posté.
                        {
                            // le bouton 'submit', boutonAjouter est <> de NULL, on a posté quelque chose.
                            $infosAModifier = array(                       
                                'NOM' => $this->input->post('txtNom'),
                                'PRENOM' => $this->input->post('txtPrenom'),
                                'ADRESSE' => $this->input->post('txtAdresse'),
                                'VILLE' => $this->input->post('txtVille'),
                                'CODEPOSTAL' => $this->input->post('txtCP'),
                                'EMAIL' => $this->input->post('txtEmail'),
                                'MOTDEPASSE' => $this->input->post('txtMotDePasse'),                      
                            );
                            $this->ModeleUtilisateur->ModifierInfosActuelles($infosAModifier);
                            $this->load->helper('url');
                            $this->load->view('Clients/modificationReussie');
                        }
                    else
                        {
                            $mail = $this->session->identifiant;
                            $motdepasse = $this->session->motdepasse;
                            $DonneesInjectees['utilisateurRetourner'] =   $this->ModeleUtilisateur->retournerInfosUtilisateur($mail,$motdepasse);
                            $DonneesInjectees['lesCategories'] = $this->ModeleProduit->RetournerCategorie();
                            $this->load->view('template/entete',$DonneesInjectees);                     
                            //var_dump($DonneesInjectees['utilisateurRetourner']);
                            $this->load->view('Clients/ModifierInfosClients', $DonneesInjectees);
                            $this->load->view('template/baspage');
                        }
            }
        
        public function AjouterCommande()
            {
                $DonneesAInserer = array(
                    'NOCOMMANDE' => null,
                    'NOCLIENT' => $this->session->noClient,
                    'DATECOMMANDE' => date("Y-m-d H:i:s"), //changer pour que la date soit prise auto
                    'DATETRAITEMENT' => NULL,
                    'TRAITEE' => 0,        
                );
                $this->ModeleProduit->AjouterCommande($DonneesAInserer);
                $noCommande = $this->ModeleProduit->retournerIdDerniereCommande();
                    foreach ($this->cart->contents() as $items):
                        $DonneesInserer = array('NOCOMMANDE' => $noCommande['MAX(NOCOMMANDE)'], 'NOPRODUIT' => $items['id'], 'QUANTITECOMMANDEE' => $items['qty']);
                        $this->ModeleProduit->AjouterLigne($DonneesInserer);
                        $donneesAModifier = $items['qty'];
                        $noProduit = $DonneesInserer['NOPRODUIT'];
                        $ProduitRetourne = $this->ModeleProduit->RetournerProduit($noProduit);
                        $quantiteEnStock = $ProduitRetourne['QUANTITEENSTOCK'];
                        $this->ModeleProduit->modifierQteProduit($donneesAModifier,$noProduit,$quantiteEnStock);                       
                    endforeach;      
                    echo 'test'    ;  
                    $this->email->from('codeignititouan@gmail.com', 'Titouan');
                    $this->email->to('floch.titouan@outlook.com'); 
                    $this->email->subject('Le sujet de votre mail');
                    $this->email->message('Le message de votre mail');	
                    if (!$this->email->send()){
                        $this->email->print_debugger();
                    }
                $this->cart->destroy();
                $this->load->helper('url');
               
                //redirect('Visiteur/AfficherTousLesArticles');
            }
    }
?>