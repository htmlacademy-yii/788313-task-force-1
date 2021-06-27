CREATE DATABASE taskforce
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;

USE taskforce;

CREATE TABLE city (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    lat FLOAT NOT NULL,
    lng FLOAT NOT NULL
);

CREATE TABLE category (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    code VARCHAR(10) NOT NULL UNIQUE
);

CREATE TABLE user_category (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
	user_id INT NOT NULL,
	FOREIGN KEY (category_id) REFERENCES category(id),
	FOREIGN KEY (user_id) REFERENCES user(id)
);

CREATE TABLE user (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_category_id INT NOT NULL,
    date_reg DATETIME NOT NULL,
    name VARCHAR(50) NOT NULL,
    status INT NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    phone VARCHAR(11) NOT NULL,
    skype VARCHAR(40) NOT NULL,
    telegram VARCHAR(40) NOT NULL,
    img VARCHAR(250) NOT NULL,
    birthday DATETIME NOT NULL,
    address VARCHAR(100) NOT NULL,
    city_id INT NOT NULL,
    about VARCHAR(200) NOT NULL,
    rating INT NOT NULL,
    failed_task INT NOT NULL,
    complete_task INT NOT NULL,
    password_hash VARCHAR(250) NOT NULL,
    FOREIGN KEY (city_id) REFERENCES city(id)
);

/*
status
0-заказчик
1-исполнитель
*/

CREATE TABLE task (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date_create DATETIME NOT NULL,
    title VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    img VARCHAR(250) NOT NULL,
    price INT NOT NULL,
    date_end DATE,
    user_id INT NOT NULL,
    idPerformer INT NOT NULL,
    category_id INT NOT NULL,
    address VARCHAR(100) NOT NULL,
    lat FLOAT NOT NULL,
    lng FLOAT NOT NULL,
    status_id VARCHAR(20) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (category_id) REFERENCES category(id)
);

/*
status_id статусы заданий
New,
Cancel,
Work,
Ready,
Failed
*/

/*Заполнение с помощью json*/
CREATE TABLE setting (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    setting TEXT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id)
);

CREATE TABLE file (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    file_1 VARCHAR(250),
    file_2 VARCHAR(250),
    file_3 VARCHAR(250),
    file_4 VARCHAR(250),
    file_5 VARCHAR(250),
    file_6 VARCHAR(250),
    FOREIGN KEY (user_id) REFERENCES user(id)
);

CREATE TABLE review (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    task_id INT NOT NULL,
    date_add DATETIME NOT NULL,
    rating INT NOT NULL,
    review TEXT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (task_id) REFERENCES task(id)
);
