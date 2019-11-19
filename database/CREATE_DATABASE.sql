create table produto (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    fabricante VARCHAR(255),
    descricao VARCHAR(255),
    precoVenda FLOAT,
    quantidade INT(6),
    imagem VARCHAR(255),
    data DATETIME
);

create table usuario (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    cpf VARCHAR(255),
    nome VARCHAR(255),
    email VARCHAR(255),
    senha VARCHAR(255),
    telefone VARCHAR(255),
    dataNascimento VARCHAR(255),
    profissao VARCHAR(255),
    cepEntrega VARCHAR(255),
    lougradouroEntrega VARCHAR(255),
    numeroEntrega VARCHAR(255),
    bairroEntrega VARCHAR(255),
    cidadeEntrega VARCHAR(255),
    estadoEntrega VARCHAR(255),
    cepResidencial VARCHAR(255),
    lougradouroResidencial VARCHAR(255),
    numeroResidencial VARCHAR(255),
    bairroResidencial VARCHAR(255),
    cidadeResidencial VARCHAR(255),
    estadoResidencial VARCHAR(255)
);

create table endereco (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    cep VARCHAR(255),
    lougradouro VARCHAR(255),
    bairro VARCHAR(255),
    cidade VARCHAR(255),
    estado VARCHAR(255)
);

insert into endereco(cep, lougradouro, bairro, cidade, estado) values('38408-100', 'Av. Joao Naves de Avila', 'Saraiva', 'Uberlandia', 'Minas Gerais');
insert into endereco(cep, lougradouro, bairro, cidade, estado) values('38411-145', 'Av. Paulo Gracindo', 'Gavea', 'Uberlandia', 'Minas Gerais');




create table pedido (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    idUsuario INT(6),
    data DATETIME,
    formaPagamento VARCHAR(255),
    total DOUBLE
);

alter table pedido add constraint fk_pedido_usuario foreign key (idUsuario) references usuario(id);

create table item (
    idPedido INT(6),
    idProduto INT(6),
    quantidade INT(6)
);
alter table item add constraint pk_item primary key (idPedido, idProduto);
alter table item add constraint fk_item_pedido foreign key (idPedido) references pedido(id);
alter table item add constraint fk_item_produto foreign key (idProduto) references produto(id);