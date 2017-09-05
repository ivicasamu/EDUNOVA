drop database if exists firefighters;
create database firefighters character set utf8;
use firefighters;

alter database default character set utf8;

create table operater(
	sifra 		int not null primary key auto_increment,
	ime 		varchar(50) not null,
	prezime 	varchar(50) not null,
	email 		varchar(50) not null,
	lozinka		char(32) not null,
	uloga		varchar(50) not null,
	rezultata_po_stranici int not null default 10
);

create table sredstvo(
	sifra			int not null primary key auto_increment,
	naziv_sredstva	varchar(50) not null,
	jedinicna_mjera	varchar(50)
);

create table vrsta_intervencije(
	sifra						int not null primary key auto_increment,
	vrsta_intervencije			varchar(50) not null,
	podvrsta_intervencije		varchar(50) not null,
	podpodvrsta_intervencije	varchar(50),
	podpodpodvrsta_intervencije	varchar(50)
);

create table intervencija(
	sifra						int not null primary key auto_increment,
	vrsta_intervencije			int not null,	
	datum_nastanka				datetime,
	datum_dojave				datetime not null,
	datum_dolaska				datetime,
	datum_lokalizacije			datetime,	
	datum_zavrsetka			 	datetime not null,
	latitude					varchar(50),
	longitude					varchar(50),
	mjesto						varchar(50) not null,
	ulica						varchar(50),
	vlasnik						varchar(50),
	osteceno					varchar(100),
	prijedeno_km				decimal (5,2),
	povrijedenih_osoba			int,
	umrlih_osoba				int,	
	opis						text not null,
	izvjesce_popunio			varchar(50) not null
);

create table sredstvo_intervencija(
	sredstvo 				int not null,
	intervencija 			int not null,
	kolicina_sredstava		varchar(50)
);

create table clan(
	sifra				int not null primary key auto_increment,
	ime 				varchar(50) not null,
	prezime				varchar(50) not null,
	oib					char(11) not null,
	datum_rodenja		datetime not null,
	ulica				varchar(50) not null,
	mjesto				varchar(50) not null,
	telefon				varchar(50),
	mail				varchar(50),
	datum_uclanjenja	datetime not null
);

create table cin(
	sifra		int not null primary key auto_increment,
	naziv_cina	varchar(100) not null
);

create table clan_cin(
	clan 		int not null,
	cin 		int not null,
	datum_cina	datetime
);

create table funkcija(
	sifra			int not null primary key auto_increment,
	naziv_funkcije	varchar(100)
);

create table clan_funkcija(
	clan 						int not null,
	funkcija 					int not null,
	datum_pocetka_funkcija		datetime,
	datum_zavrsetka_funkcije	datetime
);

create table kategorizacija_vozila(
	sifra				int not null primary key auto_increment,
	vrsta_vozila		varchar(100) not null,
	podvrsta_vozila		varchar(100),
	podpodvrsta_vozila	varchar(100)
);

create table dvd(
	sifra				int not null primary key auto_increment,
	vzo					varchar(100),
	naziv				varchar(100),
	oib					char(11) not null,
	mb					varchar(20) not null,
	ulica				varchar(50) not null,
	mjesto				varchar(50) not null,
	telefon				varchar(20),
	mail				varchar(50),
	web					varchar(20),
	godina_osnivanja	datetime
);

create table vozilo(
	sifra				int not null primary key auto_increment,
	dvd  				int not null,
	vrsta				int not null,
	reg_oznaka			varchar(10) not null,
	naziv				varchar(20),
	proizvodac			varchar(20) not null,
	model				varchar(20) not null,
	godina_proizvodnje	datetime not null
);

create table vozilo_intervencija(
	vozilo 			int not null,
	intervencija 	int not null
);

create table dvd_clan(
	sifra	int not null primary key auto_increment,
	dvd 	int not null,
	clan 	int not null
);

create table intervencija_dvd_clan(
	intervencija 	int not null,
	dvd_clan 		int not null
);

alter table sredstvo_intervencija add foreign key (sredstvo) references sredstvo(sifra);
alter table sredstvo_intervencija add foreign key (intervencija) references intervencija(sifra);

alter table intervencija add foreign key (vrsta_intervencije) references vrsta_intervencije(sifra);

alter table clan_cin add foreign key (clan) references clan(sifra);
alter table clan_cin add foreign key (cin) references cin(sifra);

alter table clan_funkcija add foreign key (clan) references clan(sifra);
alter table clan_funkcija add foreign key (funkcija) references funkcija(sifra);

alter table vozilo add foreign key (vrsta) references kategorizacija_vozila(sifra);
alter table vozilo add foreign key (dvd) references dvd(sifra);

alter table vozilo_intervencija add foreign key (vozilo) references vozilo(sifra);
alter table vozilo_intervencija add foreign key (intervencija) references intervencija(sifra);

alter table dvd_clan add foreign key (dvd) references dvd(sifra);
alter table dvd_clan add foreign key (clan) references clan(sifra);

alter table intervencija_dvd_clan add foreign key (intervencija) references intervencija(sifra);
alter table intervencija_dvd_clan add foreign key (dvd_clan) references dvd_clan(sifra);

insert into vrsta_intervencije (vrsta_intervencije, podvrsta_intervencije, podpodvrsta_intervencije, podpodpodvrsta_intervencije)
values
('Požarna intervencija', 'Požar stambenog objekta', 'Obiteljska kuća',''),
('Tehnička intervencija', 'Nezgode u prometu', 'Spašavanje unesrećene osobe',''),
('Ostale intervencije', 'Prijevoz vode (po nalogu)', '',''),
('Druge aktivnosti', 'Osiguranje javnosg skupa', '','');

insert into operater (ime, prezime, email, lozinka, uloga, rezultata_po_stranici)
values
('Ivica','Šamu','ivica.samu@gmail.com',md5('ivica'),'Administrator', 10),
('Korisnik','Korisnik','korisnik@korisnik.hr',md5('korisnik'), 'Korisnik',10);

insert into sredstvo (naziv_sredstva, jedinicna_mjera)
values
('voda', 'm3'),
('pjenilo', 'l'),
('prah', 'kg'),
('CO2', 'kg');

insert into kategorizacija_vozila(vrsta_vozila, podvrsta_vozila, podpodvrsta_vozila)
values
('Vatrogasna vozila za gašenje i spašavanje','Vatrogasna vozila za gašenje požara','Vozilo za gašenje požara'),
('Vatrogasna vozila za gašenje i spašavanje','Vatrogasna vozila za gašenje požara','Vozilo za gašenje požara i tehničke intervencije'),
('Vozila za spašavanje s visina','Autoljestva (bez košare)',''),
('Vozila za spašavanje s visina','Autoljestva s košarom','');
