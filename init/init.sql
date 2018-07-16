BEGIN TRANSACTION;

/* images */
CREATE TABLE `player` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`folder_path`	VARCHAR (100),
	`file_name`	VARCHAR (200) UNIQUE,
	`username`	TEXT NOT NULL UNIQUE,
	`password`	TEXT NOT NULL,
	`session`	TEXT UNIQUE,
	`first_name`	VARCHAR (100) NOT NULL,
	`last_name`	VARCHAR (100) NOT NULL,
	`bio`	TEXT NOT NULL UNIQUE,
	`ranking`	VARCHAR (100) NOT NULL,
	`kgs_id`	VARCHAR (100),
	`tygem_id`	VARCHAR (100),
	`igs_id`	VARCHAR (100)
);

/* player region */
CREATE TABLE `region` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`player_location`	VARCHAR (100) NOT NULL
);

/* relation table for img and region */
CREATE TABLE `img_region` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`img_id`	INTEGER NOT NULL,
	`region_id`	INTEGER NOT NULL,
	CONSTRAINT `both_id` UNIQUE (img_id, region_id)
);

/* seed data */
/* pswd for Aaron Ye: abc123 */
INSERT INTO `player` (username, password, folder_path, file_name,
	first_name, last_name, bio, kgs_id, tygem_id, ranking)
	VALUES ('aaron@gmail.com', '$2y$10$2bfu6UtS7g1xfr5iotJGHe/nJ7U8aQQOi.b8R8dY0dVZ4V8PtS37K',
		'uploads/img/', '1.png', 'Aaron', 'Ye', 'I love Go', 'kgs 1', 'tygem1',
		'2d');

INSERT INTO `img_region` (img_id, region_id) VALUES ('1', '1');


COMMIT;
