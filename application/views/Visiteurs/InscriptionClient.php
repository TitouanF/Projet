<div><h2><?php echo $TitreDeLaPage ?> </h2>
<?php
    echo form_open('Visiteur/InscriptionDuClient');
    $RegexNom = "^[a-z]+([ \-']?[a-z]+[ \-']?[a-z]+[ \-']?)[a-z]+$";
    echo form_label("Nom : ",'lblNom');
    echo form_input('txtNom','',array('required' => 'Saisissez votre nom','pattern' =>  $RegexNom)).'<BR>';

    echo form_label("Prenom : ",'lblPrenom');
    echo form_input('txtPrenom','',array('required' => 'Saisissez votre prénom','pattern' =>  $RegexNom)).'<BR>';

    echo form_label("Adresse : ",'lblAdresse');
    echo form_input('txtAdresse','',array('required' => 'Saisissez votre adresse')).'<BR>';


    echo form_label("Ville : ",'lblVille');
    echo form_input('txtVille','',array('required' => 'Saisissez votre ville','pattern' =>  $RegexNom)).'<BR>';


    echo form_label("Code postal : ",'lblCP');
    echo form_input('txtCP','',array('[0-9]*','required' =>'required','title' => 'Saisir des nombres uniquement','pattern' => '^(([0-8][0-9])|(9[0-5]))[0-9]{3}$')).'<BR>';


    echo form_label("Adresse mail: ",'lblEmail');
    echo form_input('txtEmail','',array('required' => 'Saisissez votre adresse mail', 'pattern' => '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$')).'<BR>';


    echo form_label("Mot de passe: ",'lblMotDePasse');
    echo form_Password('txtMotDePasse','',array('required' => 'Saisissez votre adresse')).'<BR>';



    echo form_submit('boutonAjouter','Inscription').'<BR>';
    echo form_close();
?>
</div>