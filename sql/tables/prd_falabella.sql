
DROP TABLE IF EXISTS prd_falabella;

CREATE TABLE prd_falabella(
	_id             INT           NOT NULL PRIMARY KEY AUTO_INCREMENT,
	_processId      INT           NOT NULL,
	_counter        INT           NOT NULL DEFAULT 1,
	_created        DATETIME      NOT NULL,
	_updated        DATETIME          NULL,
	_category       VARCHAR(32)   NOT NULL,
	_signature      CHAR(32)      NOT NULL,
	_title          VARCHAR(128)  NOT NULL,
	_name           VARCHAR(128)  NOT NULL,
	
	productId       VARCHAR(32)   NOT NULL,
	code            VARCHAR(128)  NOT NULL,
	url             VARCHAR(255)  NOT NULL,
	brand           VARCHAR(64)       NULL,
	backendCategory VARCHAR(64)       NULL,
	skuId           VARCHAR(64)       NULL,
	mediaAssetId    VARCHAR(64)   NOT NULL,
	price           DECIMAL(18,2) NOT NULL DEFAULT 0.0
);

CREATE INDEX ix_prd_falabella_processId ON prd_falabella(_processId);

CREATE INDEX ix_prd_falabella_catsig    ON prd_falabella(_category, _signature);

