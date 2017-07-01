drop database if exists vatrogasci;
create database vatrogasci character set utf8;
use vatrogasci;

ALTER TABLE * CHARACTER SET utf8;
create table dvd(
	sifra				int not null primary key auto_increment,
	vzo					int not null,
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

create table clan(
	sifra				int not null primary key auto_increment,
	ime 				varchar(50) not null,
	prezime				varchar(50) not null,
	oib					char(11) not null,
	datum_rodenja		datetime not null,
	ulica				varchar(50) not null,
	mjesto				varchar(50) not null,
	telefon				varchar(20),
	mail				varchar(50),
	datum_uclanjenja	datetime not null,
	cin 				varchar(50),
	funkcija			varchar(50)
);

create table dvd_clan(
	sifra				int not null primary key auto_increment,
	dvd 				int not null,
	clan 				int not null
);

create table vozilo(
	sifra				int not null primary key auto_increment,
	dvd  				int not null,
	vrsta				varchar(50) not null,
	reg_oznaka			varchar(10) not null,
	naziv				varchar(20),
	proizvodac			varchar(20) not null,
	model				varchar(20) not null,
	godina_proizvodnje	datetime not null
);

create table intervencija(
	sifra						int not null primary key auto_increment,
	vrsta_intervencije			varchar(100) not null,
	podvrsta_intervencije		varchar(100) not null,
	podpodvrsta_intervencije 	varchar(100),
	podpodpodvrsta_intervencije varchar(100),	
	datum_nastanka				datetime,
	datum_dojave				datetime not null,
	datum_dolaska				datetime,	
	datum_zavrsetka			 	datetime not null,
	mjesto						varchar(50) not null,
	ulica						varchar(50),
	dojava						varchar(50),
	latitude					varchar(50),
	longitude					varchar(50),
	utrosena_sredstva			varchar(50),
	opis						text not null,
	izvjesce_popunio			varchar(50) not null
);

create table intervencija_vozilo(
	intervencija 		int not null,
	vozilo 				int not null
);

create table intervencija_clan(
	intervencija 		int not null,
	dvd_clan			int not null
);


alter table dvd_clan add foreign key (dvd) references dvd(sifra);
alter table dvd_clan add foreign key (clan) references clan(sifra);

alter table vozilo add foreign key (dvd) references dvd(sifra);

alter table intervencija_clan add foreign key (intervencija) references intervencija(sifra);
alter table intervencija_clan add foreign key (dvd_clan) references dvd_clan(sifra);

alter table intervencija_vozilo add foreign key (intervencija) references intervencija(sifra);
alter table intervencija_vozilo add foreign key (vozilo) references vozilo(sifra);

insert into dvd (vzo, naziv, oib, mb, ulica, mjesto, telefon, mail, web, godina_osnivanja) values
('Đurđenovac','DVD Šaptinovci',12345678909,1212121212,'Josipa bana Jelačića bb','Šaptinovci','+385 31 608 050','dvd.saptinovci@gmail.com','www.dvd-saptinovci.hr',1931),
('Đurđenovac','DVD Beljevina',98765432123,12121343434,'Zelena 45','Beljevina','+385 31 600 005','dvd.beljecina@gmail.com','www.dvd-beljevina.hr',1937),
('Osijek','DVD Osijek',12123456789,3434121212,'Josipa Jurija Strossmayera 45','Osijek','+385 31 688 505','dvd.osijek@gmail.com','www.dvd-osijek.hr',1930);

insert into clan (ime, prezime, oib, datum_rodenja,ulica, mjesto, telefon, mail, datum_uclanjenja, cin, funkcija) values 
('Đuro','Perić',12343456789, '1988-08-01','Šumska 23','Šaptinovci','+385 91 1234 567','duro.peric@gmail.com', '1996-01-01','Vatrogasac','Predsjednik'),
('Pero','Đurić',12345656789, '1978-07-12','Drumska 23','Beljevina','+385 95 1234 123','pero.duric@gmail.com', '1991-01-10','Vatrogasac 1. klase','Tajnik'),
('Šaro','Šarić',12345678789, '1978-05-07','Šumeđa 23','Osijek','+385 98 1234 321','saro.saris@gmail.com', '1998-08-12','Časnik','Zapovjednik');

insert into dvd_clan(dvd, clan) values
(1,1),
(2,2),
(3,3);
