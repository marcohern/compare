
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
	created  DATETIME      NOT NULL,
	updated  DATETIME          NULL
);

CREATE INDEX ix_crawlplan_order ON crawlplan(`order` ASC);

