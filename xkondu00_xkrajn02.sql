-- Project: skript pro vytvoreni databaze
-- Authors: xkondu00, xkrajn02

-- smazani puvodnich tabulek
-- zalezi na poradi !!!

DROP TABLE TERMIN_VYKON;
DROP TABLE TERMIN_LEK;
DROP TABLE VYKON;
DROP TABLE FAKTURA;
DROP TABLE LEK;
DROP TABLE TERMIN;
DROP TABLE PACIENT;
DROP TABLE POJISTOVNA;
DROP TABLE ZAMESTNANEC;

-- vytvoreni tabulek
CREATE TABLE PACIENT (
	ID_RC			CHAR(10) NOT NULL,
	JMENO			VARCHAR(30) NOT NULL,
	PRIJMENI		VARCHAR(30) NOT NULL,
	ULICE			VARCHAR(50) NOT NULL,
	CISLO_POPISNE	INT NOT NULL,
	MESTO			VARCHAR(30) NOT NULL,
	PSC				CHAR(5) NOT NULL,
	DATUM_NAROZENI	DATE NOT NULL,
	MAIL      VARCHAR(50) NOT NULL,
	EVIDOVAN_OD		DATE NOT NULL,
	ID_POJISTOVNA	CHAR(3) NOT NULL,
	CHECK( round(ID_RC/11.0) = ID_RC/11.0 ),
	PRIMARY KEY (ID_RC)
);

CREATE TABLE POJISTOVNA (
	ID_CP			CHAR(3) NOT NULL,
	JMENO			VARCHAR(50) NOT NULL,
	PRIMARY KEY (ID_CP)
);

CREATE TABLE VYKON (
	ID_VYKONU		INT NOT NULL AUTO_INCREMENT,
	NAZEV_VYKONU	VARCHAR(30) NOT NULL,
	EXPIRACE		INT NULL,
	PRIMARY KEY (ID_VYKONU)
);

CREATE TABLE TERMIN (
	ID_TERMINU		INT NOT NULL AUTO_INCREMENT,
	DATUM_CAS 		DATETIME NOT NULL,
	VYKONANE 		CHAR(1) NOT NULL,
	ZPRAVA			VARCHAR(1024) NOT NULL,
	ID_PACIENT		CHAR(10) NOT NULL,
	CHECK (VYKONANE in (0,1)),
	PRIMARY KEY (ID_TERMINU)
);

CREATE TABLE LEK (
	ID_LEKU			INT NOT NULL AUTO_INCREMENT,
	NAZEV			VARCHAR(30) NOT NULL,
	DRUH			VARCHAR(30) NULL,
	POPIS 			VARCHAR(256) NULL,
	PRIMARY KEY (ID_LEKU)
);

CREATE TABLE FAKTURA (
	ID_FAKTURY		INT NOT NULL AUTO_INCREMENT,
	DATUM 			DATE NOT NULL,
	CENA			INT NULL,
	DOPLATEK		INT NULL,
	ID_TERMINU		INT NOT NULL,
	PRIMARY KEY (ID_FAKTURY)
);

CREATE TABLE TERMIN_VYKON (
	ID_TERMINU		INT NOT NULL,
	ID_VYKONU		INT NOT NULL,
	PRIMARY KEY (ID_TERMINU, ID_VYKONU)
);

CREATE TABLE TERMIN_LEK (
	ID_TERMINU		INT NOT NULL,
	ID_LEKU			INT NOT NULL,
	POCET_BALENI	INT NOT NULL,
	PRIMARY KEY (ID_TERMINU, ID_LEKU)
);

CREATE TABLE ZAMESTNANEC (
	EMAIL     VARCHAR(50) NOT NULL,
	JMENO			VARCHAR(30) NOT NULL,
	PRIJMENI  VARCHAR(30) NOT NULL,
	PASSWORD  VARCHAR(257) NULL,
	DOKTOR  BIT NOT NULL,
	PRIMARY KEY (EMAIL)
);

-- log in uzivatelu
INSERT INTO ZAMESTNANEC VALUES ("vkondula@gmail.com", "Vaclav", "Kondula", NULL, 0);
INSERT INTO ZAMESTNANEC VALUES ("mkrajnak@redhat.com", "Martin", "Krajnak", NULL, 1);

-- pridani cizich klicu 1:N
ALTER TABLE PACIENT ADD CONSTRAINT FK_POJISTOVNA_PACIENT FOREIGN KEY (ID_POJISTOVNA) REFERENCES POJISTOVNA(ID_CP);
ALTER TABLE TERMIN ADD CONSTRAINT FK_PACIENT_TERMIN  FOREIGN KEY (ID_PACIENT) REFERENCES PACIENT(ID_RC) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE FAKTURA ADD CONSTRAINT FK_TERMIN_FAKTURA FOREIGN KEY (ID_TERMINU) REFERENCES TERMIN(ID_TERMINU) ON DELETE CASCADE;

-- pridani cizich klicu N:M
ALTER TABLE TERMIN_VYKON ADD CONSTRAINT FK_TERMIN_VYKON FOREIGN KEY (ID_TERMINU) REFERENCES TERMIN(ID_TERMINU) ON DELETE CASCADE;
ALTER TABLE TERMIN_VYKON ADD CONSTRAINT FK_VYKON_TERMIN FOREIGN KEY (ID_VYKONU) REFERENCES VYKON(ID_VYKONU) ON DELETE CASCADE;
--
ALTER TABLE TERMIN_LEK ADD CONSTRAINT FK_LEK_TERMIN FOREIGN KEY (ID_LEKU) REFERENCES LEK(ID_LEKU) ON DELETE CASCADE;
ALTER TABLE TERMIN_LEK ADD CONSTRAINT FK_TERMIN_LEK FOREIGN KEY (ID_TERMINU) REFERENCES TERMIN(ID_TERMINU) ON DELETE CASCADE;

-- vkladani zaznamu do tabulek
INSERT INTO POJISTOVNA VALUES('111','Všeobecná zdravotní pojišťovna ČR');
INSERT INTO POJISTOVNA VALUES('201','Vojenská zdravotní pojišťovna');
INSERT INTO POJISTOVNA VALUES('205','Česká průmyslová zdravotní pojišťovna');
INSERT INTO POJISTOVNA VALUES('207','Oborová zdravotní poj. zam. bank, poj. a stav.');
INSERT INTO POJISTOVNA VALUES('209','Zaměstnanecká pojišťovna Škoda');
INSERT INTO POJISTOVNA VALUES('211','Zdravotní pojišťovna ministerstva vnitra ČR');
INSERT INTO POJISTOVNA VALUES('213','Revírní bratrská pokladna, zdrav. pojišťovna');

INSERT INTO PACIENT VALUES ('8811050622', 'John', 'Doe', 'Kolejní', 9, 'Brno', '61205', '19981105', 'johndoe@mail.com', '20010505','111');
INSERT INTO PACIENT VALUES ('8811090629', 'Will', 'Smith', 'Palackého', 12, 'Praha', '61342','19981109', 'willsmith@mail.com','20020209','201');
INSERT INTO PACIENT VALUES ('8860030619', 'Jane', 'Doe', 'Kolejní', 9, 'Brno', '61205', '19981003', 'janedoe@mail.com','20010510','111');
INSERT INTO PACIENT VALUES ('8660030621', 'Marge', 'Smith', 'Palackého', 12, 'Praha', '61342','19861003', 'margesmith@mail.com' ,'20020209','211');

INSERT INTO VYKON VALUES(NULL, 'Očkování', 365);
INSERT INTO VYKON VALUES(NULL, 'Prohlídka', 365);
INSERT INTO VYKON VALUES(NULL, 'Odběr krve', 182);
INSERT INTO VYKON VALUES(NULL, 'Předpis léku', NULL );

INSERT INTO TERMIN VALUES(NULL, TIMESTAMP '2016-04-01 09:00:00', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','8811050622');
INSERT INTO TERMIN VALUES(NULL, TIMESTAMP '2016-04-01 10:00:00', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','8660030621');
INSERT INTO TERMIN VALUES(NULL, TIMESTAMP '2016-04-02 07:00:00', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','8860030619');
INSERT INTO TERMIN VALUES(NULL, TIMESTAMP '2016-04-02 08:00:00', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','8660030621');
INSERT INTO TERMIN VALUES(NULL, TIMESTAMP '2016-04-02 09:00:00', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','8811090629');
INSERT INTO TERMIN VALUES(NULL, TIMESTAMP '2016-04-02 09:20:00', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','8811090629');
INSERT INTO TERMIN VALUES(NULL, TIMESTAMP '2016-04-02 10:00:00', 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','8860030619');
INSERT INTO TERMIN VALUES(NULL, TIMESTAMP '2016-04-03 10:00:00', 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','8660030621');
INSERT INTO TERMIN VALUES(NULL, TIMESTAMP '2016-04-04 09:00:00', 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','8860030619');


INSERT INTO LEK VALUES(NULL, 'ASPIRIN PROTECT 100','Analgetikum', 'tbl flm 4x2,5 mg');
INSERT INTO LEK VALUES(NULL, 'UNASYN','Antibiotikum', 'tbl obd 12x375 mg');
INSERT INTO LEK VALUES(NULL, 'Avandamet','Antidiabetikum', 'tbl flm 112 (4 mg/1000 mg)');
INSERT INTO LEK VALUES(NULL, 'APROMIX','Dietetické potraviny','1x1000 g');
INSERT INTO LEK VALUES(NULL, 'KLACID 500','Antibiotikum', 'tbl flm 14x500 mg');
INSERT INTO LEK VALUES(NULL, 'OSPEN 1000','Antibiotikum', 'tbl obd 12x375 mg');
INSERT INTO LEK VALUES(NULL, 'LEKOPTIN','Gynekologiká ', 'tbl flm 112 (4 mg/1000 mg)');

INSERT INTO FAKTURA VALUES(NULL, '20160401', 800, 0, 1);
INSERT INTO FAKTURA VALUES(NULL, '20160402', 600, 300, 2);
INSERT INTO FAKTURA VALUES(NULL, '20160402', 200, 0, 3);
INSERT INTO FAKTURA VALUES(NULL, '20160402', 1000, 150, 4);
INSERT INTO FAKTURA VALUES(NULL, '20160402', 900, 0, 5);
INSERT INTO FAKTURA VALUES(NULL, '20160403', 600, 300, 6);
INSERT INTO FAKTURA VALUES(NULL, '20160403', 400, 300, 7);
INSERT INTO FAKTURA VALUES(NULL, '20160404', 1000, 150, 8);
INSERT INTO FAKTURA VALUES(NULL, '20160404', 1000, 150, 9);

INSERT INTO TERMIN_VYKON VALUES(1,3);
INSERT INTO TERMIN_VYKON VALUES(2,1);
INSERT INTO TERMIN_VYKON VALUES(3,4);
INSERT INTO TERMIN_VYKON VALUES(4,2);
INSERT INTO TERMIN_VYKON VALUES(5,3);
INSERT INTO TERMIN_VYKON VALUES(6,1);
INSERT INTO TERMIN_VYKON VALUES(7,4);
INSERT INTO TERMIN_VYKON VALUES(8,2);
INSERT INTO TERMIN_VYKON VALUES(9,3);

INSERT INTO TERMIN_LEK VALUES(1,3,1);
INSERT INTO TERMIN_LEK VALUES(2,4,2);
INSERT INTO TERMIN_LEK VALUES(3,2,4);
INSERT INTO TERMIN_LEK VALUES(5,4,2);
INSERT INTO TERMIN_LEK VALUES(6,2,4);
INSERT INTO TERMIN_LEK VALUES(7,3,1);
INSERT INTO TERMIN_LEK VALUES(8,4,2);
INSERT INTO TERMIN_LEK VALUES(9,2,4);

-- potvrzeni zmen
COMMIT;
