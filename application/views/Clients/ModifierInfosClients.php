<div><h2><?php echo $TitreDeLaPage ?> </h2>
<?php
    echo form_open('Client/ModifierClient');
    $RegexNom = "^[a-z]+([ \-']?[a-z]+[ \-']?[a-z]+[ \-']?)[a-z]+$";
    echo form_label("Nom : ",'lblNom');
    echo form_input(array('name'=>'txtNom','required' => 'Saisissez votre nom','value'=>$utilisateurRetourner['NOM'],'pattern' =>  $RegexNom)).'<BR>';

    echo form_label("Prenom : ",'lblPrenom');
    echo form_input(array('name'=>'txtPrenom','required' => 'Saisissez votre prénom','value' => $utilisateurRetourner['PRENOM'], 'pattern' =>  $RegexNom)).'<BR>';

    echo form_label("Adresse : ",'lblAdresse');
    echo form_input(array('name'=>'txtAdresse','required' => 'Saisissez votre adresse','value' => $utilisateurRetourner['ADRESSE'])).'<BR>';


    echo form_label("Ville : ",'lblVille');
    echo form_input(array('name'=>'txtVille','required' => 'Saisissez votre ville','value' => $utilisateurRetourner['VILLE'], 'pattern' =>  $RegexNom)).'<BR>';


    echo form_label("Code postal : ",'lblCP');
    echo form_input(array('name'=>'txtCP','[0-9]*','required' =>'required','title' => 'Saisir des nombres uniquement','value' => $utilisateurRetourner['CODEPOSTAL'],'pattern' => '^(([0-8][0-9])|(9[0-5]))[0-9]{3}$')).'<BR>';


    echo form_label("Adresse mail: ",'lblEmail');
    echo form_input(array('name'=>'txtEmail','required' => 'Saisissez votre adresse mail','value' => $utilisateurRetourner['EMAIL'],'pattern' => '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$')).'<BR>';


    echo form_label("Mot de passe: ",'lblMotDePasse');
    echo form_input(array('name'=>'txtMotDePasse','required' => 'Saisissez votre adresse','value' => $utilisateurRetourner['MOTDEPASSE'])).'<BR>';


    echo form_submit('boutonModifier','Modifier').'<BR>';
    echo form_close();
?></div>