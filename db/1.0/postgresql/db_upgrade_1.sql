/*
Mysql table:
+---------+--------------+------+-----+---------+----------------+
| Field   | Type         | Null | Key | Default | Extra          |
+---------+--------------+------+-----+---------+----------------+
| id      | int(11)      | NO   | PRI | NULL    | auto_increment |
| date    | varchar(25)  | NO   |     | NULL    |                |
| title   | varchar(50)  | NO   |     | NULL    |                |
| content | text         | NO   |     | NULL    |                |
| author  | varchar(100) | NO   |     | NULL    |                |
+---------+--------------+------+-----+---------+----------------+
*/
/* articles */
--DROP TABLE articles;
CREATE TABLE articles (
	id              SERIAL          PRIMARY KEY NOT NULL,
	date            timestamp       NULL
										DEFAULT NOW(),
	title           VARCHAR(255)    NOT NULL,
	content         TEXT            NULL,
	author          VARCHAR(255)    NULL
);
GRANT ALL ON articles TO sorenso;
GRANT ALL ON articles_id_seq TO sorenso;

/* Insert dummy text. */
INSERT INTO articles (title, content, author) VALUES ('test title', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam', 'John Squibb');
