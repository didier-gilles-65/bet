select ID_BILLES, BILLE_NOM, MARQUE, COMMENTAIRE_MARQUE_BILLE, NOM, NOMBRE, CODE_BARRE, SAC_COMMENTAIRE, FICHIER, ID_SAC_MARQUE_BILLES_CONDITIONNEMENT as ID_SMBC, FLAG_SAC from 
(SELECT 
	table1.ID_BILLES, table1.BILLE_NOM, table1.FLAG_SAC, ID_MARQUE_BILLES,MARQUE,ANNEE_APPARITION,ANNEE_DISPARITION,table1.COMMENTAIRE_MARQUE_BILLE,table1.NOM,table1.COMMENTAIRE,table1.ORDRE_AFFICHAGE,table1.ID_MARQUE_BILLES_CONDITIONNEMENT,table2.NOMBRE,table2.CODE_BARRE,table2.SAC_COMMENTAIRE,table2.ID_SAC_MARQUE_BILLES_CONDITIONNEMENT
FROM (
		SELECT 
			marque_billes.ID_BILLES, billes.NOM as BILLE_NOM, marque_billes.ID_MARQUE_BILLES,marques.MARQUE,marque_billes.ANNEE_APPARITION,marque_billes.ANNEE_DISPARITION,marque_billes.COMMENTAIRE_MARQUE_BILLE,marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT,marque_billes_conditionnement.ID_CONDITIONNEMENT,conditionnement.ORDRE_AFFICHAGE,conditionnement.NOM,marque_billes_conditionnement.COMMENTAIRE,conditionnement.FLAG_SAC
		FROM billes, marque_billes, marques, marque_billes_conditionnement, conditionnement
		WHERE
			marque_billes.ID_MARQUE_BILLES=marque_billes_conditionnement.ID_MARQUE_BILLES AND 
			marque_billes_conditionnement.ID_CONDITIONNEMENT=conditionnement.ID_CONDITIONNEMENT AND 
			marque_billes.ID_MARQUE=marques.ID_MARQUE AND 
			marque_billes.ID_BILLES=billes.ID_BILLES
	)  as table1
	LEFT JOIN (
		SELECT 
			sac_marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT,CODE_BARRE,sac_marque_billes_conditionnement.COMMENTAIRE AS SAC_COMMENTAIRE,sac_marque_billes_conditionnement.ID_SAC_MARQUE_BILLES_CONDITIONNEMENT,sac_marque_billes_conditionnement.NOMBRE
		FROM sac_marque_billes_conditionnement
		WHERE LOGIN_COMPTE = 'didier'
	) as table2
	on table1.ID_MARQUE_BILLES_CONDITIONNEMENT=table2.ID_MARQUE_BILLES_CONDITIONNEMENT
WHERE table2.NOMBRE > 0
) as table3
LEFT JOIN
autres_photos_sac
on table3.ID_SAC_MARQUE_BILLES_CONDITIONNEMENT=autres_photos_sac.ID_SAC
where FLAG_SAC = true AND FICHIER is null AND SAC_COMMENTAIRE <> 'Rich Shelby'
ORDER BY ID_BILLES, MARQUE, ORDRE_AFFICHAGE, NOM