
/* images */
CREATE TABLE `img` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`folder_path`	VARCHAR (100) NOT NULL,
	`file_name`	VARCHAR (200) NOT NULL UNIQUE,
	`created_by`	INTEGER NOT NULL
);

/* seed data */
INSERT INTO `img` (folder_path, file_name, created_by) VALUES ('uploads/img/', '1.png', 1);
