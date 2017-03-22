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
