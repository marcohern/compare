
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

