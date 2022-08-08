create database lbmin;
use lbmin;

create table user(
	id int not null auto_increment primary key,
	name varchar(50),
	lastname varchar(50),
	username varchar(50),
	email varchar(255),
	password varchar(60),
	image varchar(255),
	status int default 1,
	kind int default 1,
	created_at datetime
);

/**
* password: encrypted using sha1(md5("mypassword"))
* status: 1. active, 2. inactive, 3. other, ...
* kind: 1. root, 2. other, ...
**/

/* insert user example */
insert into user (name,username,password,created_at) value ("Administrator","admin",sha1(md5("admin")),NOW());


create table person(
	id int not null auto_increment primary key,
	name varchar(50),
	lastname varchar(50),
	email varchar(255),
	address varchar(255),
	phone varchar(255),
	image varchar(255),
	created_at datetime
);

create table setting(
	id int not null auto_increment primary key,
	name varchar(100) not null unique,
	label varchar(200) not null,
	kind int,
	val text,
	cfg_id int default 1
);

insert into setting(name,label,kind,val) value ("general_main_title","Titulo Principal",1,"LEGOBOX");
insert into setting(name,label,kind,val) value ("general_version","Titulo Principal",1,"v4");
insert into setting(name,label,kind,val) value ("general_author","Titulo Principal",1,"Evilnapsis");
insert into setting(name,label,kind,val) value ("general_year","Titulo Principal",1,"2022");
