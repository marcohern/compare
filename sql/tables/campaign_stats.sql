
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
