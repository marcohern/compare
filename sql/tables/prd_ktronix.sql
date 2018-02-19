
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

