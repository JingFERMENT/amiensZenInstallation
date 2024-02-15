CREATE TABLE categories(
   id_category INT AUTO_INCREMENT,
   name VARCHAR(100) ,
   PRIMARY KEY(id_category)
);

CREATE TABLE subscribers(
   id_subscriber INT AUTO_INCREMENT,
   lastname VARCHAR(255)  NOT NULL,
   firstname VARCHAR(255)  NOT NULL,
   email VARCHAR(255)  NOT NULL,
   password VARCHAR(255)  NOT NULL,
   birthdate DATE NOT NULL,
   phone VARCHAR(20) ,
   profile_picture VARCHAR(50) ,
   subscribed_at DATETIME,
   updated_at DATETIME,
   deleted_at DATETIME,
   is_admin BOOLEAN,
   personal_advice BOOLEAN NOT NULL,
   family_situation VARCHAR(255)  NOT NULL,
   PRIMARY KEY(id_subscriber),
   UNIQUE(email)
);

CREATE TABLE posts(
   id_post INT AUTO_INCREMENT,
   title VARCHAR(255)  NOT NULL,
   content TEXT NOT NULL,
   published_at DATETIME,
   updated_at DATETIME,
   archived_at DATETIME,
   deleted_at DATETIME,
   photo VARCHAR(50) ,
   id_subscriber INT NOT NULL,
   PRIMARY KEY(id_post),
   FOREIGN KEY(id_subscriber) REFERENCES subscribers(id_subscriber)
);

CREATE TABLE comments(
   id_comment INT AUTO_INCREMENT,
   description TEXT NOT NULL,
   created_at DATETIME,
   deleted_at DATETIME,
   validated_at DATETIME,
   id_post INT NOT NULL,
   id_subscriber INT NOT NULL,
   PRIMARY KEY(id_comment),
   FOREIGN KEY(id_post) REFERENCES posts(id_post),
   FOREIGN KEY(id_subscriber) REFERENCES subscribers(id_subscriber)
);

CREATE TABLE posts_categories(
   id_category INT,
   id_post INT,
   PRIMARY KEY(id_category, id_post),
   FOREIGN KEY(id_category) REFERENCES categories(id_category),
   FOREIGN KEY(id_post) REFERENCES posts(id_post)
);

CREATE TABLE subscribers_categories(
   id_category INT,
   id_subscriber INT,
   PRIMARY KEY(id_category, id_subscriber),
   FOREIGN KEY(id_category) REFERENCES categories(id_category),
   FOREIGN KEY(id_subscriber) REFERENCES subscribers(id_subscriber)
);

CREATE TABLE favorite_articles(
   id_post INT,
   id_subscriber INT,
   PRIMARY KEY(id_post, id_subscriber),
   FOREIGN KEY(id_post) REFERENCES posts(id_post),
   FOREIGN KEY(id_subscriber) REFERENCES subscribers(id_subscriber)
);
