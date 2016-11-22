/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     21/11/2016 18:56:41                          */
/*==============================================================*/


drop table if exists CENAS;

drop table if exists ENVIADO;

drop table if exists FAMILIAS;

drop table if exists INGREDIENTES;

drop table if exists INVITADOS;

drop table if exists MENUS;

drop table if exists TRAE;

/*==============================================================*/
/* Table: CENAS                                                 */
/*==============================================================*/
create table CENAS
(
   ID_CENAS             int not null auto_increment,
   FECHA_CENAS          date not null,
   LUGAR_CENAS          varchar(200) not null,
   LONGITUD_CENAS       decimal(2,16) not null,
   LATITUD_CENAS        decimal(2,16) not null,
   HORA_CENAS           time not null,
   ENCARGADOS_CENAS     varchar(200) not null,
   INVITACION_CENAS     text,
   primary key (ID_CENAS)
);

/*==============================================================*/
/* Table: ENVIADO                                               */
/*==============================================================*/
create table ENVIADO
(
   ID_CENAS             int not null,
   ID_INVI              int not null,
   EN_ENVIADO           smallint not null default 1,
   FECHA_ENVIADO        timestamp not null,
   primary key (ID_CENAS, ID_INVI)
);

/*==============================================================*/
/* Table: FAMILIAS                                              */
/*==============================================================*/
create table FAMILIAS
(
   ID_FAMILIA           int not null auto_increment,
   ID_CENAS             int not null,
   DENO_FAMILIA         varchar(250) not null,
   primary key (ID_FAMILIA)
);

/*==============================================================*/
/* Table: INGREDIENTES                                          */
/*==============================================================*/
create table INGREDIENTES
(
   ID_INGRE             int not null auto_increment,
   ID_MENUS             int not null,
   CANTIDAD_INGRE       int not null,
   UNIDAD_INGRE         varchar(20) not null,
   DETALLE_INGRE        varchar(250) not null,
   IMAGEN_INGRE         varchar(250),
   primary key (ID_INGRE)
);

/*==============================================================*/
/* Table: INVITADOS                                             */
/*==============================================================*/
create table INVITADOS
(
   ID_INVI              int not null auto_increment,
   ID_FAMILIA           int not null,
   NOMBRES_INVI         varchar(250) not null,
   CELULAR_INVI         varchar(10),
   EMAIL_INVI           char(200),
   CIUDAD_INVI          varchar(100),
   HASH_INVI            char(42),
   primary key (ID_INVI)
);

/*==============================================================*/
/* Table: MENUS                                                 */
/*==============================================================*/
create table MENUS
(
   ID_MENUS             int not null auto_increment,
   DETALLE_MENUS        varchar(200) not null,
   MOSTRAR_MENUS        bool not null,
   ID_CENAS             int not null,
   primary key (ID_MENUS)
);

/*==============================================================*/
/* Table: TRAE                                                  */
/*==============================================================*/
create table TRAE
(
   ID_INGRE             int not null,
   ID_INVI              int not null,
   FECHA_TRAE           timestamp not null,
   CANTI_TRAE           int not null,
   primary key (ID_INGRE, ID_INVI)
);

alter table ENVIADO add constraint FK_ENVIADO foreign key (ID_INVI)
      references INVITADOS (ID_INVI) on delete restrict on update restrict;

alter table ENVIADO add constraint FK_ENVIADO2 foreign key (ID_CENAS)
      references CENAS (ID_CENAS) on delete restrict on update restrict;

alter table FAMILIAS add constraint FK_VIENEN foreign key (ID_CENAS)
      references CENAS (ID_CENAS) on delete restrict on update restrict;

alter table INGREDIENTES add constraint FK_SE_HACE foreign key (ID_MENUS)
      references MENUS (ID_MENUS) on delete restrict on update restrict;

alter table INVITADOS add constraint FK_ESTA_COMPUESTA foreign key (ID_FAMILIA)
      references FAMILIAS (ID_FAMILIA) on delete restrict on update restrict;

alter table MENUS add constraint FK_TIENE foreign key (ID_CENAS)
      references CENAS (ID_CENAS) on delete restrict on update restrict;

alter table TRAE add constraint FK_TRAE foreign key (ID_INVI)
      references INVITADOS (ID_INVI) on delete restrict on update restrict;

alter table TRAE add constraint FK_TRAE2 foreign key (ID_INGRE)
      references INGREDIENTES (ID_INGRE) on delete restrict on update restrict;

