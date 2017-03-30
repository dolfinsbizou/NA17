CREATE TABLE TypeSol (
	nom VARCHAR(30) PRIMARY KEY,
	description TEXT 
);

CREATE TABLE Parcelle (
	id SERIAL PRIMARY KEY NOT NULL,
	sol VARCHAR(30) REFERENCES TypeSol(nom),
	exposition INTEGER CHECK(exposition BETWEEN 0 AND 2),
	superficie DECIMAL CHECK(superficie > 0)
);

CREATE TABLE TypeModeTaille (
	nom VARCHAR(30) PRIMARY KEY,
	description TEXT 
);

CREATE TABLE TypeModeCulture (
	nom VARCHAR(30) PRIMARY KEY,
	description TEXT 
);

CREATE TABLE Cepage (
	nom VARCHAR(30) PRIMARY KEY,
	description TEXT 
);

CREATE TABLE Recolte (
	annee NUMERIC(4),
	id_parcelle INTEGER REFERENCES Parcelle(id),
	nom_cepage VARCHAR(30) REFERENCES Cepage(nom),
	mode_culture VARCHAR(30) REFERENCES TypeModeCulture(nom),
	mode_taille VARCHAR(30) REFERENCES TypeModeTaille(nom),
	qte_produite INTEGER CHECK(qte_produite > 0),
	
	PRIMARY KEY(annee, id_parcelle)
);

CREATE TABLE TypeEvenementClimatique (
	nom VARCHAR(30) PRIMARY KEY,
	description TEXT 
);

CREATE TABLE EvenementClimatique (
	type VARCHAR(30) REFERENCES TypeEvenementClimatique(nom),
	date_evenement DATE,
	intensite INT CHECK(intensite BETWEEN 0 AND 10),
	
	PRIMARY KEY(type, date_evenement)
);

CREATE TABLE Touche (
	annee_recolte NUMERIC(4),
	id_parcelle_recolte INTEGER,
	type_evenement VARCHAR(30),
	date_evenement DATE,
	degats INTEGER CHECK(degats BETWEEN 0 AND 10),
	
	FOREIGN KEY(annee_recolte, id_parcelle_recolte) REFERENCES Recolte(annee, id_parcelle),
	FOREIGN KEY(type_evenement, date_evenement) REFERENCES EvenementClimatique(type, date_evenement),
	PRIMARY KEY(annee_recolte, id_parcelle_recolte, type_evenement, date_evenement)
);

CREATE TABLE TraitementPhytosanitaire (
	nom VARCHAR(60) PRIMARY KEY,
	description TEXT 
);

CREATE TABLE AppliqueA (
	annee_recolte NUMERIC(4),
	id_parcelle_recolte INTEGER,
	nom_traitement_phytosanitaire VARCHAR(60) REFERENCES TraitementPhytosanitaire(nom),
	nb_applications INTEGER CHECK(nb_applications > 0),
	
	FOREIGN KEY(annee_recolte, id_parcelle_recolte) REFERENCES Recolte(annee, id_parcelle),
	PRIMARY KEY(annee_recolte, id_parcelle_recolte, nom_traitement_phytosanitaire)
);

CREATE TABLE TypeRobe (
	nom VARCHAR(30) PRIMARY KEY,
	description TEXT 
);

CREATE TABLE Vin (
	appellation VARCHAR(100),
	annee NUMERIC(4),
	acidite INTEGER CHECK(acidite BETWEEN 0 AND 10),
	robe VARCHAR(30) REFERENCES TypeRobe(nom),
	petillant BOOLEAN NOT NULL,
	prix_base MONEY NOT NULL,
	qualite INTEGER CHECK(qualite BETWEEN 0 AND 20),
	quantite_dispo INTEGER CHECK(quantite_dispo >= 0),
	
	PRIMARY KEY(appellation, annee)   
);

CREATE TABLE Constitue (
	annee_recolte NUMERIC(4),
	id_parcelle_recolte INTEGER,
	appellation_vin VARCHAR(100),
	annee_vin NUMERIC(4),
	proportion DECIMAL CHECK(proportion BETWEEN 0 AND 1),
	
	FOREIGN KEY(annee_recolte, id_parcelle_recolte) REFERENCES Recolte(annee, id_parcelle),
	FOREIGN KEY(appellation_vin, annee_vin) REFERENCES Vin(appellation, annee),
	PRIMARY KEY(annee_recolte, id_parcelle_recolte, appellation_vin, annee_vin)
);

CREATE TABLE TypeDistributeur (
	nom VARCHAR(30) PRIMARY KEY,
	description TEXT 
);

CREATE TABLE Distributeur (
	nom VARCHAR(40) PRIMARY KEY,
	marge DECIMAL CHECK(marge >= 0),
	type VARCHAR(30) REFERENCES TypeDistributeur(nom)
);

CREATE TABLE Vente (
	numero_vente SERIAL PRIMARY KEY NOT NULL,
	quantite INTEGER CHECK(quantite > 0),
	prix_unit MONEY NOT NULL,
	prix_total MONEY NOT NULL,
	appellation_vin VARCHAR(100),
	annee_vin NUMERIC(4),
	nom_distributeur VARCHAR(40) REFERENCES Distributeur(nom),
	
	FOREIGN KEY(appellation_vin, annee_vin) REFERENCES Vin(appellation, annee)
);
