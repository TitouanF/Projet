<?php
class ModeleProduit extends CI_Model
{
    public function __construct()
    {
    $this->load->database();
    /* chargement database.php (dans config), obligatoirement dans le constructeur */
    }
    public function retournerproduit()
    {
      $requete = $this->db->get('produit');
      return $requete->result_array();
    }
    public function insererUnProduit($pDonneesAInserer)
    {
     return $this->db->insert('produit', $pDonneesAInserer);
     } // insererUnArticle
 }
}
