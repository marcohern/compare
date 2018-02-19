
DROP TABLE IF EXISTS prd_falabella;

CREATE TABLE prd_falabella(
	_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	_processId INT NOT NULL,
	_counter   INT NOT NULL DEFAULT 1,
	_created   DATETIME NOT NULL,
	_updated   DATETIME     NULL,
	productId VARCHAR(32) NOT NULL,
	url VARCHAR(255) NOT NULL,
	brand VARCHAR(64) NULL,
	backendCategory VARCHAR(64) NULL,
	skuId VARCHAR(64) NULL,
	mediaAssetId varchar(64) NOT NULL,
	title VARCHAR(128) NOT NULL,
	name VARCHAR(128) NOT NULL,
	code VARCHAR(128) NOT NULL,
	signature CHAR(32) NOT NULL UNIQUE,
	price DECIMAL(18,2) NOT NULL DEFAULT 0.0
);

CREATE INDEX ix_prd_falabella_processId ON prd_falabella(_processId);

