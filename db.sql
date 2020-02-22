CREATE DATABASE sysaldo;
use sysaldo;

CREATE TABLE users (
    id int PRIMARY KEY AUTO_INCREMENT,
    name varchar(150) not null,
    email varchar(150) not null,
    password varchar(60) not null
);

CREATE TABLE balance(
    id int PRIMARY KEY AUTO_INCREMENT,
    user_id int not null,
    amount float(10,2) DEFAULT 0.00,
    FOREIGN KEY (user_id) REFERENCES users (id)
);

CREATE TABLE transaction(
    id int PRIMARY KEY AUTO_INCREMENT,
    user_id int NOT null,
    type ENUM ("I", "O", "T"),
    user_id_transfer int,
    amount float(10,2) not null,
    amount_before float(10,2) not null,
    amount_after float(10,2) not null,
    date timestamp not null DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN key (user_id_transfer) REFERENCES users (id)
);