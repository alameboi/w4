CREATE TABLE users (
    id int NOT NULL AUTO_INCREMENT,
    username varchar(30) NOT NULL,
    password varchar(30) NOT NULL,
    name varchar(20) NOT NULL,
    email varchar(60) NOT NULL,
    PRIMARY KEY(id)
);
