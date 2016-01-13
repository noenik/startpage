CREATE DATABASE start_page
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;
USE start_page;


CREATE TABLE Wallpaper
(
	id int NOT NULL AUTO_INCREMENT,
	img_path varchar(200) NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE Main
(
	id int NOT NULL AUTO_INCREMENT,
	slogan varchar(100) NOT NULL,
	image int NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (image) REFERENCES Wallpaper(id)
);

CREATE TABLE Category
(
	title varchar(25) NOT NULL,
	priority int NOT NULL,
	PRIMARY KEY (title)
);

CREATE TABLE List_item
(
	title varchar(50) NOT NULL,
	link varchar(200) NOT NULL,
	category varchar(25) NOT NULL,
	priority int NOT NULL,
	PRIMARY KEY (title),
	FOREIGN KEY (category) REFERENCES Category(title)
);

CREATE TABLE Sublist_item
(
	id int NOT NULL AUTO_INCREMENT,
	title varchar(50) NOT NULL,
	link varchar(200) NOT NULL,
	mainitem varchar(50) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (mainitem) REFERENCES List_item(title)
	ON DELETE CASCADE
);

INSERT INTO Wallpaper(img_path) VALUES ("background.png");

INSERT INTO Main(slogan, image) VALUES ("Welcome to the Web", 1);

INSERT INTO Category(title, priority) VALUES ("News", 1), ("Communities", 2), ("Search", 3), ("Entertainment", 4), ("Education", 5);

INSERT INTO List_item(title, link, category, priority)
VALUES ("VG", "http://www.vg.no/", "News", 1),
("Aftenposten", "http://www.aftenposten.no/", "News", 2),
("Dagbladet", "http://www.dagbladet.no/", "News", 3),
("Itavisen", "http://www.itavisen.no/", "News", 4),
("HD-Torrents", "https://hd-torrents.org/", "Communities", 1),
("Plex Forums", "https://forums.plex.tv/", "Communities", 2),
("Github", "https://github.com/noenik", "Communities", 3),
("Reddit", "https://www.reddit.com/", "Communities", 4),
("Messages - Facebook", "https://facebook.com/messages", "Communities", 5),
("Google", "#", "Communities", 6),
("YouTube", "https://www.youtube.com/feed/subscriptions", "Entertainment", 1),
("Plex", "http://192.168.1.103:32400/web/index.html", "Entertainment", 2),
("CtrlAltDel", "http://www.cad-comic.com/cad", "Entertainment", 3),
("Db - Tegneserier", "http://www.dagbladet.no/tegneserie/", "Entertainment", 4),
("XKCD", "http://xkcd.com/", "Entertainment", 5),
("Other", "#", "Entertainment", 6),
("NTNU Ålesund", "https://www.ntnu.no/studentliv/alesund", "Education", 1),
("Fronter", "https://www.fronter.com/hials/", "Education", 2),
("StudentWeb", "https://fsweb.no/studentweb/index.jsf?inst=FSHIALS", "Education", 3);

INSERT INTO Sublist_item(title, link, mainitem)
VALUES ("Drive", "https://drive.google.com/", "Google"),
("Keep", "https://keep.google.com/", "Google"),
("Mail", "https://mail.google.com", "Google"),
("Zero Punctuation", "http://www.escapistmagazine.com/videos/view/zero-punctuation", "Other");

SELECT * FROM Category JOIN List_item JOIN Sublist_item