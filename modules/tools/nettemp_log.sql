BEGIN TRANSACTION;
CREATE TABLE "logs" (
	`id`	INTEGER,
	`date`	TEXT,
	`type`	TEXT,
	`message`	TEXT,
	PRIMARY KEY(id)
);
 END;
COMMIT;
