CREATE TABLE PurchaseAnimal (
	name 				VARCHAR(32),
	type				VARCHAR(32),
	hydration			INTEGER,
	fullness			INTEGER,
	hygiene				INTEGER,
	happiness 			INTEGER,
	bodysize			INTEGER,
	pen_id				INTEGER NOT NULL,
	zooname				VARCHAR(32),
	PRIMARY KEY (name, zooname),
	FOREIGN KEY (pen_id,zooname) REFERENCES PurchasePen(id,zooname),
	FOREIGN KEY (zooname) REFERENCES Zoo(name) 
		ON DELETE CASCADE
);

CREATE TABLE PurchasePen (
	currentpopulation	INTEGER,
	quality				INTEGER,
	id 					INTEGER,
	zooname				VARCHAR(32),
	PRIMARY KEY (id, zooname),
	FOREIGN KEY (zooname) REFERENCES Zoo(name)
		ON DELETE CASCADE
);

CREATE TABLE ReviewReport (
	day					INTEGER,
	cash				INTEGER,
	zooname				VARCHAR(32),
	PRIMARY KEY (day, zooname),
	FOREIGN KEY (zooname) REFERENCES Zoo(name)
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
	FOREIGN KEY (zooname) REFERENCES Zoo(name)
		ON DELETE CASCADE
);

CREATE TABLE Zoo (
	name				VARCHAR(32)	PRIMARY KEY,
	cash				INTEGER,
	ownername			VARCHAR(32)
);