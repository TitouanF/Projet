<style>
    caption
     {
        font-family: sans-serif;
    }
</style>
<div>
</br>
<?php

     echo form_open('Administrateur/AfficherCommandesNonTraitees');
     echo '<b> Selectionnez une commande : </b> <select name="txtNoCommande"> ';
        foreach ($lesCommandes as $UneCommande) :
        echo '<option value="'.$UneCommande['NOCOMMANDE'].'" '. $select .'> '.$UneCommande['NOCOMMANDE'].' </option>';
        $select = '';
        endforeach ;
     echo form_submit('boutonVoir','Voir la commande').'<BR>';
     echo form_close();
        if (isset($lesLignes)) : ?>
            <table style="width = 50%" >
            <tr>
                <th> Numéro produit </th>
                <th> Libelle produit </th>
                <th> Quantitée commandée </th>
                <th> Prix </th>
            </tr>
            <?php            
                foreach($lesLignes as $uneLigne)
                {
                    $prixTTC = $uneLigne['PRIXHT'] + ($uneLigne['PRIXHT'] * $uneLigne['TAUXTVA']/100);
                    echo '<tr>';
                    echo '<td>'.$uneLigne['noproduit'].'</td>';
                    echo '<td>'.$uneLigne['LIBELLE'].'</td>';
                    echo '<td>'.$uneLigne['QUANTITECOMMANDEE'].'</td>';
                    echo '<td>'.$prixTTC.'</td>';
                }               
            ?>
            </table>
            </br>
            <?php
                echo form_open('Administrateur/ValiderCommande');
                echo '<input type="hidden" readonly name="txtNoCommande" value="'.$noCommande.'"/>';
                echo form_submit('boutonVoir','Valider la commande N° '.$noCommande).'<BR>';
                echo form_close(); 
            ?>
        <?php endif; ?>
</div>
               
