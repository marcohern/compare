
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
	created DATETIME        NOT NULL,
	updated DATETIME            NULL
);

CREATE INDEX ix_campaigns_store_id ON campaigns(store_id);

CREATE UNIQUE INDEX un_campaigns_store_category ON campaigns(store_id, category);

