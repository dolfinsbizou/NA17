INSERT INTO TypeSol (nom, description) VALUES 
('siliceux', 'Constitué de sable, de graviers, d‘arènes granitiques, on aura des vins légers, fins; sur ces sols acides ce sont les blancs qui s‘adaptent le mieux.'),
('calcaires', 'Les vins auront une couleur soutenue, du corps, de la puissance, tout en restant rond et souples; sur sols calcaires ce sont les rouges qui s‘adaptent le mieux.'),
('argileux', 'On aura des vins  fermes à la couleur soutenue.')
;

INSERT INTO TypeModeTaille (nom, description) VALUES
('Gobelet', '4 à 5 coursons à deux yeux, sur 3 à 5 bras'.),
('Cordon de Royat', '1 ou 2 bras horizontaux, avec 4 à 6 courson à 2 yeux.'),
('Taille chablis', 'Taille mixte en éventail.'),
('Guyot','Avec un courson à deux yeux et, un peu plus haut, une baguette à six yeux environ.'),
('Sylvoz','Taille longue sur une charpente longue (cordon).')
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
('rouge avec des nuances orangées', 'Le vin est à boire ; s’il s’agit d’un vin de garde, il commence son évolution.'),
('rouge brun à brique', 'Il est temps de le boire.'),
('jaune pâle, presque transparent', 'Le vin est très jeune.'),
('jaune avec des reflets un peu verts', 'Le vin n’a pas encore évolué.'),
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


