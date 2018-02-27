
DROP TABLE IF EXISTS prd_exito;

CREATE TABLE prd_exito (
	_id        INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	_processId INT NOT NULL,
	_counter   INT NOT NULL DEFAULT 1,
	_created   DATETIME NOT NULL,
	_updated   DATETIME     NULL,
	_category  VARCHAR(32)  NOT NULL,
	_signature CHAR(32)     NOT NULL,
	_title     VARCHAR(128) NOT NULL,
	_name      VARCHAR(128) NOT NULL,

	url1       VARCHAR(255) NOT NULL,
	code       VARCHAR(128) NOT NULL,
	image1     VARCHAR(255) NOT NULL,
	image1_alt VARCHAR(128) NOT NULL,
	brand1     VARCHAR(64) NOT NULL,
	price1     DECIMAL(18,2) NOT NULL DEFAULT 0.0,
	price2     DECIMAL(18,2) NOT NULL DEFAULT 0.0
);

CREATE INDEX ix_prd_exito_processId ON prd_exito(_processId);

CREATE INDEX ix_prd_exito_catsig    ON prd_exito(_category, _signature);

