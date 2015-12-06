<?php
/*
 * CONTIENT LES REQUETES QUI NE DEPENDENT PAS DE LA LANGUE : FICHIER A INCLURE DANS TOUT FICHIER LANGUE
 */
$sql_update_reference_liste_marques_complete = '
SELECT marques.ID_MARQUE, marques.MARQUE, marques.ORDRE, table1.ID_MARQUE_BILLES, table1.ID_BILLES, table1.ANNEE_APPARITION, table1.ANNEE_DISPARITION, table1.COMMENTAIRE_MARQUE_BILLE 
from marques left join (select * from marque_billes where marque_billes.id_billes=:num) as table1 on marques.id_marque=table1.id_marque ORDER BY marques.ORDRE, table1.ANNEE_APPARITION';
 
$sql_detail_bille_marques = 'SELECT marques.ID_MARQUE, marques.MARQUE, marque_billes.ID_MARQUE_BILLES, marque_billes.ANNEE_APPARITION, marque_billes.ANNEE_DISPARITION, marque_billes.COMMENTAIRE_MARQUE_BILLE FROM billes, marque_billes, marques WHERE billes.ID_BILLES = marque_billes.ID_BILLES AND marque_billes.ID_MARQUE = marques.ID_MARQUE AND billes.ID_BILLES=:num';

$sql_commentaires_bille = 'SELECT DISTINCT COMMENTAIRE FROM marque_billes_conditionnement WHERE ID_MARQUE_BILLES=:id'; 

$sql_liste_marques = 'SELECT ID_MARQUE, MARQUE FROM marques'; 

/* $sql_conditionnements_bille = 'SELECT table1.ID_CONDITIONNEMENT as ID_CONDITIONNEMENT, table1.NOM as NOM, table2.MARQUE, table2.COMMENTAIRE as NOM_CONDITIONNEMENT FROM (
SELECT conditionnement.ID_CONDITIONNEMENT, conditionnement.NOM
FROM conditionnement
WHERE conditionnement.FLAG_SAC=True
) as Table1
left join (
SELECT marque_billes_conditionnement.ID_CONDITIONNEMENT, marques.MARQUE, marque_billes_conditionnement.COMMENTAIRE, billes.NOM, marque_billes.ANNEE_APPARITION, marque_billes.ANNEE_DISPARITION
FROM marque_billes_conditionnement, marque_billes, billes, marques
WHERE marque_billes_conditionnement.ID_MARQUE_BILLES=marque_billes.ID_MARQUE_BILLES AND marque_billes.ID_BILLES=billes.ID_BILLES AND marque_billes.ID_MARQUE=marques.ID_MARQUE AND billes.ID_BILLES=:id
) as table2
on Table1.ID_CONDITIONNEMENT = table2.ID_CONDITIONNEMENT';*/

$sql_liste_marque_conditionnement_bille = 'SELECT
ID_MARQUE_BILLES,
MARQUE,
table1.ORDRE,
ANNEE_APPARITION,
ANNEE_DISPARITION,
table1.NOM,
table1.COMMENTAIRE_MARQUE_BILLE AS COMMENTAIRE_CONDITIONNEMENT,
table1.ORDRE_AFFICHAGE,
table2.NOMBRE,
table1.ID_MARQUE_BILLES_CONDITIONNEMENT
from (
SELECT 
marque_billes.ID_MARQUE_BILLES,
marques.MARQUE,
marque_billes.ANNEE_APPARITION,
marque_billes.ANNEE_DISPARITION,
marque_billes.COMMENTAIRE_MARQUE_BILLE,
marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT,
marque_billes_conditionnement.ID_CONDITIONNEMENT,
conditionnement.ORDRE_AFFICHAGE,
conditionnement.NOM,
conditionnement.ORDRE,
marque_billes_conditionnement.COMMENTAIRE
FROM marque_billes, marques, marque_billes_conditionnement, conditionnement
WHERE
conditionnement.FLAG_SAC=true AND
marque_billes.ID_MARQUE_BILLES=marque_billes_conditionnement.ID_MARQUE_BILLES AND 
marque_billes_conditionnement.ID_CONDITIONNEMENT=conditionnement.ID_CONDITIONNEMENT AND 
marque_billes.ID_MARQUE=marques.ID_MARQUE AND 
marque_billes.ID_BILLES=:id)  as table1
LEFT JOIN (
SELECT 
sac_marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT,
sac_marque_billes_conditionnement.ID_SAC_MARQUE_BILLES_CONDITIONNEMENT,
SUM(sac_marque_billes_conditionnement.NOMBRE) as NOMBRE
FROM sac_marque_billes_conditionnement
WHERE LOGIN_COMPTE = :login
group by ID_MARQUE_BILLES_CONDITIONNEMENT
) as table2 on table1.ID_MARQUE_BILLES_CONDITIONNEMENT=table2.ID_MARQUE_BILLES_CONDITIONNEMENT
ORDER BY ORDRE, ORDRE_AFFICHAGE, NOM';

$sql_liste_marque_bille_conditionnement_pour_bille = 'SELECT
ID_MARQUE_BILLES,
MARQUE,
ANNEE_APPARITION,
ANNEE_DISPARITION,
table1.COMMENTAIRE_MARQUE_BILLE,
table1.NOM,
table1.COMMENTAIRE,
table1.ORDRE_AFFICHAGE,
table1.ID_MARQUE_BILLES_CONDITIONNEMENT,
table2.NOMBRE,
table2.CODE_BARRE,
table2.SAC_COMMENTAIRE,
table2.ID_SAC_MARQUE_BILLES_CONDITIONNEMENT
from (
SELECT 
marque_billes.ID_MARQUE_BILLES,
marques.MARQUE,
marque_billes.ANNEE_APPARITION,
marque_billes.ANNEE_DISPARITION,
marque_billes.COMMENTAIRE_MARQUE_BILLE,
marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT,
marque_billes_conditionnement.ID_CONDITIONNEMENT,
conditionnement.ORDRE_AFFICHAGE,
conditionnement.NOM,
marque_billes_conditionnement.COMMENTAIRE
FROM marque_billes, marques, marque_billes_conditionnement, conditionnement
WHERE
marque_billes.ID_MARQUE_BILLES=marque_billes_conditionnement.ID_MARQUE_BILLES AND 
marque_billes_conditionnement.ID_CONDITIONNEMENT=conditionnement.ID_CONDITIONNEMENT AND 
marque_billes.ID_MARQUE=marques.ID_MARQUE AND 
marque_billes.ID_BILLES=:id)  as table1
LEFT JOIN (
SELECT 
sac_marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT,
CODE_BARRE,
sac_marque_billes_conditionnement.COMMENTAIRE AS SAC_COMMENTAIRE,
sac_marque_billes_conditionnement.ID_SAC_MARQUE_BILLES_CONDITIONNEMENT,
sac_marque_billes_conditionnement.NOMBRE
FROM sac_marque_billes_conditionnement
WHERE LOGIN_COMPTE = :login
) as table2 on table1.ID_MARQUE_BILLES_CONDITIONNEMENT=table2.ID_MARQUE_BILLES_CONDITIONNEMENT
ORDER BY MARQUE, ORDRE_AFFICHAGE, NOM
'; //Utilisé pour récupérer la liste des mbc affectables dans l'écran de mise à jour bille (collection) update_bille

$sql_critere_marque = 'SELECT DISTINCT MARQUE FROM marque_billes, marques WHERE marques.ID_MARQUE = marque_billes.ID_MARQUE AND MARQUE <> \'\' ORDER BY MARQUE'; // OK MIGRATION NEW BASE
$sql_get_scans = 'SELECT sac_marque_billes_conditionnement.ID_SAC_MARQUE_BILLES_CONDITIONNEMENT AS ID, sac_marque_billes_conditionnement.CODE_BARRE AS CODE, sac_marque_billes_conditionnement.NOMBRE, billes.NOM AS ID_BILLE, conditionnement.NOM AS ID_CONDITIONNEMENT, sac_marque_billes_conditionnement.DATE_CREATION, sac_marque_billes_conditionnement.COMMENTAIRE FROM (((sac_marque_billes_conditionnement LEFT JOIN marque_billes_conditionnement ON sac_marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT = marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT) LEFT JOIN marque_billes ON marque_billes_conditionnement.ID_MARQUE_BILLES = marque_billes.ID_MARQUE_BILLES) LEFT JOIN billes ON marque_billes.ID_BILLES = billes.ID_BILLES) LEFT JOIN conditionnement ON marque_billes_conditionnement.ID_CONDITIONNEMENT = conditionnement.ID_CONDITIONNEMENT ORDER BY '; //OK MIGRATION NEW BASE
$sql_get_synonyms = 'SELECT ID_BILLES as NUM, NOM FROM billes, SYNONYMES WHERE ( SYNONYME_A =:num AND SYNONYME_B = ID_BILLES ) OR ( SYNONYME_B =:num AND SYNONYME_A = ID_BILLES )'; //OK MIGRATION NEW BASE
$sql_get_billes_apparentees = 'SELECT DISTINCT NOM FROM billes, SYNONYMES WHERE (synonyme_a = :id AND billes.ID_BILLES = synonyme_b) or (synonyme_b = :id AND billes.ID_BILLES = synonyme_a)'; //OK MIGRATION NEW BASE
$sql_get_conditionnements = 'SELECT ID_CONDITIONNEMENT, NOM, NB12, NB14, NB16, NB21, NB25, NB35, NB42, NB50 FROM conditionnement ORDER BY FLAG_SAC DESC, NOM ASC'; //OK MIGRATION NEW BASE
$sql_get_conditionnements_sac = 'SELECT ID_CONDITIONNEMENT, NOM, NB12, NB14, NB16, NB21, NB25, NB35, NB42, NB50 FROM conditionnement WHERE FLAG_SAC=true ORDER BY NOM ASC'; //OK MIGRATION NEW BASE
$sql_get_conditionnements_marque_id = 'SELECT conditionnement.ID_CONDITIONNEMENT, conditionnement.NOM FROM conditionnement, marque_billes, marque_billes_conditionnement WHERE marque_billes.ID_MARQUE_BILLES=:id_marque_billes AND marque_billes.ID_MARQUE_BILLES=marque_billes_conditionnement.ID_MARQUE_BILLES AND marque_billes_conditionnement.ID_CONDITIONNEMENT=conditionnement.ID_CONDITIONNEMENT ORDER BY conditionnement.NOM'; //OK MIGRATION NEW BASE
$sql_get_liste_omptage_sac_conditionnements_marque_id = '
SELECT conditionnement.ID_CONDITIONNEMENT, conditionnement.NOM, table1.ID_MARQUE_BILLES_CONDITIONNEMENT, table1.ID_MARQUE_BILLES, table1.COMPTE
FROM conditionnement
LEFT JOIN (
SELECT marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT, marque_billes_conditionnement.ID_CONDITIONNEMENT, marque_billes_conditionnement.ID_MARQUE_BILLES, COUNT( ID_SAC_MARQUE_BILLES_CONDITIONNEMENT ) AS COMPTE
FROM marque_billes_conditionnement
LEFT JOIN sac_marque_billes_conditionnement ON marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT = sac_marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT
WHERE marque_billes_conditionnement.ID_MARQUE_BILLES =:marque_bille
GROUP BY marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT, marque_billes_conditionnement.ID_MARQUE_BILLES
) AS Table1 ON table1.ID_CONDITIONNEMENT = conditionnement.ID_CONDITIONNEMENT';

$sql_inventory_bille = 'SELECT ID_BILLES AS NUM, NOM, DESCRIPTION FROM billes ORDER BY NOM;'; //OK MIGRATION NEW BASE
$sql_owned_bille_for_login = '
SELECT billes.ID_BILLES AS NUM, billes.NOM, sac_marque_billes_conditionnement.LOGIN_COMPTE, Sum(NOMBRE*NB12) AS POSSEDE_12mm, Sum(NOMBRE*NB14) AS POSSEDE_14mm, Sum(NOMBRE*NB16) AS POSSEDE_16mm, Sum(NOMBRE*NB21) AS POSSEDE_21mm, Sum(NOMBRE*NB25) AS POSSEDE_25mm, Sum(NOMBRE*NB35) AS POSSEDE_35mm, Sum(NOMBRE*NB42) AS POSSEDE_42mm, Sum(NOMBRE*NB50) AS POSSEDE_50mm
FROM (((billes INNER JOIN marque_billes ON billes.ID_BILLES = marque_billes.ID_BILLES) 
LEFT JOIN marque_billes_conditionnement ON marque_billes.ID_MARQUE_BILLES = marque_billes_conditionnement.ID_MARQUE_BILLES) 
LEFT JOIN conditionnement ON marque_billes_conditionnement.ID_CONDITIONNEMENT = conditionnement.ID_CONDITIONNEMENT) 
LEFT JOIN sac_marque_billes_conditionnement ON marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT = sac_marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT 
GROUP BY billes.ID_BILLES, billes.NOM, sac_marque_billes_conditionnement.LOGIN_COMPTE 
HAVING (((billes.ID_BILLES)=:id_billes) AND ((sac_marque_billes_conditionnement.LOGIN_COMPTE)=:login)) 
ORDER BY billes.NOM'; //OK MIGRATION NEW BASE
$sql_get_sizes_for_id =        '
SELECT 
billes.ID_BILLES AS NUM, billes.NOM, Sum(NB12) AS NB12, Sum(NB14) AS NB14, Sum(NB16) AS NB16, Sum(NB21) AS NB21, Sum(NB25) AS NB25, Sum(NB35) AS NB35, Sum(NB42) AS NB42, Sum(NB50) AS NB50
FROM (((billes 
INNER JOIN marque_billes ON billes.ID_BILLES = marque_billes.ID_BILLES) 
LEFT JOIN marque_billes_conditionnement ON marque_billes.ID_MARQUE_BILLES = marque_billes_conditionnement.ID_MARQUE_BILLES) 
LEFT JOIN conditionnement ON marque_billes_conditionnement.ID_CONDITIONNEMENT = conditionnement.ID_CONDITIONNEMENT)
GROUP BY billes.ID_BILLES, billes.NOM HAVING billes.ID_BILLES=:id_billes ORDER BY billes.NOM'; //OK MIGRATION NEW BASE


//$sql_reference_bille = 'SELECT * FROM billes WHERE ID_BILLES = :num ;';
//$sql_reference_bille = 'SELECT NOM, MARQUE, marque_billes.ANNEE_APPARITION, marque_billes.ANNEE_DISPARITION, DESCRIPTION, DESCRIPTION_ANGLAISE, BASE_FRITTEE, BASE_IRISEE, BASE_COULEUR, BASE_TYPE, MOTIF_COULEUR, MOTIF_TYPE FROM billes, marque_billes, marques WHERE billes.ID_BILLES = marque_billes.ID_BILLES AND marque_billes.ID_MARQUE = marques.ID_MARQUE AND billes.ID_BILLES = :num';
$sql_reference_bille = 'SELECT NOM, DESCRIPTION, DESCRIPTION_ANGLAISE, BASE_FRITTEE, BASE_IRISEE, BASE_GIVREE, BASE_COULEUR, BASE_TYPE, MOTIF_COULEUR, MOTIF_TYPE FROM billes  WHERE billes.ID_BILLES = :num'; //OK MIGRATION NEW BASE

//$sql_list_labels = 'SELECT NOM_FICHIER, ID_CONDITIONNEMENT, CASE TYPE WHEN "FACE" THEN "FACE" ELSE "BACK" END AS TYPE FROM photos , billes_conditionnement, billes, conditionnement WHERE billes_conditionnement.id_conditionnement = conditionnement.nom AND billes.nom = billes_conditionnement.id_billes AND billes_conditionnement.id = photos.id_billes_conditionnement AND billes.num = :num ORDER BY ID_BILLES, ORDRE, ID_CONDITIONNEMENT, ID, TYPE DESC , ID_BILLES_CONDITIONNEMENT;'; 
$sql_list_labels = 'SELECT 
photos_sac.NOM_FICHIER,
marques.MARQUE,
billes.NOM,
conditionnement.NOM AS ID_CONDITIONNEMENT, 
photos_sac.ID_MARQUE_BILLES_CONDITIONNEMENT, 
CASE photos_sac.TYPE WHEN "FACE" THEN "FACE" ELSE "BACK" END AS TYPE 
FROM 
marques, 
billes, 
marque_billes, 
photos_sac, 
marque_billes_conditionnement,
conditionnement 
WHERE  
photos_sac.ID_MARQUE_BILLES_CONDITIONNEMENT = marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT AND 
marque_billes.ID_MARQUE_BILLES = marque_billes_conditionnement.ID_MARQUE_BILLES AND
marque_billes_conditionnement.ID_CONDITIONNEMENT = conditionnement.ID_CONDITIONNEMENT AND 
marque_billes.ID_MARQUE = marques.ID_MARQUE AND
marque_billes.ID_BILLES = billes.ID_BILLES AND
marque_billes.ID_BILLES = :id 
ORDER BY conditionnement.ORDRE, conditionnement.ID_CONDITIONNEMENT, INDEX_PHOTO ASC, TYPE DESC'; //OK MIGRATION NEW BASE

$sql_list_labels_conditionnement = 'SELECT 
photos_sac.NOM_FICHIER,marques.MARQUE,billes.NOM,conditionnement.NOM AS ID_CONDITIONNEMENT,photos_sac.ID_MARQUE_BILLES_CONDITIONNEMENT, 
CASE photos_sac.TYPE WHEN "FACE" THEN "FACE" ELSE "BACK" END AS TYPE 
FROM 
marques, billes, marque_billes, photos_sac, marque_billes_conditionnement, conditionnement 
WHERE  
photos_sac.ID_MARQUE_BILLES_CONDITIONNEMENT = :mbc AND 
photos_sac.ID_MARQUE_BILLES_CONDITIONNEMENT = marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT AND 
marque_billes.ID_MARQUE_BILLES = marque_billes_conditionnement.ID_MARQUE_BILLES AND
marque_billes_conditionnement.ID_CONDITIONNEMENT = conditionnement.ID_CONDITIONNEMENT AND 
marque_billes.ID_MARQUE = marques.ID_MARQUE AND
marque_billes.ID_BILLES = billes.ID_BILLES AND
marque_billes.ID_BILLES = :id 
ORDER BY conditionnement.ORDRE, conditionnement.ID_CONDITIONNEMENT, INDEX_PHOTO ASC, TYPE DESC';

$sql_list_autres_photos = 'SELECT CHEMIN, FICHIER, ID_BILLE, INDICE FROM autres_photos WHERE ID_BILLE=:id'; //OK MIGRATION NEW BASE

$sql_blog = 'SELECT b_post_id , b_post_title , b_post_text , b_post_date , b_post_user_id , b_statut , login as login_blog, nom as nom_blog, prenom as prenom_blog, email as b_post_user_email, gravatar_flag as b_post_user_gravatar_flag
FROM b_post, comptes
WHERE id = b_post_user_id
AND b_statut like :critere_statut
ORDER BY b_post_date DESC
LIMIT 0 , 1';

$sql_blogs = 'SELECT b_post_id , b_post_title , b_post_text , b_post_date , b_post_user_id , b_statut , login as login_blog, nom as nom_blog, prenom as prenom_blog, email as b_post_user_email, gravatar_flag as b_post_user_gravatar_flag
FROM b_post, comptes
WHERE id = b_post_user_id
AND b_statut like :critere_statut
ORDER BY b_post_date DESC
LIMIT 0 , 100';

$sql_blogs_by_user = 'SELECT b_post_id , b_post_title , b_post_text , b_post_date , b_post_user_id , b_statut , login as login_blog, nom as nom_blog, prenom as prenom_blog, email as b_post_user_email, gravatar_flag as b_post_user_gravatar_flag
FROM b_post, comptes
WHERE b_post_user_id = :user_id
AND id = b_post_user_id
AND b_statut like :critere_statut
ORDER BY b_post_date DESC
LIMIT 0 , 100';

$sql_blogs_by_blog = 'SELECT b_post_id , b_post_title , b_post_text , b_post_date , b_post_user_id , b_statut , login as login_blog, nom as nom_blog, prenom as prenom_blog, email as b_post_user_email, gravatar_flag as b_post_user_gravatar_flag
FROM b_post, comptes
WHERE b_post_id = :blog_id
AND id = b_post_user_id
AND b_statut like :critere_statut
ORDER BY b_post_date DESC
LIMIT 0 , 1';

$sql_blogs_by_tag_id = 'SELECT b_post_id , b_post_title , b_post_text , b_post_date , b_post_user_id , b_statut , login as login_blog, nom as nom_blog, prenom as prenom_blog, email as b_post_user_email, gravatar_flag as b_post_user_gravatar_flag
FROM b_post, comptes, b_post_billes
WHERE b_post_billes_billes_num = :tag_id
AND id = b_post_user_id
AND b_post_billes_post_id = b_post_id
AND b_statut like :critere_statut
ORDER BY b_post_date DESC
LIMIT 0 , 100';

$sql_blogs_by_tag_name = 'SELECT b_post_id , b_post_title , b_post_text , b_post_date , b_post_user_id , b_statut , login as login_blog, nom as nom_blog, prenom as prenom_blog, email as b_post_user_email, gravatar_flag as b_post_user_gravatar_flag
FROM b_post, comptes, b_post_billes
WHERE b_post_billes_tag_text = :tag_name
AND id = b_post_user_id
AND b_post_billes_post_id = b_post_id
AND b_statut like :critere_statut
ORDER BY b_post_date DESC
LIMIT 0 , 100';

$sql_comments_by_blog_id = 'SELECT b_comment_id , b_comment_post_id , b_comment_text , b_comment_user_id , b_comment_humor , b_comment_date , b_comment_to_id , login as login_comment, nom as nom_blog, prenom as prenom_blog, email as b_comment_user_email, gravatar_flag as b_comment_user_gravatar_flag
FROM b_comment , comptes
WHERE b_comment_post_id = :blog_id
AND id = b_comment_user_id
ORDER BY b_comment_date ASC
LIMIT 0 , 10';

$sql_tags_by_blog_id  = 'SELECT b_post_billes_post_id, b_post_billes_billes_num, nom, b_post_billes_tag_text
FROM b_post_billes
LEFT JOIN billes ON b_post_billes_billes_num = id_billes
WHERE b_post_billes_post_id = :blog_id
ORDER BY nom ASC ';

$sql_top_users  = 'SELECT b_post_user_id, login, count( b_post_user_id ) AS rate
FROM b_post, comptes
WHERE b_post_user_id = id
AND b_statut like :critere_statut
GROUP BY b_post_user_id, login
ORDER BY rate DESC
LIMIT 0 , 10';

$sql_top_tags_num_only  = 'SELECT b_post_billes_billes_num, NOM, count( b_post_billes_billes_num ) AS rate
FROM b_post, b_post_billes, billes
WHERE b_post_billes_post_id = b_post_id
AND b_post_billes_billes_num = NUM
AND b_statut like :critere_statut
GROUP BY b_post_billes_billes_num, NOM
ORDER BY rate DESC
LIMIT 0 , 10';

$sql_top_tags  = 'SELECT b_post_billes_tag_text, count( b_post_billes_tag_text ) AS rate FROM b_post, b_post_billes
WHERE b_post_billes_post_id = b_post_id
AND b_statut like :critere_statut
GROUP BY b_post_billes_tag_text
ORDER BY rate DESC, b_post_billes_tag_text
LIMIT 0 , 20';

$sql_user = 'SELECT ID, NOM, LOGIN, EMAIL, PRENOM, GRAVATAR_FLAG FROM comptes WHERE LOGIN = :login LIMIT 0,1';

$sql_bille_by_id  = 'SELECT ID_BILLES FROM billes WHERE NOM = :nom';

$sql_update_sac = 'UPDATE sac_marque_billes_conditionnement set NOMBRE = :nombre, CODE_BARRE = :code_barre, COMMENTAIRE = :commentaire where ID_SAC_MARQUE_BILLES_CONDITIONNEMENT=:id_smbc AND LOGIN_COMPTE=:login';
$sql_insert_sac = 'INSERT INTO sac_marque_billes_conditionnement (NOMBRE, CODE_BARRE, COMMENTAIRE, ID_MARQUE_BILLES_CONDITIONNEMENT, LOGIN_COMPTE) values (:nombre, :code_barre, :commentaire, :id_smbc, :login)';
$sql_delete_sac = 'DELETE FROM sac_marque_billes_conditionnement where ID_SAC_MARQUE_BILLES_CONDITIONNEMENT=:id_smbc AND LOGIN_COMPTE=:login';

$sql_photos_sac = 'SELECT ID_BILLE, ID_SAC, FICHIER FROM autres_photos_sac WHERE ID_BILLE=:id';

$sql_inventory_bille_for_login = 'SELECT 
billes.ID_BILLES AS NUM,billes.NOM, conditionnement.NOM as CONDITIONNEMENT, Sum(NOMBRE) as NBRE
FROM
billes, marque_billes, marque_billes_conditionnement,conditionnement, sac_marque_billes_conditionnement
where billes.ID_BILLES = marque_billes.ID_BILLES
AND marque_billes.ID_MARQUE_BILLES = marque_billes_conditionnement.ID_MARQUE_BILLES
AND marque_billes_conditionnement.ID_CONDITIONNEMENT = conditionnement.ID_CONDITIONNEMENT
AND (conditionnement.ID_CONDITIONNEMENT=1 OR conditionnement.ID_CONDITIONNEMENT=33 OR conditionnement.ID_CONDITIONNEMENT=43 OR conditionnement.ID_CONDITIONNEMENT=80)
AND marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT = sac_marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT
AND sac_marque_billes_conditionnement.LOGIN_COMPTE=:login AND marque_billes.ID_MARQUE=1
AND FLAG_SAC=true
GROUP BY billes.ID_BILLES, billes.NOM, conditionnement.NOM 
ORDER BY billes.NOM';