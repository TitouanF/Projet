<?php
class ModeleUtilisateur extends CI_Model 
{
    public function __construct()
        {
            $this->load->database();
        }
    public function existe($pUtilisateur) // non utilisée retour 1 si connecté, 0 sinon
        {
            $this->db->where($pUtilisateur);
            $this->db->from('client');
            return $this->db->count_all_results(); // nombre de ligne retournées par la requête
        } // existe
    public function retournerUtilisateur($pUtilisateur)
        {
            $requete = $this->db->get_where('client',$pUtilisateur);
            return $requete->row(); // retour d'une seule ligne !
            // retour sous forme d'objets
        } // retournerUtilisateur
        public function retournerInfosUtilisateur($adresseMail,$motDePasse)
        {
            $requete = $this->db->get_where('client', array('EMAIL' => $adresseMail,'MOTDEPASSE'=>$motDePasse));
            return $requete->row_array(); // retour d'une seule ligne !
            // retour sous forme d'objets
        } 
     public function AjouterNouveauClient($pDonneesAInserer)
        {
            return $this->db->insert('client', $pDonneesAInserer);
        }
    public function ModifierInfosActuelles($pInfosAModifier)
        {
            $this->db->set($pInfosAModifier);
            $this->db->where('NOCLIENT',$this->session->noClient);
            $this->db->update('client',$pInfosAModifier);
        }
}
