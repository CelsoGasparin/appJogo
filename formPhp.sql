create database formPhp;
use formPhp;

create table jogo(
	id int not null auto_increment,
    nome varchar(65) not null,
    imgURL text not null,
    plataformas varchar(125),
	lancamento date,
    generos varchar(195) not null,
    desenvolvedor varchar(65),
    publisher varchar(65),
    preco decimal,
    ageRating varchar(3),
    fileSize varchar(8),
	constraint pk_jogo primary key(id)
);