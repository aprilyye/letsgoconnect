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
	`email`	VARCHAR (100) NOT NULL,
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
INSERT INTO `player` (username, password, folder_path, file_name,
	first_name, last_name, bio, kgs_id, tygem_id, email, ranking)
	VALUES ('aaron', 'abc123', 'uploads/img/', '1.png', 'Aaron',
		'Ye', 'I love Go', 'kgs 1', 'tygem1', 'aa@gmail.com', '2d');

INSERT INTO `img_region` (img_id, region_id) VALUES ('1', '1');


COMMIT;
