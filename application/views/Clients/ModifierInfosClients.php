<h2><?php echo $TitreDeLaPage ?> </h2>
<?php
echo form_open('Visiteur/ModifierClient');

echo form_label("Nom : ",'lblNom');
echo form_input('txtNom','',array('required' => 'Saisissez votre nom','value' => $DonneesInjectees['NOM'])).'<BR>';

echo form_label("Prenom : ",'lblPrenom');
echo form_input('txtPrenom','',array('required' => 'Saisissez votre prénom','value' => $DonneesInjectees['PRENOM'])).'<BR>';

echo form_label("Adresse : ",'lblAdresse');
echo form_input('txtAdresse','',array('required' => 'Saisissez votre adresse','value' => $DonneesInjectees['ADRESSE'])).'<BR>';


echo form_label("Ville : ",'lblVille');
echo form_input('txtVille','',array('required' => 'Saisissez votre ville','value' => $DonneesInjectees['VILLE'])).'<BR>';


echo form_label("Code postal : ",'lblCP');
echo form_input('txtCP','',array('[0-9]*','required' =>'required','title' => 'Saisir des nombres uniquement','value' => $DonneesInjectees['CODEPOSTAL'])).'<BR>';


echo form_label("Adresse mail: ",'lblEmail');
echo form_input('txtEmail','',array('required' => 'Saisissez votre adresse mail','value' => $DonneesInjectees['EMAIL'])).'<BR>';


echo form_label("Mot de passe: ",'lblMotDePasse');
echo form_Password('txtMotDePasse','',array('required' => 'Saisissez votre adresse','value' => $DonneesInjectees['MOTDEPASSE'])).'<BR>';



echo form_submit('boutonAjouter','Modifier').'<BR>';
echo form_close();
?>