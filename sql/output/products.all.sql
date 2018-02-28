
DROP TABLE IF EXISTS campaigns;

CREATE TABLE campaigns (
	id         INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	store_id   INT NOT NULL,
	name       VARCHAR(128) NOT NULL,
	url        VARCHAR(255) NOT NULL,
	urltpl     VARCHAR(255) NOT NULL,
	code       VARCHAR(32)  NOT NULL UNIQUE,
	category   VARCHAR(32)  NOT NULL,
	executor   VARCHAR(128) NOT NULL,
	`table`    VARCHAR(32)  NOT NULL,
	created DATETIME        NOT NULL,
	updated DATETIME            NULL
);

CREATE INDEX ix_campaigns_store_id ON campaigns(store_id);

CREATE UNIQUE INDEX un_campaigns_store_category ON campaigns(store_id, category);


DROP TABLE IF EXISTS crawlplan;

CREATE TABLE crawlplan(
	id       INT           NOT NULL PRIMARY KEY AUTO_INCREMENT,
	url      VARCHAR(255)  NOT NULL,
	status   ENUM('PENDING','EXECUTED') DEFAULT 'PENDING',
	rpp      INT           NOT NULL,
	total    INT           NOT NULL,
	pages    INT           NOT NULL,
	page     INT           NOT NULL,
	offset   INT           NOT NULL,
	expected INT           NOT NULL DEFAULT 0,
	acquired INT           NOT NULL DEFAULT 0,
	`order`  INT           NOT NULL DEFAULT 0,
	campaign_id INT        NOT NULL,
	created  DATETIME      NOT NULL,
	updated  DATETIME          NULL
);

CREATE INDEX ix_crawlplan_campaign_order ON crawlplan(campaign_id ASC, `order` ASC);


DROP TABLE IF EXISTS `import`;

CREATE TABLE  `import`(
	id          INT           NOT NULL PRIMARY KEY AUTO_INCREMENT,
	campaign_id INT           NOT NULL,
	status      ENUM('ACTIVE','INACTIVE') NOT NULL DEFAULT 'INACTIVE',
	expected    INT           NOT NULL,
	acquired    INT           NOT NULL,
	iduration   DECIMAL(16,8) NOT NULL,
	tduration   DECIMAL(16,8) NOT NULL,

	created  DATETIME         NOT NULL,
	updated  DATETIME             NULL
);


DROP TABLE IF EXISTS log;

CREATE TABLE log(
	id       INT           NOT NULL PRIMARY KEY AUTO_INCREMENT,
	category VARCHAR(32)   NOT NULL,
	message  VARCHAR(255)  NOT NULL,
	start    DATETIME          NULL,
	`end`    DATETIME          NULL,
	duration DECIMAL(16,8) NOT NULL,
	created  DATETIME      NOT NULL,
	updated  DATETIME          NULL
);


DROP TABLE IF EXISTS prd_alkomprar;

CREATE TABLE prd_alkomprar (
	_id          INT           NOT NULL PRIMARY KEY AUTO_INCREMENT,
	_campaign_id INT           NOT NULL,
	_import_id   INT           NOT NULL,
	_counter     INT           NOT NULL DEFAULT 1,
	_category    VARCHAR( 32)  NOT NULL,
	_signature   CHAR(32)      NOT NULL,
	_title       VARCHAR(128)  NOT NULL,
	_name        VARCHAR(128)  NOT NULL,
	_created     DATETIME      NOT NULL,
	_updated     DATETIME          NULL,

	id         VARCHAR(32)   NOT NULL,
	code       VARCHAR(128)  NOT NULL,
	brand      VARCHAR(128)  NOT NULL,
	category   VARCHAR(128)  NOT NULL,
	price      DECIMAL(18,2) NOT NULL DEFAULT 0.0,
	url        VARCHAR(128)  NOT NULL
);


CREATE INDEX ix_prd_alkomprar_campaign_id ON prd_alkomprar(_campaign_id);

CREATE INDEX ix_prd_alkomprar_catsig    ON prd_alkomprar(_category, _signature);


DROP TABLE IF EXISTS prd_alkosto;

CREATE TABLE prd_alkosto(
	_id          INT           NOT NULL PRIMARY KEY AUTO_INCREMENT,
	_campaign_id INT           NOT NULL,
	_import_id   INT           NOT NULL,
	_counter     INT           NOT NULL DEFAULT 1,
	_category    VARCHAR( 32)  NOT NULL,
	_signature   CHAR(32)      NOT NULL,
	_title       VARCHAR(128)  NOT NULL,
	_name        VARCHAR(128)  NOT NULL,
	_created     DATETIME      NOT NULL,
	_updated     DATETIME          NULL,

	id         VARCHAR(32)   NOT NULL,
	code       VARCHAR(128)  NOT NULL,
	brand      VARCHAR(128)  NOT NULL,
	category   VARCHAR(128)  NOT NULL,
	price      DECIMAL(18,2) NOT NULL DEFAULT 0.0,
	url        VARCHAR(128)  NOT NULL
);


CREATE INDEX ix_prd_alkosto_campaign_id ON prd_alkosto(_campaign_id);

CREATE INDEX ix_prd_alkosto_catsig    ON prd_alkosto(_category, _signature);


DROP TABLE IF EXISTS prd_exito;

CREATE TABLE prd_exito (
	_id          INT           NOT NULL PRIMARY KEY AUTO_INCREMENT,
	_campaign_id INT           NOT NULL,
	_import_id   INT           NOT NULL,
	_counter     INT           NOT NULL DEFAULT 1,
	_category    VARCHAR( 32)  NOT NULL,
	_signature   CHAR(32)      NOT NULL,
	_title       VARCHAR(128)  NOT NULL,
	_name        VARCHAR(128)  NOT NULL,
	_created     DATETIME      NOT NULL,
	_updated     DATETIME          NULL,

	url1       VARCHAR(255) NOT NULL,
	code       VARCHAR(128) NOT NULL,
	image1     VARCHAR(255) NOT NULL,
	image1_alt VARCHAR(128) NOT NULL,
	brand1     VARCHAR(64) NOT NULL,
	price1     DECIMAL(18,2) NOT NULL DEFAULT 0.0,
	price2     DECIMAL(18,2) NOT NULL DEFAULT 0.0
);

CREATE INDEX ix_prd_exito_campaign_id ON prd_exito(_campaign_id);

CREATE INDEX ix_prd_exito_catsig    ON prd_exito(_category, _signature);


DROP TABLE IF EXISTS prd_falabella;

CREATE TABLE prd_falabella(
	_id          INT           NOT NULL PRIMARY KEY AUTO_INCREMENT,
	_campaign_id INT           NOT NULL,
	_import_id   INT           NOT NULL,
	_counter     INT           NOT NULL DEFAULT 1,
	_category    VARCHAR( 32)  NOT NULL,
	_signature   CHAR(32)      NOT NULL,
	_title       VARCHAR(128)  NOT NULL,
	_name        VARCHAR(128)  NOT NULL,
	_created     DATETIME      NOT NULL,
	_updated     DATETIME          NULL,
	
	productId       VARCHAR(32)   NOT NULL,
	code            VARCHAR(128)  NOT NULL,
	url             VARCHAR(255)  NOT NULL,
	brand           VARCHAR(64)       NULL,
	backendCategory VARCHAR(64)       NULL,
	skuId           VARCHAR(64)       NULL,
	mediaAssetId    VARCHAR(64)   NOT NULL,
	price           DECIMAL(18,2) NOT NULL DEFAULT 0.0
);

CREATE INDEX ix_prd_falabella_campaign_id ON prd_falabella(_campaign_id);

CREATE INDEX ix_prd_falabella_catsig    ON prd_falabella(_category, _signature);


DROP TABLE IF EXISTS prd_ktronix;

CREATE TABLE prd_ktronix(
	_id          INT           NOT NULL PRIMARY KEY AUTO_INCREMENT,
	_campaign_id INT           NOT NULL,
	_import_id   INT           NOT NULL,
	_counter     INT           NOT NULL DEFAULT 1,
	_category    VARCHAR( 32)  NOT NULL,
	_signature   CHAR(32)      NOT NULL,
	_title       VARCHAR(128)  NOT NULL,
	_name        VARCHAR(128)  NOT NULL,
	_created     DATETIME      NOT NULL,
	_updated     DATETIME          NULL,

	id           VARCHAR(32)   NOT NULL,
	code         VARCHAR(128)  NOT NULL,
	brand        VARCHAR(128)  NOT NULL,
	category     VARCHAR(128)  NOT NULL,
	price        DECIMAL(18,2) NOT NULL DEFAULT 0.0,
	url          VARCHAR(128)  NOT NULL
);


CREATE INDEX ix_prd_ktronix_processId ON prd_ktronix(_campaign_id);

CREATE INDEX ix_prd_alkosto_catsig    ON prd_ktronix(_category, _signature);


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


TRUNCATE TABLE campaigns;

INSERT INTO campaigns(id, store_id, name, code, category, url, urltpl, executor, `table`, created, updated) VALUES
-- KTRONIX
(1, 1, 'K-Tronix Videojuegos PS4', 'KTR-PS4-GAMES', 'PS4-GAMES'
	, 'http://www.ktronix.com/videojuegos/play-station-ps3-ps4-psvita-move/videojuegos-playstation/juegos-playstation-4'
	, 'http://www.ktronix.com/videojuegos/play-station-ps3-ps4-psvita-move/videojuegos-playstation/juegos-playstation-4?p=[p1]'
	, 'KtronixVgPs4Executor','prd_ktronix', NOW(), NULL),

-- ALKOSTO
(2, 2, 'Alkosto Videojuegos PS4', 'ALK-PS4-GAMES', 'PS4-GAMES'
	, 'http://www.alkosto.com/videojuegos/play-station-ps3-ps4-psvita-move/videojuegos-playstation/juegos-playstation-4'
	, 'http://www.alkosto.com/videojuegos/play-station-ps3-ps4-psvita-move/videojuegos-playstation/juegos-playstation-4?p=[p1]'
	, 'KtronixVgPs4Executor','prd_alkosto', NOW(), NULL),

-- ALKOMPRAR
(3, 3, 'Alkomprar Videojuegos PS4', 'AKO-PS4-GAMES', 'PS4-GAMES'
	, 'http://www.alkomprar.com/videojuegos/play-station-ps3-ps4-psvita-move/videojuegos-playstation/juegos-playstation-4'
	, 'http://www.alkomprar.com/videojuegos/play-station-ps3-ps4-psvita-move/videojuegos-playstation/juegos-playstation-4?p=[p1]'
	, 'KtronixVgPs4Executor','prd_alkomprar', NOW(), NULL),

-- FALABELLA
(4, 4, 'Falabella Videojuegos PS4', 'FLB-PS4-GAMES', 'PS4-GAMES'
	, 'https://www.falabella.com.co/falabella-co/category/cat3020960/PS4'
	, 'https://www.falabella.com.co/rest/model/falabella/rest/browse/BrowseActor/get-product-record-list?[json]'
	, 'FalabellaVgPs4Executor','prd_falabella', NOW(), NULL),

-- EXITO
(5, 5, 'Exito Videojuegos PS4', 'EXT-PS4-GAMES', 'PS4-GAMES'
	, 'https://www.exito.com/Tecnologia-Consolas_y_video_juegos-PlayStation_4-Juegos_PS4/_/N-2b5q'
	, 'https://www.exito.com/Tecnologia-Consolas_y_video_juegos-PlayStation_4-Juegos_PS4/_/N-2b5q?No=[offset]&Nrpp=[rpp]'
	, 'ExitoVgPs4Executor','prd_exito', NOW(), NULL);


TRUNCATE TABLE crawlplan;


INSERT INTO stores(id, code, name, country, url, created) VALUES
(1,'KTR','K-Tronix'    , 'CO','http://www.ktronix.com', NOW()),
(2,'ALK','Alkosto'     , 'CO','http://www.alkosto.com', NOW()),
(3,'AKO','Alkomprar'   , 'CO','http://www.alkomprar.com', NOW()),
(4,'FLB','Fallabella'  , 'CO','https://www.falabella.com.co/falabella-co/', NOW()),
(5,'EXT','Exito'       , 'CO','https://www.exito.com/', NOW()),
(6,'PAN','Panamericana', 'CO','https://www.panamericana.com.co', NOW());

