<h2><?php echo $TitreDeLaPage ?> </h2>
<style>
    </style>
<?php
$select = 'selected';
echo form_open('Administrateur/AjouterUnProduitHTML5');
echo '<b> Selectionnez une marque : </b> <select id="txtCategorie"> ';
foreach ($lesMarques as $UneMarque) :
   echo '<option value="'.$UneMarque['NOMARQUE'].'" '. $select .'> '.$UneMarque['NOM'].' </option>';
$select = '';
endforeach ;
echo '</select><BR>';

echo '<b> Selectionnez une catégorie : </b> <select id="txtCategorie"> ';
foreach ($lesCategories as $UneCategorie) :
   echo '<option value="'.$UneCategorie['NOCATEGORIE'].'" '. $select .'> '.$UneCategorie['LIBELLE'].' </option>';
$select = '';
endforeach ;
   echo '</select><BR>';
echo form_label("Libellé du produit : ",'lblLibelle');
echo form_input('txtLibelle','',array('required' => 'Saisir le libellé du produit')).'<BR>';


echo form_label("Détail du produit : ",'lblDetail');
echo form_textarea('txtDetail','',array('required' => 'Saisir le Detail du produit')).'<BR>';


echo form_label("Prix HT du produit : ",'lblPrixHT');
echo form_input('txtPrixHT','',array('[0-9]*','required' =>'required','title' => 'Saisir des nombres uniquement')).'<BR>';


echo form_label("Taux TVA du produit : ",'lblTVA');
echo form_input('txtTVA','',array('[0-9]*','required' =>'required','title' => 'Saisir des nombres uniquement')).'<BR>';


echo form_label("Nom du fichier image du produit : ",'lblNomImage');
echo form_input('txtNomImage','',array('required' => 'Saisir le nom du fichier image')).'<BR>';


echo form_label("Quantitée en stock : ",'lblQuantite');
echo form_input('txtQuantite','',array('[0-9]*','required' =>'required','title' => 'Saisir des nombres uniquement')).'<BR>';


echo form_label("Disponible (1/0) : ",'lblDisponible');
echo form_input('txtDisponible','',array('[0-9]*','required' =>'required','title' => 'Saisir des nombres uniquement')).'<BR>';


echo form_label("Nom du fichier image du produit pour le carousel : ",'lblNomImageCarousel');
echo form_input('txtNomImageCarousel','',array('required' => 'Saisir le nom du fichier image pour le carousel')).'<BR>';





echo form_submit('boutonAjouter','Ajouter un article').'<BR>';
echo form_close();
?>