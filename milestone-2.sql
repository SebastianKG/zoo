CREATE TABLE PurchaseAnimal (
	hydration			INTEGER,
	fullness			INTEGER,
	type				VARCHAR(32),
	hygiene				INTEGER,
	pen_id				INTEGER NOT NULL,
	zooname				VARCHAR(32),
	PRIMARY KEY (type, name, zooname),
	FOREIGN KEY (pen_id) REFERENCES PurchasePen(id
		),
	FOREIGN KEY (zooname) REFERENCES Zoo(name),
		ON DELETE CASCADE
);

CREATE TABLE PurchasePen (
	currentpopulation	INTEGER,
	quality				INTEGER,
	id 					INTEGER,
	maxpopulation		INTEGER,
	zooname				VARCHAR(32),
	PRIMARY KEY (id, zooname),
	FOREIGN KEY (zooname) REFERENCES Zoo(name), 
		ON DELETE CASCADE
);

CREATE TABLE ReviewReport (
	expense				INTEGER,
	day					DATE,
	revenue				INTEGER,
	zooname				VARCHAR(32),
	PRIMARY KEY (day, zooname),
	FOREIGN KEY (zooname) REFERENCES Zoo(name), 
		ON DELETE CASCADE
);

CREATE TABLE PurchaseItem (
	name				VARCHAR(32),
	hydrationeffect		INTEGER,
	hygieneeffect		INTEGER,
	fullnesseffect		INTEGER,
	happinesseffect		INTEGER,
	amount				INTEGER,
	price				INTEGER,
	zooname				VARCHAR(32),
	PRIMARY KEY (name, zooname),
	FOREIGN KEY (zooname) REFERENCES Zoo(name), 
		ON DELETE CASCADE
);

CREATE TABLE Zoo (
	name				VARCHAR(32)	PRIMARY KEY,
	cash				INTEGER,
	ownername			VARCHAR(32)
);