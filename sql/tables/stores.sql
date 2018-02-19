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

