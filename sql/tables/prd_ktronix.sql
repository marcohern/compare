
DROP TABLE IF EXISTS prd_ktronix;

CREATE TABLE prd_ktronix(
	_id        INT          NOT NULL PRIMARY KEY AUTO_INCREMENT,
	_processId INT          NOT NULL,
	_counter   INT          NOT NULL DEFAULT 1,
	_created   DATETIME     NOT NULL,
	_updated   DATETIME         NULL,
	_category  VARCHAR(32)  NOT NULL,
	_signature CHAR(32)     NOT NULL,
	_title     VARCHAR(128) NOT NULL,
	_name      VARCHAR(128) NOT NULL,

	id         VARCHAR(32)   NOT NULL,
	code       VARCHAR(128)  NOT NULL,
	brand      VARCHAR(128)  NOT NULL,
	category   VARCHAR(128)  NOT NULL,
	price      DECIMAL(18,2) NOT NULL DEFAULT 0.0,
	url        VARCHAR(128)  NOT NULL
);


CREATE INDEX ix_prd_ktronix_processId ON prd_ktronix(_processId);

CREATE INDEX ix_prd_alkosto_catsig    ON prd_ktronix(_category, _signature);

