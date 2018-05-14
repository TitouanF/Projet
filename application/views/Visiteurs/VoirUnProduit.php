<?php
$prixttc = $unProduit['PRIXHT'] + ($unProduit['PRIXHT'] * $unProduit['TAUXTVA']/100);
echo '<div><p>'.img($unProduit['NOMIMAGE']).'<p></div>';
echo '<div><h2>'.$unProduit['LIBELLE'].'</h2>';
echo $unProduit['DETAIL']. '</div>';
echo 'Nombre de produits restants : ';
echo (int) $unProduit['QUANTITEENSTOCK'];
echo ' <br>Prix Unitaire : ' .$prixttc. ' euros </br>' ;
if (!is_null($this->session->identifiant)) : 
    {   
        if ($this->session->statut =='client')
         {
             echo 'Quantitée à commander :  <input type="number" value="0" min ="0" max="'.$unProduit['QUANTITEENSTOCK'].'" name="nombreproduits" size="1"/>';
             echo '<br> <input type="submit" name="valid" value="Ajouter au panier"/>';
         }
        if ($this->session->statut =='admin')
         {
            echo form_open('Administrateur/ChangerInfosProduits');
            echo 'Nouvelle quantitée :  <input type="number" value="0" min ="0" name="nouveaunombreproduits" size="1"/> </br>';
            echo 'Nouveau prix:  <input type="number" value="0" min ="0" name="nouveauprix" size="1"/> </br>';
            echo '<b> Produit disponible ? : </b> <select name="txtDisponible">';
            echo '<option value="1" selected> Oui </option>';
            echo '<option value="0"> Non </option>';
            echo '</select></BR>';
            echo '<br> <input type="submit" name="valid" value="Effectuer les changements"/>';
         }
    }
endif;
echo '<p>'.anchor('Visiteur/AfficherTousLesArticles#','Retour à la liste des articles').'</p>';
?>
