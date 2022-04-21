CREATE TABLE application5 (
    id INT(10) unsigned NOT NULL AUTO_INCREMENT,
    name VARCHAR(128) NOT NULL DEFAULT '',
    email VARCHAR(30),
    year YEAR(4),
    gender VARCHAR(10),
    kon INT(5),
    bio TEXT,
    PRIMARY KEY(id)
    );

CREATE TABLE users5(
    id INT(10) unsigned NOT NULL AUTO_INCREMENT,
    login VARCHAR(128),
    pass VARCHAR(255),
    PRIMARY KEY(id)
    );

CREATE TABLE Superpowers5(
    id INT(10) unsigned NOT NULL,
    superpowers INT(10)
    );
   
CREATE TABLE SuperDef(
    id INT(10) unsigned NOT NULL,
    name VARCHAR(128)
    );
    
 INSERT INTO SuperDef VALUES 
    ('1','Бессмертие'),
    ('2','Прохождение сквозь стены'),
    ('3','Левитация')
    ;
