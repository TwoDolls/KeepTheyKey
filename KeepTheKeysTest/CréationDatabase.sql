
create database AffiliationClef;
use AffiliationClef;

Create table UTILISATEUR 
(
codeUtilisateur varchar (255) not null,
nom varchar (255) not null,
prenom varchar (255) not null,
constraint PK_UTILISATEUR PRIMARY KEY (codeUtilisateur)
);

Create table LOGICIEL
(
codeLogiciel varchar (255) not null,
libelle varchar (255) not null,
constraint PK_LOGICIEL PRIMARY KEY (codeLogiciel)
);

Create table LOT_KEY
(
codeLotKey varchar (255) not null,
dateCreation varchar (255) not null,
codeUtilisateur varchar (255) not null,
codeLogiciel varchar (255) not null,
constraint PK_LOTKEY PRIMARY KEY (codeLotKey),
constraint FK_LOTKEY_UTILISATEUR FOREIGN KEY (codeUtilisateur) references Utilisateur (codeUtilisateur),
constraint FK_LOTKEY_LOGICIEL FOREIGN KEY (codeLogiciel) references Logiciel (codeLogiciel)
);

Create table CLEF
(
codeKey varchar (255) not null,
codeLotKey varchar (255) not null,
clef varchar (255) not null,
constraint PK_KEYLOTKEY PRIMARY KEY (codeKey, codeLotKey),
constraint FK_LOTKEY FOREIGN KEY (codeLotKey) references LOT_KEY (codeLotKey)
);

