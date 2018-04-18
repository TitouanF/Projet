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
                $requete = $this->db->get('produit');
                return $requete->result_array();
            }
      $requete = $this->db->get_where('produit', array('NOPRODUIT' => $pNoProduit));
      return $requete->row_array();
    }
    public function RetournerCategorie()
    {
      $requete = $this->db->get('categorie');
      return $requete->result_array();
    }
    public function insererUnProduit($pDonneesAInserer)
    {
     return $this->db->insert('produit', $pDonneesAInserer);
     } // insererUnArticle
 }
?>