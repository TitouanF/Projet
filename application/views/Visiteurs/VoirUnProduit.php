<?php
echo '<h2>'.$unArticle['LIBELLE'].'</h2>';
echo $unArticle['DETAIL'];
echo '<p>'.img($unArticle['NOMIMAGE']).'<p>'; // Affiche directement l'image
// Nota Bene : img_url($unArticle['cNomFichierImage']) aurait retourne l'url de l'image (cf. assets)
echo '<p>'.anchor('Visiteur/AfficherTousLesArticles#','Retour à la liste des articles').'</p>';
?>
