INSERT INTO TypeSol (nom, description) VALUES 
('siliceux', 'Constitué de sable, de graviers, d‘arènes granitiques, on aura des vins légers, fins; sur ces sols acides ce sont les blancs qui s‘adaptent le mieux.'),
('calcaires', 'Les vins auront une couleur soutenue, du corps, de la puissance, tout en restant rond et souples; sur sols calcaires ce sont les rouges qui s‘adaptent le mieux.'),
('argileux', 'On aura des vins  fermes à la couleur soutenue.')
;

INSERT INTO TypeModeTaille (nom, description) VALUES
('gobelet', '4 à 5 coursons à deux yeux, sur 3 à 5 bras.'),
('cordon de Royat', '1 ou 2 bras horizontaux, avec 4 à 6 courson à 2 yeux.'),
('taille chablis', 'Taille mixte en éventail.'),
('guyot','Avec un courson à deux yeux et, un peu plus haut, une baguette à six yeux environ.'),
('sylvoz','Taille longue sur une charpente longue (cordon).')
;

INSERT INTO TypeModeCulture (nom, description) VALUES
('biodynamique', 'Obtenir des plantes saines avec un rendement optimum, tout en évitant d‘épuiser les sols par une exploitation trop intensive.'),
('biologique', 'Aucune utilisation élément chimique de synthèse fabriqué par l’homme.'),
('conventionnelle', 'L’agriculture conventionnelle est aussi caractérisée par l’utilisation d’intrants de plus en plus nombreux (engrais de synthèse, pesticides, herbicides).'),
('raisonnée', 'L‘agriculture raisonnée est un mode de production agricole qui vise à une meilleure prise en compte de l‘environnement par les exploitants.'),
('intégrée', 'Pratiques agricoles pour produire des aliments en utilisant les moyens les plus naturels possible et des mécanismes régulateurs pour remplacer les apports chimiques et polluants.')
;

INSERT INTO TypeEvenementClimatique (nom, description) VALUES
('innondation', 'Un flot d‘eau important qui endommage la parcelle.'),
('orage', 'Tempête et pluie importante.'),
('tempête', 'Vents violents.'),
('sécheresse', 'Pénurie d‘eau pour irriguer les cultures.')

;

INSERT INTO TypeRobe (nom, description) VALUES
('rouge vif un peu violacé', 'Il s’agit d’un vin jeune.'),
('rouge cerise', 'Le vin est en pleine évolution, il n’a pas encore atteint sa maturité mais peut être consommé.'),
('rouge nuances orangées', 'Le vin est à boire ; s’il s’agit d’un vin de garde, il commence son évolution.'),
('rouge brun à brique', 'Il est temps de le boire.'),
('jaune pâle transparent', 'Le vin est très jeune.'),
('jaune reflets verts', 'Le vin n’a pas encore évolué.'),
('jaune paille', 'C‘est un vin à bonne maturité.'),
('jaune d’or cuivré', 'S’il s’agit d’un vin sec, il est bien évolué. S’il s’agit d’un vin liquoreux, il est à maturité.'),
('jaune brun', 'C’est un vin oxydé.'),
('rose pâle, incolore', 'C’est un vin obtenu par pressurage.'),
('rose saumoné', 'Le vin est fruité, jeune, il peut être bu.'),
('rose orangé', 'L’est un vin vieillissant.')
;

INSERT INTO TypeDistributeur (nom, description) VALUES
('direct', 'L‘entreprise est productrice du produit et le vend directement, sans intermédiaire, aux clients.'),
('grande distribution',	'Intègre les fonctions de grossiste et de détaillant en utilisant de grosses quantités de marchandises.'),
('commerce de gros', 'Achat de marchandises en grosses quantités et revente à d‘autres intermédiaires.'),
('commerce de détail', 'Achat de marchandises pour les revendre aux consommateurs.'),
('e-commerce', 'Vente des marchandises via une plateforme de commerce électronique.'),
('vente par correspondance', 'Vente des marchandises à distance sur catalogue.')
;

INSERT INTO Parcelle (id, sol, superficie) VALUES 
(1, 'siliceux', 200),
(2, 'siliceux', 300),
(3, 'argileux', 200),
(4, 'calcaires', 100),
(5, 'calcaires', 400),
(6, 'calcaires', 150),
(7, 'argileux', 300),
(8, 'argileux', 250)
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

INSERT INTO EvenementClimatique (type, date_evenement, intensite) VALUES
('innondation', '2010-12-12', 6),
('orage', '2011-05-20', 9)
;

INSERT INTO Touche (annee_recolte, id_parcelle_recolte, type_evenement, date_evenement, degats) VALUES
(2010, 1, 'innondation', '2010-12-12', 3),
(2010, 2, 'innondation', '2010-12-12', 8),
(2011, 3, 'orage', '2011-05-20', 1)
;

INSERT INTO TraitementPhytosanitaire (nom, description) VALUES
('insectator', 'Produit insecticide efficace'),
('champignator', 'Produit anti champignons'),
('désherbator', 'Produit désherbant'),
('ferrisator', 'Traitement des carences en fer')
;

INSERT INTO AppliqueA (annee_recolte, id_parcelle_recolte, nom_traitement_phytosanitaire, nb_applications) VALUES
(2010, 2, 'champignator', 4)
;

INSERT INTO Vin (appellation, annee, acidite, robe, petillant, prix_base, qualite, quantite_dispo) VALUES
('Côte du fleuve', 2010, 4, 'rouge brun à brique', false, 10, 16, 200),
('Château les Ancêtres', 2011, 7, 'jaune brun', false, 8, 13, 300),
('Champétillant', 2011, 5, 'rose saumoné', true, 12, 19, 250),
('Pinot rosé', 2010, 3, 'rose orangé', false, 15, 17, 400)
;

INSERT INTO Constitue (annee_recolte, id_parcelle_recolte, appellation_vin, annee_vin, proportion) VALUES
(2010, 1, 'Côte du fleuve', 2010, 0.2),
(2010, 2, 'Côte du fleuve', 2010, 0.8),
(2011, 3, 'Château les Ancêtres', 2011, 1),
(2011, 3, 'Champétillant', 2011, 1),
(2010, 1, 'Pinot rosé', 2010, 1)
;

INSERT INTO Distributeur (nom, marge, type) VALUES
('direct', 0, 'direct'),
('La Cavavin', 0.1, 'commerce de détail'),
('Distrivin', 0.05, 'commerce de gros'),
('Mon vin en Ligne', 0.08, 'e-commerce'),
('Carrauchan', 0.15, 'grande distribution'),
('Catalogue du vin', 0.09, 'vente par correspondance'),
('Coraply', 0.16, 'grande distribution')
;

INSERT INTO Vente (numero_vente, quantite, prix_unit, prix_total, appellation_vin, annee_vin, nom_distributeur) VALUES
(1, 8, 10, 80, 'Côte du fleuve', 2010, 'direct'),
(2, 120, 12.6, 1512, 'Champétillant', 2011, 'Distrivin')
;
