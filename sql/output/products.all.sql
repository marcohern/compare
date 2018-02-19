
DROP TABLE IF EXISTS campaigns;

CREATE TABLE campaigns (
	id         INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	store_id   INT NOT NULL,
	name       VARCHAR(128) NOT NULL,
	code       VARCHAR(32)  NOT NULL UNIQUE,
	executor   VARCHAR(128) NOT NULL,
	created DATETIME        NOT NULL,
	updated DATETIME            NULL
);

CREATE INDEX ix_campaigns_store_id ON campaigns(store_id);


DROP TABLE IF EXISTS campaign_stats;

CREATE TABLE campaign_stats(
	id           INT      NOT NULL PRIMARY KEY AUTO_INCREMENT,
	campaign_id  INT      NOT NULL,
	datestart    DATETIME NOT NULL,
	dateend      DATETIME     NULL,
	durationsec  FLOAT    NOT NULL DEFAULT 0.0,
	urlsread     INT      NOT NULL DEFAULT 0,
	records      INT      NOT NULL
);

CREATE INDEX ix_campaign_stats_campaign_id ON campaign_stats(campaign_id);

DROP TABLE IF EXISTS prd_falabella;

CREATE TABLE prd_falabella(
	_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	_processId INT NOT NULL,
	productId VARCHAR(32) NOT NULL,
	url VARCHAR(255) NOT NULL,
	brand VARCHAR(64) NULL,
	backendCategory VARCHAR(64) NULL,
	skuId VARCHAR(64) NULL,
	mediaAssetId varchar(64) NOT NULL,
	title VARCHAR(128) NOT NULL,
	name VARCHAR(128) NOT NULL,
	code VARCHAR(128) NOT NULL,
	signature CHAR(32) NOT NULL,
	price DECIMAL(18,2) NOT NULL DEFAULT 0.0
);

CREATE INDEX ix_prd_falabella_processId ON prd_falabella(_processId);


DROP TABLE IF EXISTS prd_ktronix;

CREATE TABLE prd_ktronix(
	_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	_processId INT NOT NULL,
	id VARCHAR(32) NOT NULL,
	title VARCHAR(128) NOT NULL,
	name VARCHAR(128) NOT NULL,
	code VARCHAR(128) NOT NULL,
	signature VARCHAR(32) NOT NULL,
	brand VARCHAR(128) NOT NULL,
	category VARCHAR(128) NOT NULL
);


CREATE INDEX ix_prd_ktronix_processId ON prd_ktronix(_processId);

DROP TABLE IF EXISTS stores;

CREATE TABLE stores (
	id      INT          NOT NULL PRIMARY KEY AUTO_INCREMENT,
	code    VARCHAR(6)   NOT NULL UNIQUE,
	name    VARCHAR(128) NOT NULL,
	country CHAR(2)      NOT NULL,
	url     VARCHAR(128) NOT NULL,
	created DATETIME     NOT NULL,
	updated DATETIME         NULL
);


INSERT INTO campaigns(id, store_id, name, code, executor, created, updated) VALUES
(1, 1, 'K-Tronix Videojuegos PS4', 'KTRONIX-PS4-GAMES', 'KtronixVgPs4Executor', NOW(), NULL),
(2, 4, 'Falabella Videojuegos PS4', 'FALABELLA-PS4-GAMES', 'FalabellaVgPs4Executor', NOW(), NULL);


INSERT INTO stores(id, code, name, country, url, created) VALUES
(1,'KTR','K-Tronix'    , 'CO','http://www.ktronix.com', NOW()),
(2,'ALK','Alkosto'     , 'CO','http://www.alkosto.com', NOW()),
(3,'AKO','Alkomprar'   , 'CO','http://www.alkomprar.com', NOW()),
(4,'FLB','Fallabella'  , 'CO','https://www.falabella.com.co/falabella-co/', NOW()),
(5,'EXT','Exito'       , 'CO','https://www.exito.com/', NOW()),
(6,'PAN','Panamericana', 'CO','https://www.panamericana.com.co', NOW());

