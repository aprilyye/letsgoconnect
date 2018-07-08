
/* images */
CREATE TABLE `img` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`folder_path`	VARCHAR (100) NOT NULL,
	`file_name`	VARCHAR (200) NOT NULL UNIQUE,
	`created_by`	INTEGER NOT NULL,
	`player_name`	VARCHAR (100) NOT NULL,
	`bio`	VARCHAR NOT NULL UNIQUE,
	`kgs_id`	VARCHAR (100)
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
INSERT INTO `img` (folder_path, file_name, created_by, player_name, bio, kgs_id) VALUES ('uploads/img/', '1.png', '1', 'Aaron Ye', 'I love Go', 'kgs 1');

INSERT INTO `img_region` (img_id, region_id) VALUES ('1', '1');
