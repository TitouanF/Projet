
<style>
table, th, td {
    border: 1px solid black;
}
</style>
<table style="width:50%">
<tr>
<th> Numero commande </th>
<th> Numero client </th>
<th> no produit commandé </th>
<th> quantite commandé </th>
<th> Valider Commande </th>
</tr>
<?php
foreach($lesCommandes as $uneCommande)
{
    echo '<tr><td> '.$uneCommande['NOCOMMANDE'].'</td><td>'.$uneCommande['NOCLIENT'].'</td>';
    foreach($lesLignes as $uneLigne)
    {
        echo '<td>'.$uneLigne['NOPRODUIT'].'</td> <td>'.$uneLigne['QUANTITECOMMANDEE'].'</td> <br>';
    }
    echo '<td> Valider </td>';
}

?>
</table>