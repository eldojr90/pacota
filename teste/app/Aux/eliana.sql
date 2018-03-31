CREATE SCHEMA eliana DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;

create table usuario(  
    u_id int not null primary key auto_increment,
    u_nome varchar(150) not null,
    u_nome_de_usuario varchar(150) not null unique,
    u_email varchar(150) not null unique,
    u_senha varchar(32) not null
);  

create table comissao(
    c_id int not null auto_increment,
    u_id int references usuario(u_id),
    c_data date not null,
    c_valor double,
    primary key (c_id),
    unique (c_data,u_id)
);