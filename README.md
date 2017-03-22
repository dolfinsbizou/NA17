# NA17
Projet : Exploitation Viticole.

## MCD

![UML](https://raw.githubusercontent.com/dolfinsbizou/NA17/master/UML.png)

## MLD

```
Parcelle(#id: unsigned int, sol => TypeSol, exposition => int[0,1,2], superficie: real)
Recolte(#annee: unsigned int, #id_parcelle => Parcelle, nom_cepage => Cepage, mode_culture => TypeModeCulture, mode_taille => TypeModeTaille, qte_produite: unsigned int)
TypeModeTaille(#nom: string, description: text)
TypeModeCulture(#nom: string, description: text)
Cepage(#nom: string, description: text)
TypeSol(#nom: string, description: text)
EvenementClimatique(#type => TypeEvenementClimatique, #date: date, intensite: int[0..10])
TypeEvenementClimatique(#nom: string, description: text)
Touche(#annee_recolte => Recolte, #id_parcelle_recolte => Recolte, #nom_cepage  => Cepage, degats: int[0..10])
TraitementPhytosanitaire(#nom: string, description: text)
AppliqueA(#annee_recolte => Recolte, #id_parcelle_recolte => Recolte, #nom_traitement_phytosanitaire => TraitementPhytosanitaire, nb_applications: unsigned int)
Vin(#appellation: string, #annee: unsigned int, acidite: int[0..10], robe => TypeRobe, petillant: boolean, prix_base: real, qualite: int[0..20], quantite_dispo: unsigned int)
TypeRobe(#nom: string, description: text)
Constitue(#annee_recolte => Recolte, #id_parcelle_recolte => Recolte, #appellation_vin => Vin, #annee_vin => Vin, proportion: real[0..1])
Vente(#numero_vente: unsigned int, quantite: unsigned int, prix_unit: unsigned int, prix_total: unsigned int, appellation_vin => Vin, annee_vin => Vin, nom_distributeur => Distributeur)
Distributeur(#nom: string, marge: real, type => TypeDistributeur)
TypeDistributeur(#nom: string, description: text)
```

## Contraintes d'intégrité

* La somme des proportions pour un vin donné (dans la table Constitue) doit être égale à 1.
* La somme des quantités vendues pour un vin est au plus égale à la quantité disponible de ce vin.

## Notes de clarification

### Contexte

Une exploitation viticole est constituée de nombreuses données et un exploitant veut centraliser ces données au sein d'une base de données afin d'étudier le fonctionnement de l'entreprise et d'avoir une vue d'ensemble des différents actions et événements.

### Données d’entrée

Cahier des charges du client, à retrouver plus bas.


### Objet du projet

Développement d’une application fonctionnelle répondant aux besoins du client, en mettant en place des méthodes agiles. 


### Produit du projet

Deux produits sont attendus: 

   * Rédaction d’un rapport d’analyse du projet. 
       * Le dossier doit contenir : 
       * Le MCD (modèle conceptuel de données) respectant le cahier des charges 
       * Le MLD (modèle logique de données) basé sur le MCD réalisé. 
       * Le Product Backlog du projet, décrivant les tâches à réaliser pour implémenter les fonctionnalités demandées 
   * Réalisation du projet : 
       * Implémentation dans un SGBDR. 
       * Développement d’un site de démonstration.
### Objectifs visés

    Donner un cadre d'application constant aux étudiants durant le semestre pour motiver la mise en pratique immédiate de ce qui est vu en cours
    Assurer la maîtrise technique d'une technologie
    Être en situation de gestion de projet et d'ingénierie (presque) réelle
    Faire réfléchir sur le métier d'ingénieur (implications, verrous…)


### Début du projet

Le projet aurait démarré le vendredi 10 mars en toute fin de journée.

### Acteurs du projet
#### Maîtrise d’ouvrage
Une exploitation viticole, représentée par le chargé de projet Jean-Benoist Léger
#### Maîtrise d’œuvre
Les étudiants du groupe C de NA17 pour le semestre de printemps 2017 : 

   * Charles Herlin - GI07 - Responsable de l'organisation
   * Guillaume Jorandon - GI02 - Responsable de la réalisation
   * Romain Goutiere - GI02 - Responsable revue et qualité

### Conséquence attendues

Le but de cette note de clarification est de reformuler le cahier des charges, en précisant, ajoutant et supprimant des éléments. Elle sera utilisée en tant que référence pour la suite du projet.


### Contraintes à respecter

#### Délais
Rendu de la note de clarification : 15 mars
Rendu du dossier d’analyse avec MCD et MLD : 22 mars
Une première version de l'application est à rendre pour le 29 mars
Une seconde version de l'application est à rendre pour le 5 avril

#### Techniques
Le projet sera implémenté selon une architecture LAPP. 
La livraison du projet doit être réalisée sur les serveurs de l'UV.  

### Cahier des charges du client enrichi

#### Parcelle

##### Description
Les vignes sont plantées sur des parcelles : il existe des données caractéristiques du sol (type de sol, comme de la terre argileuse), de surface d'exposition. Sur chaque parcelle est plantée un et un seul cépage. Un cépage peut être planté sur plusieurs parcelles. Une parcelle peut exister pendant un temps défini et peut ne pas être utilisée (en cas de plantation ou d'arrachage).

##### Données à enregistrer

   * Type de sol
   * Exposition
   * Taille de la parcelle
   * État de la parcelle (la parcelle est elle en cours d'utilisation)
   * Cépage utilisé
##### Remarques

   * Une parcelle ne peut contenir qu'au maximum un seul cépage.
   * Un cépage peut être présent sur plusieurs parcelles.
#### Vins

##### Description
Chaque année, plusieurs vins sont assemblés à partir de différents cépages provenant des parcelles, dans des proportions qui dépendent du choix de l'exploitant. Chaque vin est analysé et dégusté, des critères qualitatifs sont caractéristiques des vins. Chaque vin est vendu dans différents circuits de vente (direct, grossiste, détaillant...). Les chiffres de vente et les prix sont connus.

##### Données à enregistrer

   * Caractéristiques du vin - qualité
       * Acidité
       * Robe
       * Bulles
   * Cépages d'origine (en proportion, à l'initiative de l'exploitant)
   * Circuits de vente
       * vente directe
       * vente en gros
       * vente au détail
   * Prix
   * Chiffre de ventes (volume de ventes, à définir en litres ou en contenant spécifique (bouteille, caisse))
##### Remarques

   * L'assemblage dépend du choix de l'exploitant.
   * Un vin donné peut être vendu dans plusieurs circuits.
   * Pour des raisons de simplification, il semble pertinent de considérer le volume produit, en litres, et d'attribuer un prix au litre
#### Évènements climatiques

##### Description
Chaque année les conditions climatiques changent, et plusieurs évènements (grêle, sécheresse, etc.) peuvent avoir lieu. Un évènement climatique peut toucher toutes les parcelles, ou un sous-ensemble de parcelles. Il peut toucher chaque parcelle avec une intensité différente.

##### Données à enregistrer

   * Type d'évènement
   * Intensité
   * Parcelle(s) touchée(s)
   * Date
##### Remarques

   * Chaque parcelle pourra traiter indépendamment les évènements climatiques.
   * Un évènement climatique touche au minimum une parcelle et de façon atomique (son impact est considéré sur la totalité de la parcelle)
#### Modes de culture

##### Description
Certaines parcelles sont désherbées en plein, enherbées et tondues, ou cultivées. Le mode de gestion du sol peut changer à chaque année. Différents modes de taille sont utilisés sur les différentes parcelles, ceux-ci peuvent varier en fonction des années. Différents traitements phytosanitaires sont effectués, chaque année, sur tout ou partie des parcelles.

##### Données à enregistrer

   * Type d'entretien
       * désherbée en plein
       * enherbée
       * tondue
   * Mode de taille
   * Traitement(s) appliqué(s)

#### Objectifs

La réalisation de la base de données a pour finalité la valorisation des données et l'obtention de résultats nécessaires à la gestion et à la prise de décision au sein de l'exploitation selon 3 axes.

   * Financier
           * Il nous faudrait davantage d'informations sur la détermination du prix d'un vin en fonction de certains critères comme peuvent l'être la quantité produite, le nombre de récoltes faisant intervenir un cépage spécifique, les traitements phytosanitaires appliqués, et les évènements climatiques ayant touché la récolte
       * Déterminer l'influence des modes de culture sur le prix du vin.
           * On peut faire la liste des vin regroupé par prix de base et afficher quel mode de culture permet d'obtenir un prix supérieur à un seuil donné.
       * Déterminer l'influence des évènements climatiques sur le prix du vin.
           * On peut regrouper les vins par prix de base et afficher les évènements climatiques par sévérité pour constater leur influence sur le prix du vin.
   * Qualitatif
       * Déterminer l'influence des différents assemblages sur la qualité du vin.
           * On peut afficher les différents vins en fonction de leur note et les cépages qui entrent dans sa composition pour déterminer avec quels cépages il est possible d'élaborer un vin dont la note de qualité est supérieure à un seuil donné.
       * Déterminer l'influence du mode de culture sur la qualité du vin.
           * On peut faire la liste des vins en fonction de leur note et corréler avec le mode de culture pour en déduire quel mode de culture permet d'élaborer des vins dont la note de qualité est supérieure à un seuil donné.
   * Écologique
       * Déterminer l'influence du désherbage en plein sur la qualité du vin.
           * On peut regrouper les vins en fonction du mode de désherbage utilisé pour les récoltes qui entrent dans la composition de ces vins, faire la moyenne de ces vins et constater si le désherbage en plein impacte la qualité du vin de façon notable.
       * Déterminer l'influence des traitements phytosanitaires sur la qualité du vin.
           * En fonction du nombre d'applications sur une récolte donnée, nous pouvons comparer à la qualité du vin dont lesdites récoltes entrent dans la composition.
       * Trouver des moyens de réduire les traitements en conservant la qualité du vin.
           * Par fonctionnement empirique, et à partir de la métrique précédente, on peut évaluer l'évolution qualité du vin sur des années successives et des récoltes de parcelles identiques en fonction des traitements appliqués.
Dans la base de données sont présent des champs, de métriques notamment, permettant d'identifier les ressources et de les rassembler pour élaborer des bilans dans la partie applicative. 

## Backlog prévisionnel
Backlog graphique \url{https://framemo.org/NA17-P17-C} /!\ Ancienne version

Fonctions demandées par le client, en se référant aux objectifs :

   * financiers ;
   * qualitatifs ;
   * écologiques.
Il faudra s’assurer de gérer les productions par année.


   * Tables, entités :
       * Parcelle
       * Cépage
       * Récolte (cépage, parcelle, mode de culture, rendement)
       * Vin (récoltes le composant)
       * Vente (prix, quantité écoulée)
       * Distributeur 
       * Évènement climatique
       * Traitement phytosanitaire
   * Fonctionnalités : 
       * Gestion des parcelles
       * Gestion des cépages        
       * Gestion des récoltes
       * Gestion des vins
       * Notation d'un vin / caractéristique / qualité
       * Gestion du magasin de produits phytosanitaires
       * Gestion des applications de traitements phytosanitaires
       * Gestion des distributeurs
       * Gestion des opérations de vente
       * Gestion des évènements climatiques
       * Gestion des tables d'énumération
   * Dans la gestion des éléments ci dessus, il faudra implémenter les fonctions CRUD classiques: 
       * Création
       * Visualisation
       * Modification
       * Suppression
