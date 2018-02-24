
DROP TABLE IF EXISTS log;

CREATE TABLE log(
	id       INT           NOT NULL PRIMARY KEY AUTO_INCREMENT,
	category VARCHAR(32)   NOT NULL,
	message  VARCHAR(255)  NOT NULL,
	start    DATETIME      NOT NULL,
	`end`    DATETIME          NULL,
	duration DECIMAL(16,8) NOT NULL,
	created  DATETIME      NOT NULL
);

