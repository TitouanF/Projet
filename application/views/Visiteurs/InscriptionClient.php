<h2><?php echo $TitreDeLaPage ?> </h2>
<?php
echo form_open('Visiteur/InscriptionDuClient');

echo form_label("Nom : ",'lblNom');
echo form_input('txtNom','',array('required' => 'Saisissez votre nom')).'<BR>';

echo form_label("Prenom : ",'lblPrenom');
echo form_input('txtPrenom','',array('required' => 'Saisissez votre prénom')).'<BR>';

echo form_label("Adresse : ",'lblAdresse');
echo form_input('txtAdresse','',array('required' => 'Saisissez votre adresse')).'<BR>';


echo form_label("Ville : ",'lblVille');
echo form_input('txtVille','',array('required' => 'Saisissez votre ville')).'<BR>';


echo form_label("Code postal : ",'lblCP');
echo form_input('txtCP','',array('[0-9]*','required' =>'required','title' => 'Saisir des nombres uniquement')).'<BR>';


echo form_label("Adresse mail: ",'lblEmail');
echo form_input('txtEmail','',array('required' => 'Saisissez votre adresse mail')).'<BR>';


echo form_label("Mot de passe: ",'lblMotDePasse');
echo form_Password('txtMotDePasse','',array('required' => 'Saisissez votre adresse')).'<BR>';



echo form_submit('boutonAjouter','Inscription').'<BR>';
echo form_close();
?>