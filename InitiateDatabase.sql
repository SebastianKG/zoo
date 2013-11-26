drop table reviewreport;
drop table purchaseanimal;
drop table purchaseitem;
drop table purchasepen;
drop table zoo;

CREATE TABLE Zoo (
	name			VARCHAR(32)	PRIMARY KEY,
	cash			INTEGER,
	ownername		VARCHAR(32),
    CHECK (name <> 'zoo')
);
CREATE TABLE PurchaseItem (
	name			VARCHAR(32),
	hydrationeffect		INTEGER,
	hygieneeffect		INTEGER,
	fullnesseffect		INTEGER,
	happinesseffect		INTEGER,
	amount			INTEGER,
	price			INTEGER,
	zooname			VARCHAR(32),
	PRIMARY KEY (name, zooname),
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
CREATE TABLE PurchasePen (
	currentpopulation	INTEGER,
	quality			INTEGER,
	id 			INTEGER,
	zooname			VARCHAR(32),
	PRIMARY KEY (id, zooname),
	FOREIGN KEY (zooname) REFERENCES Zoo(name)
		ON DELETE CASCADE
);
CREATE TABLE PurchaseAnimal (
	name 			VARCHAR(32),
	type			VARCHAR(32),
	hydration		INTEGER,
	fullness		INTEGER,
	hygiene			INTEGER,
	happiness 		INTEGER,
	bodysize		INTEGER,
	pen_id			INTEGER NOT NULL,
	zooname			VARCHAR(32),
	PRIMARY KEY (type, name, zooname),
	FOREIGN KEY (pen_id,zooname) REFERENCES PurchasePen(id,zooname),
	FOREIGN KEY (zooname) REFERENCES Zoo(name) 
		ON DELETE CASCADE
);

insert into zoo values ('PokeZoo', 50000, 'Harlen');
insert into zoo values ('MyCoolZoo', 10000, 'Norris');
insert into zoo values ('Best Zoo Ever', 99999, 'Sebastian');
insert into purchaseitem values ('HappyMeal', -25, -25, 20, 50, 10, 350, 'PokeZoo');
insert into purchaseitem values ('Durian', 5, -20, 50, -10, 10, 200, 'PokeZoo');
insert into purchaseitem values ('GameBoy', -5, -20, -5, 30, 10, 500, 'PokeZoo');
insert into purchaseitem values ('WhiteRussian', 20, -20, -5, 20, 10, 250, 'PokeZoo');
insert into purchaseitem values ('AxeBodyspray', 0, 20, 0, -10, 10, 150, 'PokeZoo');
insert into purchaseitem values ('HappyMeal', -25, -25, 20, 50, 10, 350, 'MyCoolZoo');
insert into purchaseitem values ('Durian', 5, -20, 50, -10, 10, 200, 'MyCoolZoo');
insert into purchaseitem values ('GameBoy', -5, -20, -5, 30, 10, 500, 'MyCoolZoo');
insert into purchaseitem values ('WhiteRussian', 20, -20, -5, 20, 10, 250, 'MyCoolZoo');
insert into purchaseitem values ('AxeBodyspray', 0, 20, 0, -10, 10, 150, 'MyCoolZoo');
insert into purchaseitem values ('HappyMeal', -25, -25, 20, 50, 30, 350, 'Best Zoo Ever');
insert into purchaseitem values ('Durian', 5, -20, 50, -10, 30, 200, 'Best Zoo Ever');
insert into purchaseitem values ('GameBoy', -5, -20, -5, 30, 30, 500, 'Best Zoo Ever');
insert into purchaseitem values ('WhiteRussian', 20, -20, -5, 20, 30, 250, 'Best Zoo Ever');
insert into purchaseitem values ('AxeBodyspray', 0, 20, 0, -10, 30, 150, 'Best Zoo Ever');
insert into purchasepen values (6, 75, 1, 'PokeZoo');
insert into purchasepen values (4, 40, 2, 'PokeZoo');
insert into purchasepen values (1, 100, 1, 'MyCoolZoo');
insert into purchasepen values (15, 100, 1, 'Best Zoo Ever');
insert into purchaseanimal values ('Pikachu', 'Charizard', 78, 87, 67, 79, 4, 2, 'PokeZoo');
insert into purchaseanimal values ('Zzzzz', 'Snorlax', 45, 80, 23, 50, 5, 1, 'PokeZoo');
insert into purchaseanimal values ('Antsy', 'Ant', 25, 52, 43, 45, 1, 1, 'PokeZoo');
insert into purchaseanimal values ('Tiny', 'Ant', 80, 81, 82, 83, 1, 1, 'MyCoolZoo');
insert into purchaseanimal values ('Anty', 'Ant', 100, 100, 100, 100, 1, 1, 'Best Zoo Ever');
insert into purchaseanimal values ('Witchy', 'Witch', 100, 100, 100, 100, 2, 1, 'Best Zoo Ever');
insert into purchaseanimal values ('Giraffey', 'Giraffe', 100, 100, 100, 100, 3, 1, 'Best Zoo Ever');
insert into purchaseanimal values ('Charizardy', 'Charizard', 100, 100, 100, 100, 4, 1, 'Best Zoo Ever');
insert into purchaseanimal values ('Snorlaxy', 'Snorlax', 100, 100, 100, 100, 5, 1, 'Best Zoo Ever');