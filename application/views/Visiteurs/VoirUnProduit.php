<?php
$prixttc = $unProduit['PRIXHT'] + ($unProduit['PRIXHT'] * $unProduit['TAUXTVA']/100);
echo '<div><p>'.img($unProduit['NOMIMAGE']).'<p></div>';
echo '<div><h2>'.$unProduit['LIBELLE'].'</h2>';
echo $unProduit['DETAIL']. '</div>';
echo 'Nombre de produits restants : ';
echo (int) $unProduit['QUANTITEENSTOCK'];
echo ' <br>Prix Unitaire TTC : ' .$prixttc. ' euros </br>' ;
if (!is_null($this->session->identifiant)) : 
    {   
        if ($this->session->statut =='client')
         {
             echo form_open("Client/AjouterProduitPanier");
             echo '<input type="hidden" name="produit_id" value="'.$unProduit['NOPRODUIT'].'"/>';
             echo '<input type="hidden" name="prix" value="'.$prixttc.'"/>';
             echo '<input type="hidden" name="nom" value="'.$unProduit['LIBELLE'].'"';
             echo '<br> <input type="submit" name="valid" value="Ajouter au panier"/>';
             echo form_close();
         }
        if ($this->session->statut =='admin')
         {
             echo '<b>----------------------------------------------- </b></br>';
             echo '<b>MODIFICATION PRODUIT</b>';
             
            echo form_open('Visiteur/VoirUnProduit');
            $select = $unProduit['NOCATEGORIE'];
            echo '<b> Selectionnez une catégorie : </b> <select name="txtCategorie"> ';
                foreach ($lesCategories as $UneCategorie) :
                echo '<option value="'.$UneCategorie['NOCATEGORIE'].'"';
                if ($UneCategorie['NOCATEGORIE'] == $unProduit['NOCATEGORIE']) :
                echo 'selected' ;
                endif; 
                echo '> '.$UneCategorie['LIBELLE'].' </option>';
                endforeach ;
             echo '</select><BR>';

             echo '<b> Selectionnez une marque : </b> <select name="txtMarque"> ';
                foreach ($lesMarques as $UneMarque) :
                echo '<option value="'.$UneCategorie['NOMARQUE'].'"';
                if ($UneMarque['NOMARQUE'] == $unProduit['NOMARQUE']) :
                echo 'selected' ;
                endif; 
                echo '> '.$UneMarque['NOM'].' </option>';
                endforeach ;
             echo '</select><BR>';    

            echo form_label("Numero produit : ",'lblNoProduit');
            echo form_input(array('name'=>'txtNoProduit','required' => 'Saisissez un numéro produit','value'=>$unProduit['NOPRODUIT'],'readonly'=>'true')).'<BR>';  

            echo form_label("Libelle produit : ",'lblLibelle');
            echo form_input(array('name'=>'txtLibelle','required' => 'Saisissez un libellé','value'=>$unProduit['LIBELLE'])).'<BR>';  

            echo form_label("Detail produit : ",'lblDetail');
            echo form_textarea(array('rows' =>2, 'cols'=>50, 'name'=>'txtDetail','required' => 'Saisir le Detail du produit','value'=>$unProduit['DETAIL'])).'<BR>'; 

            echo '<b> Nouveau prix HT :</b>  <input type="number" value="'.$unProduit['PRIXHT'].'" min ="0" name="nouveauPrix" size="1"/> </br>';
            echo '<b> Nouveau Taux TVA : </b> <input type="number" value="'.$unProduit['TAUXTVA'].'" min ="0" name="nouveauTauxTVA" size="1"/></br>';
           
            echo form_label("Nom image : ",'lblNomImage');
            echo form_input(array('name'=>'txtNomImage','required' => 'Saisissez le nom de l image','value'=>$unProduit['NOMIMAGE'])).'<BR>';

            echo form_label("Nom image Carousel : ",'lblNomImageCarousel');
            echo form_input(array('name'=>'txtNomImageCarousel','required' => 'Saisissez le nom de l image pour le carousel','value'=>$unProduit['NOMIMAGECAROUSEL'])).'<BR>';
           
            echo '<b> Produit disponible ? : </b> <select name="txtDisponible">';
            echo '<option value="1" selected> Oui </option>';
            echo '<option value="0"> Non </option>';
            echo '</select></BR>';
            echo '<b> Nouvelle quantitée : </b>  <input type="number" value="'.$unProduit['QUANTITEENSTOCK'].'" min ="0" name="nouvelleQuantitee" size="1"/> </br>';
            echo '<br> <input type="submit" name="boutonModifier" value="Effectuer les changements"/>';
            echo form_close();
         }
    }
endif;
echo '<p>'.anchor('Visiteur/AfficherTousLesArticles#','Retour à la liste des articles').'</p>';
?>
