CREATE DATABASE bank;
USE bank;

CREATE TABLE users (
	userid varchar(20) NOT NULL PRIMARY KEY,
    pssw varchar(260) not null,
    balance float default 499.99,
    ccbalance float default 2022.99
);

create table record(
	rid INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	userid varchar(20) not null,
    rsource varchar(40),
    diff varchar(10),
    shijian date,
    FOREIGN KEY (userid) REFERENCES users(userid)
);

create table ccrecord(
	rid INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	userid varchar(20) not null,
    rsource varchar(40),
    diff varchar(10),
    shijian date,
    FOREIGN KEY (userid) REFERENCES users(userid)
);

select * from users;

select * from record;

drop table record;
drop table users;
drop database bank;