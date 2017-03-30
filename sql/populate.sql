INSERT INTO Parcelle (sol, superficie) VALUES 
('siliceux', 200),
('siliceux', 300),
('argileux', 200),
('calcaires', 100),
('calcaires', 400),
('calcaires', 150),
('argileux', 300),
('argileux', 250)
;

INSERT INTO Cepage (nom, description) VALUES
('carignan', 'noir'),
('négrette', 'noir'),
('merlot', 'noir'),
('cabernet-sauvignon', 'noir'),
('chardonnay', 'blanc'),
('riesling', 'blanc'),
('muscat', 'blanc')
;

INSERT INTO Recolte (annee, id_parcelle, nom_cepage, mode_culture, mode_taille, qte_produite) VALUES
(2010, 1, 'carignan', 'biologique', 'gobelet', 200),
(2010, 2, 'négrette', 'biodynamique', 'taille chablis', 300),
(2011, 3, 'merlot', 'conventionnelle', 'guyot', 200)
;

--INSERT INTO EvenementClimatique (type, date_evenement, intensite) VALUES

--INSERT INTO Touche (annee_recolte, id_parcelle_recolte, type_evenement, date_evenement, degats) VALUES

INSERT INTO TraitementPhytosanitaire (nom, description) VALUES
('insectator', 'Produit insecticide efficace'),
('champignator', 'Produit anti champignons'),
('désherbator', 'Produit désherbant')
('ferrisator', 'Traitement des carences en fer')
;

--INSERT INTO AppliqueA (annee_recolte, id_parcelle_recolte, nom_traitement_phytosanitaire, nb_applications) VALUES
-- annee_recolte shoud be handled at application level


INSERT INTO Vin (appellation, annee, acidite, robe, petillant, prix_base, qualite, quantite_dispo) VALUES
('Côte du fleuve', 2010, 4, 'rouge brun à brique', no, 10, 16, 200),
('Château les Ancêtres', 2011, 7, 'jaune brun', no, 8, 13, 300),
('Champétillant', 2012, 5, 'rose saumoné', yes, 12, 19, 250),
('Pinot rosé', 2010, 3, 'rose orangé', no, 15, 17, 400),
('Gamay beaujolais', 2015, 4, 'rouge nuances orangées', no, 12, 13),
('Chardon du Palais', 2013, 3, 'jaune paille', no, 14, 16)
;

--INSERT INTO Constitue (annee_recolte, id_parcelle_recolte, appellation_vin, annee_vin, proportion) VALUES

INSERT INTO Distributeur (nom, marge, type) VALUES
('direct', 0, 'direct'),
('La Cavavin', 0.1, 'commerce de détail'),
('Distrivin', 0.05, 'commerce de gros'),
('Mon vin en Ligne', 0.08, 'e-commerce'),
('Carrauchan', 0.15, 'grande distribution'),
('Catalogue du vin', 0.09, 'vente par correspondance'),
('Coraply', 0.16, 'grande distribution')
;

--INSERT INTO Vente (quantite, prix_unit, prix_total, appellation_vin, annee_vin, nom_distributeur) VALUES
-- manually enter prix_total ? Or is it computed at insertion ?

