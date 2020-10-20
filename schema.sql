CREATE DATABASE taskforce
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;

USE taskforce;

CREATE TABLE user (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_category VARCHAR(100),
    date_reg DATETIME,
    name VARCHAR(200) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    phone VARCHAR(11) NOT NULL UNIQUE,
    skype VARCHAR(100),
    telegram VARCHAR(100),
    img VARCHAR(250),
    birthday DATETIME NOT NULL,
    id_city INT,
    about VARCHAR(200),
    rating INT,
    password TEXT,
    FOREIGN KEY (id_city) REFERENCES cities(id),
    FOREIGN KEY (id_category) REFERENCES categories(id)
);

CREATE TABLE categories (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    code VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE cities (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120)
);

CREATE TABLE task (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date_create DATETIME,
    title VARCHAR(150),
    description TEXT(5000),
    img VARCHAR(250),
    status INT NOT NULL,
    price INT,
    date_end DATE,
    id_user INT NOT NULL,
    id_category INT  NOT NULL,
    id_city INT,
    location VARCHAR(100),
    id_status INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES user(id),
    FOREIGN KEY (id_city) REFERENCES cities(id),
    FOREIGN KEY (id_category) REFERENCES categories(id),
    FOREIGN KEY (id_status) REFERENCES status(id)
);

CREATE TABLE status (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(120)
);

CREATE TABLE reviews (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_task INT NOT NULL,
    rating INT,
    review TEXT,
    FOREIGN KEY (id_user) REFERENCES user(id),
    FOREIGN KEY (id_task) REFERENCES task(id)
);
