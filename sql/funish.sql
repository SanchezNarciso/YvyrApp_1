CREATE TABLE funish.usuarios (
  id integer unsigned NOT NULL AUTO_INCREMENT,
  nombre varchar(100) NOT NULL,
  usuario varchar(100) NOT NULL,
  clave varchar(100) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY usuarios_un (usuario)
);