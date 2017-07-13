begin;
CREATE TABLE state (
    id integer PRIMARY KEY NOT NULL,
    abbreviation char(2),
    name text
);
INSERT INTO state VALUES(1,'AC','Acre');
INSERT INTO state VALUES(2,'AL','Alagoas');
INSERT INTO state VALUES(3,'AP','Amapá');
INSERT INTO state VALUES(4,'AM','Amazonas');
INSERT INTO state VALUES(5,'BA','Bahia');
INSERT INTO state VALUES(6,'CE','Ceará');
INSERT INTO state VALUES(7,'DF','Distrito Federal');
INSERT INTO state VALUES(8,'ES','Espírito Santo');
INSERT INTO state VALUES(9,'GO','Goiás');
INSERT INTO state VALUES(10,'MA','Maranhão');
INSERT INTO state VALUES(11,'MT','Mato Grosso');
INSERT INTO state VALUES(12,'MS','Mato Grosso do Sul');
INSERT INTO state VALUES(13,'MG','Minas Gerais');
INSERT INTO state VALUES(14,'PA','Pará');
INSERT INTO state VALUES(15,'PB','Paraíba');
INSERT INTO state VALUES(16,'PR','Paraná');
INSERT INTO state VALUES(17,'PE','Pernambuco');
INSERT INTO state VALUES(18,'PI','Piauí');
INSERT INTO state VALUES(19,'RJ','Rio de Janeiro');
INSERT INTO state VALUES(20,'RN','Rio Grande do Norte');
INSERT INTO state VALUES(21,'RS','Rio Grande do Sul');
INSERT INTO state VALUES(22,'RO','Rondônia');
INSERT INTO state VALUES(23,'RR','Roraima');
INSERT INTO state VALUES(24,'SC','Santa Catarina');
INSERT INTO state VALUES(25,'SP','São Paulo');
INSERT INTO state VALUES(26,'SE','Sergipe');
INSERT INTO state VALUES(27,'TO','Tocantins');

CREATE TABLE city (
    id integer PRIMARY KEY NOT NULL,
    name text,
    id_state INTEGER REFERENCES state (id)
);
INSERT INTO city VALUES(1,'Aracajú',26);
INSERT INTO city VALUES(2,'Belém',14);
INSERT INTO city VALUES(3,'Belo Horizonte',13);
INSERT INTO city VALUES(4,'Boa Vista',23);
INSERT INTO city VALUES(5,'Brasília',7);
INSERT INTO city VALUES(6,'Campo Grande',12);
INSERT INTO city VALUES(7,'Cuiabá',11);
INSERT INTO city VALUES(8,'Curitiba',16);
INSERT INTO city VALUES(9,'Florianópolis',24);
INSERT INTO city VALUES(10,'Fortaleza',6);
INSERT INTO city VALUES(11,'Goiânia',9);
INSERT INTO city VALUES(12,'João person',15);
INSERT INTO city VALUES(13,'Macap ',3);
INSERT INTO city VALUES(14,'Maceió',2);
INSERT INTO city VALUES(15,'Manaus',4);
INSERT INTO city VALUES(16,'Natal',20);
INSERT INTO city VALUES(17,'Palmas',27);
INSERT INTO city VALUES(18,'Porto Alegre',21);
INSERT INTO city VALUES(19,'Porto Velho',22);
INSERT INTO city VALUES(20,'Recife',17);
INSERT INTO city VALUES(21,'Rio Branco',1);
INSERT INTO city VALUES(22,'Rio de Janeiro',19);
INSERT INTO city VALUES(23,'Salvador',5);
INSERT INTO city VALUES(24,'São Luis',10);
INSERT INTO city VALUES(25,'São Paulo',25);
INSERT INTO city VALUES(26,'Teresina',18);
INSERT INTO city VALUES(27,'Vitória',8);

CREATE TABLE group_in (
    id integer PRIMARY KEY NOT NULL,
    name text
);
INSERT INTO group_in VALUES(1,'Client');
INSERT INTO group_in VALUES(2,'Fornecedor');
INSERT INTO group_in VALUES(3,'Revendedor');
INSERT INTO group_in VALUES(4,'Colaborador');

CREATE TABLE manufacturer (
    id integer PRIMARY KEY NOT NULL,
    name text,
    site text
);
INSERT INTO manufacturer VALUES(1,'Kingston','www.kingston.com');
INSERT INTO manufacturer VALUES(2,'Seagate','www.seagate.com');
INSERT INTO manufacturer VALUES(3,'Corsair','www.corsair.com');
INSERT INTO manufacturer VALUES(4,'Olimpus','www.olimpus.com');
INSERT INTO manufacturer VALUES(5,'Samsung','www.samsung.com');
INSERT INTO manufacturer VALUES(6,'Sony','www.sony.com');
INSERT INTO manufacturer VALUES(7,'Creative','www.creative.com');
INSERT INTO manufacturer VALUES(8,'Intel','www.intel.com');
INSERT INTO manufacturer VALUES(9,'HP','www.hp.com');
INSERT INTO manufacturer VALUES(10,'Satellite','www.satellite.com');

CREATE TABLE unity (
    id integer PRIMARY KEY NOT NULL,
    abbreviation text,
    name text
);
INSERT INTO unity VALUES(1,'cm','Centímetro');
INSERT INTO unity VALUES(2,'m','Metro');
INSERT INTO unity VALUES(3,'cm2','Centímetro quadrado');
INSERT INTO unity VALUES(4,'m2','Metro quadrado');
INSERT INTO unity VALUES(5,'cm3','Centímetro cúbico');
INSERT INTO unity VALUES(6,'m3','Metro cúbico');
INSERT INTO unity VALUES(7,'Kg','Kilograma');
INSERT INTO unity VALUES(8,'Gr','Grama');
INSERT INTO unity VALUES(9,'L','Litro');
INSERT INTO unity VALUES(10,'PC','Peça');
INSERT INTO unity VALUES(11,'PCT','Pacote');
INSERT INTO unity VALUES(12,'CX','Caixa');
INSERT INTO unity VALUES(13,'SAC','Saco');
INSERT INTO unity VALUES(14,'TON','Tonelada');
INSERT INTO unity VALUES(15,'KIT','Kit');
INSERT INTO unity VALUES(16,'GL','Galão');
INSERT INTO unity VALUES(17,'FD','Fardo');
INSERT INTO unity VALUES(18,'BL','Bloco');

CREATE TABLE type_product (
    id integer PRIMARY KEY NOT NULL,
    name text
);
INSERT INTO type_product VALUES(1,'Máquina');
INSERT INTO type_product VALUES(2,'Acessório');
INSERT INTO type_product VALUES(3,'Insumo');
INSERT INTO type_product VALUES(4,'Componente');
INSERT INTO type_product VALUES(5,'Suprimento');

CREATE TABLE product (
    id integer PRIMARY KEY NOT NULL,
    description text,
    stock float,
    cost_price float,
    sale_price float,
    id_manufacturer integer references manufacturer(id),
    id_unity integer references unity(id),
    id_type_product integer references type_product(id)
);
INSERT INTO product VALUES(1,'Pendrive 512Mb',10.0,20.0,40.0,1,10,2);
INSERT INTO product VALUES(2,'HD 120 GB',20.0,100.0,180.0,2,10,4);
INSERT INTO product VALUES(3,'SD CARD  512MB',4.0,20.0,35.0,3,10,2);
INSERT INTO product VALUES(4,'SD CARD 1GB MINI',3.0,28.0,40.0,1,10,2);
INSERT INTO product VALUES(5,'CAM. FOTO I70 PLATA',5.0,600.0,900.0,5,10,1);
INSERT INTO product VALUES(6,'CAM. FOTO DSC-W50 PLATA',4.0,400.0,700.0,6,10,1);
INSERT INTO product VALUES(7,'WEBCAM INSTANT VF0040SP',4.0,50.0,80.0,7,10,1);
INSERT INTO product VALUES(8,'CPU 775 CEL.D 360  3.46 512K 533M',10.0,140.0,300.0,8,10,4);
INSERT INTO product VALUES(9,'FILMADORA DCR-DVD108',2.0,900.0,1400.0,6,10,1);
INSERT INTO product VALUES(10,'HD IDE  80G 7.200',8.0,90.0,160.0,5,10,4);
INSERT INTO product VALUES(11,'IMP LASERJET 1018 USB 2.0',4.0,200.0,300.0,9,10,1);
INSERT INTO product VALUES(12,'MEM DDR  512MB 400MHZ PC3200',10.0,60.0,100.0,5,10,4);
INSERT INTO product VALUES(13,'MEM DDR2 1024MB 533MHZ PC4200',5.0,100.0,170.0,3,10,4);
INSERT INTO product VALUES(14,'MON LCD 19 920N PRETO',2.0,500.0,800.0,5,10,4);
INSERT INTO product VALUES(15,'MOUSE USB OMC90S OPT.C/LUZ',10.0,20.0,40.0,5,10,2);
INSERT INTO product VALUES(16,'NB DV6108 CS 1.86/512/80/DVD+RW ',2.0,1400.0,2500.0,9,10,1);
INSERT INTO product VALUES(17,'NB N220E/B DC 1.6/1/80/DVD+RW ',3.0,1800.0,3400.0,6,10,1);
INSERT INTO product VALUES(18,'CAM. FOTO DSC-W90 PLATA',5.0,600.0,1200.0,6,10,1);
INSERT INTO product VALUES(19,'CART. 8767 NEGRO',20.0,30.0,50.0,9,10,3);
INSERT INTO product VALUES(20,'CD-R TUBO DE 100 52X 700MB',20.0,30.0,60.0,5,10,5);
INSERT INTO product VALUES(21,'MEM DDR 1024MB 400MHZ PC3200',7.0,80.0,150.0,1,10,4);
INSERT INTO product VALUES(22,'MOUSE PS2 A7 AZUL/PLATA',20.0,5.0,15.0,10,10,2);
INSERT INTO product VALUES(23,'SPEAKER AS-5100 HOME PRATA',5.0,100.0,180.0,10,10,2);
INSERT INTO product VALUES(24,'TEC. USB ABNT AK-806',14.0,20.0,40.0,10,10,2);

CREATE TABLE person (
    id integer PRIMARY KEY NOT NULL,
    name text,
    address text,
    neighborhood text,
    phone text,
    email text,
    id_city integer references city(id)
);
CREATE TABLE sale (
    id integer PRIMARY KEY NOT NULL,
    id_client integer references person(id),
    date_sale date,
    value_sale float,
    discount float,
    additions float,
    final_value float,
    obs text
);
CREATE TABLE item_sale (
    id integer PRIMARY KEY NOT NULL,
    id_product integer references product(id),
    id_sale integer references sale(id),
    quantity float, 
    price float
);


CREATE TABLE account (
    id integer PRIMARY KEY NOT NULL,
    id_client INTEGER REFERENCES person(id),
    dt_emission date,
    dt_expiration date,
    value float,
    paid char(1)
);

INSERT INTO person VALUES(1,'Amadeu Weirich','Rua do Amadeu Weirich','Centro','(88) 1234-5678','naoenvie@email.com',18);
INSERT INTO person VALUES(2,'Andrigo Dametto','Rua do Andrigo Dametto','Centro','(88) 1234-5678','naoenvie@email.com',3);
INSERT INTO person VALUES(3,'Enio Silveira','Rua do Enio Silveira','Centro','(88) 1234-5678','naoenvie@email.com',19);
INSERT INTO person VALUES(4,'Ari Stopassola Junior','Rua do Ari Stopassola Junior','Centro','(88) 1234-5678','naoenvie@email.com',23);
INSERT INTO person VALUES(5,'Bruno Pitteli Gonçalves','Rua do Bruno Pitteli Gonçalves','Centro','(88) 1234-5678','naoenvie@email.com',26);
INSERT INTO person VALUES(6,'Carlos Eduardo Ranzi','Rua do Carlos Eduardo Ranzi','Centro','(88) 1234-5678','naoenvie@email.com',10);
INSERT INTO person VALUES(7,'Cesar Brod','Rua do Cesar Brod','Centro','(88) 1234-5678','naoenvie@email.com',4);
INSERT INTO person VALUES(8,'Edson Funke','Rua do Edson Funke','Centro','(88) 1234-5678','naoenvie@email.com',8);
INSERT INTO person VALUES(9,'Fabio Elias Locatelli','Rua do Fabio Elias Locatelli','Centro','(88) 1234-5678','naoenvie@email.com',25);
INSERT INTO person VALUES(10,'Fabrício Pretto','Rua do Fabrício Pretto','Centro','(88) 1234-5678','naoenvie@email.com',12);
INSERT INTO person VALUES(11,'Felipe Cortez','Rua do Felipe Cortez','Centro','(88) 1234-5678','naoenvie@email.com',1);
INSERT INTO person VALUES(12,'João Pablo Silva','Rua do João Pablo Silva','Centro','(88) 1234-5678','naoenvie@email.com',20);
INSERT INTO person VALUES(13,'Cândido Fonseca da Silva','Rua do Cândido Fonseca da Silva','Centro','(88) 1234-5678','naoenvie@email.com',21);
INSERT INTO person VALUES(14,'Mouriac Diemer','Rua do Mouriac Diemer','Centro','(88) 1234-5678','naoenvie@email.com',9);
INSERT INTO person VALUES(15,'Leonardo Lemes','Rua do Leonardo Lemes','Centro','(88) 1234-5678','naoenvie@email.com',22);
INSERT INTO person VALUES(16,'Luciano Greiner Dos Santos','Rua do Luciano Greiner Dos Santos','Centro','(88) 1234-5678','naoenvie@email.com',23);
INSERT INTO person VALUES(17,'Matheus Agnes Dias','Rua do Matheus Agnes Dias','Centro','(88) 1234-5678','naoenvie@email.com',6);
INSERT INTO person VALUES(18,'Mauricio de Castro','Rua do Mauricio de Castro','Centro','(88) 1234-5678','naoenvie@email.com',21);
INSERT INTO person VALUES(19,'Nataniel Rabaioli','Rua do Nataniel Rabaioli','Centro','(88) 1234-5678','naoenvie@email.com',22);
INSERT INTO person VALUES(20,'Paulo Roberto Mallmann','Rua do Paulo Roberto Mallmann','Centro','(88) 1234-5678','naoenvie@email.com',20);
INSERT INTO person VALUES(21,'Rubens Prates','Rua do Rubens Prates','Centro','(88) 1234-5678','naoenvie@email.com',27);
INSERT INTO person VALUES(22,'Rubens Queiroz de Almeida','Rua do Rubens Queiroz de Almeida','Centro','(88) 1234-5678','naoenvie@email.com',2);
INSERT INTO person VALUES(23,'Sergio Crespo Pinto','Rua do Sergio Crespo Pinto','Centro','(88) 1234-5678','naoenvie@email.com',9);
INSERT INTO person VALUES(24,'Silvio Cesar Cazella','Rua do Silvio Cesar Cazella','Centro','(88) 1234-5678','naoenvie@email.com',18);
INSERT INTO person VALUES(25,'William Prigol Lopes','Rua do William Prigol Lopes','Centro','(88) 1234-5678','naoenvie@email.com',18);

CREATE TABLE person_group (
    id integer PRIMARY KEY NOT NULL,
    id_person integer references person(id),
    id_group integer references group_in(id)
);
INSERT INTO person_group VALUES(13,1,1);
INSERT INTO person_group VALUES(14,1,3);
INSERT INTO person_group VALUES(15,2,3);
INSERT INTO person_group VALUES(16,2,4);
INSERT INTO person_group VALUES(17,3,2);
INSERT INTO person_group VALUES(18,3,4);

INSERT INTO account VALUES(1,1,'2015-04-18','2015-04-20',195.0,'N');
INSERT INTO account VALUES(2,1,'2015-04-18','2015-05-20',195.0,'N');
INSERT INTO account VALUES(3,2,'2015-04-18','2015-04-20',132.5,'S');
INSERT INTO account VALUES(4,2,'2015-04-18','2015-05-20',132.5,'N');
INSERT INTO sale VALUES(1,1,'2015-04-18',400.0,50.0,40.0,390.0,'teste');
INSERT INTO sale VALUES(2,2,'2015-04-18',265.0,NULL,NULL,265.0,'teste2');

INSERT INTO item_sale VALUES(1,1,1,1.0,40.0);
INSERT INTO item_sale VALUES(2,2,1,2.0,180.0);
INSERT INTO item_sale VALUES(3,3,2,3.0,35.0);
INSERT INTO item_sale VALUES(4,4,2,4.0,40.0);
commit;
