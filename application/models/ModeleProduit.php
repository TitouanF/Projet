<?php
class ModeleProduit extends CI_Model
{
    public function __construct()
      {
        $this->load->database();
        /* chargement database.php (dans config), obligatoirement dans le constructeur */
      }

    public function RetournerProduit($pNoProduit = FALSE)
      {
        if ($pNoProduit === FALSE) // pas de n° d'article en paramètre
          { 
              $requete = $this->db->query('select * from produit where DISPONIBLE = 1 and QUANTITEENSTOCK > 0 ');
              return $requete->result_array();
          }
        $requete = $this->db->get_where('produit', array('NOPRODUIT' => $pNoProduit));
        return $requete->row_array();
      }


    public function retournerArticlesLimite($nombreDeLignesARetourner, $noPremiereLigneARetourner)
      {// Nota Bene : surcharge non supportée par PHP
        $this->db->limit($nombreDeLignesARetourner, $noPremiereLigneARetourner);
        $requete = $this->db->query('select * from produit where DISPONIBLE = 1 and QUANTITEENSTOCK > 0 ');
        if ($requete->num_rows() > 0) 
          { // si nombre de lignes > 0
            return $requete->result_array();
          } // fin if
        return false;
      }


    public function nombreDArticles() 
      { // méthode utilisée pour la pagination
        return $this->db->count_all("produit");    
      }


    public function RetournerProduitParCategorie($NoCategorie = FALSE)
      {
        if ($NoCategorie === FALSE) // pas de n° d'article en paramètre
          { 
            $requete = $this->db->query('select * from produit where DISPONIBLE = 1 and QUANTITEENSTOCK > 0 ');
            return $requete->result_array();
          }
        $requete = $this->db->get_where('produit', array('DISPONIBLE' => 1,'NOCATEGORIE'=>$NoCategorie));
        return $requete->result_array();
      }


    public function RetournerProduitParDate($Date = FALSE)
      {
        if ($Date === FALSE) // pas de n° d'article en paramètre
          { 
            $requete = $this->db->query('select * from produit where DISPONIBLE = 1 and QUANTITEENSTOCK > 0 ');
            return $requete->result_array();
          }
        $requete = $this->db->get_where('produit', array('DISPONIBLE' => 1,'DATEAJOUT'=>$Date));
        return $requete->result_array();
      }


    public function RetournerProduitRechercher($recherche = FALSE)
      {
        if ($recherche === FALSE) // pas de n° d'article en paramètre
          { 
            $requete = $this->db->query('select * from produit where DISPONIBLE = 1 and QUANTITEENSTOCK > 0 ');
            return $requete->result_array();
          }
        $this->db->select('*');
        $this->db->from('produit');
        $this->db->where('DISPONIBLE',1);
        $this->db->like('LIBELLE',$recherche,'both');
        $requete =$this->db->get();
        return $requete->result_array();
      }


    public function RetournerCategorie()
      {
        $requete = $this->db->get('categorie');
        return $requete->result_array();
      }

    public function RetournerCommande()
      {
        $requete = $this->db->get_where('Commande', array('TRAITEE'=> 0));
        return $requete->result_array();
      }

    public function RetournerLigne($noCommande = FALSE)
      {
        if ($noCommande != FALSE)
        {
          $requete = $this->db->query('select ligne.noproduit,produit.LIBELLE,ligne.QUANTITECOMMANDEE,produit.PRIXHT,produit.TAUXTVA from ligne,produit where ligne.noproduit = produit.noproduit and ligne.NOCOMMANDE ='.$noCommande);
        return $requete->result_array();
        }      
      }

    public function RetournerMarque()
      {
        $requete = $this->db->get('marque');
        return $requete->result_array();
      }


    public function insererUnProduit($pDonneesAInserer)
      {
        return $this->db->insert('produit', $pDonneesAInserer);
      } // insererUnArticle


    public function AjouterCommande($pDonneesAInserer)
      {
        return $this->db->insert('commande', $pDonneesAInserer);
      } 


    public function AjouterLigne($pDonneesAInserer)
      {
        return $this->db->insert('ligne', $pDonneesAInserer);
      } 


    public function ModifierInfosProduits($pDonneesAModifier)
      {
        $this->db->set($pDonneesAModifier);
        $this->db->where('NOPRODUIT',$pDonneesAModifier['NOPRODUIT']);
        $this->db->update('produit',$pDonneesAModifier);
      }


    public function RetournerDate()
      {
        $this->db->select('DATEAJOUT');
        $this->db->from('produit');
        $this->db->group_by('DATEAJOUT');
        $requete = $this->db->get();
        return $requete->result_array();
      }
  
    public function retournerIdDerniereCommande()
      {
        $requete = $this->db->query('select MAX(NOCOMMANDE) from commande');
        return $requete->row_array();
      }
    public function changerQuantiteEnStock($pDonneesAEnlever)
    {
      $this->db->set($pDonneesAEnlever);
      $this->db->where('NOPRODUIT',$pDonneesAEnlever['NOPRODUIT']);
      $this->db->update('produit');
    }

    public function RecupererQuantitee($pDonneesAModifier)
    {
      $requete = $this->db->query('select QUANTITEENSTOCK from produit where NOPRODUIT = '.$pDonneesAModifier['NOPRODUIT']);
      return $requete->result_array();
    }

 }
?>