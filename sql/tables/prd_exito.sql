
DROP TABLE IF EXISTS prd_exito;

CREATE TABLE prd_exito (
	_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	_processId INT NOT NULL,

);

CREATE INDEX ix_prd_exito_processId ON prd_exito(_processId);

