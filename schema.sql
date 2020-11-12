CREATE DATABASE taskforce
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;

USE taskforce;

CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    category_id VARCHAR(25) NOT NULL,
    date_reg DATETIME NOT NULL,
    name VARCHAR(50) NOT NULL,
    status VARCHAR(5) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    phone VARCHAR(11) NOT NULL,
    skype VARCHAR(40) NOT NULL,
    telegram VARCHAR(40) NOT NULL,
    img VARCHAR(250) NOT NULL,
    birthday DATETIME NOT NULL,
    city_id INT NOT NULL,
    about VARCHAR(200) NOT NULL,
    rating INT NOT NULL,
    failed_task INT NOT NULL,
    complete_task INT NOT NULL,
    password_hash VARCHAR(250) NOT NULL,
    FOREIGN KEY (city_id) REFERENCES cities(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);
/*
status
false-заказчик
true-исполнитель
*/

CREATE TABLE categories (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    code VARCHAR(10) NOT NULL UNIQUE
);

CREATE TABLE cities (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE tasks (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date_create DATETIME NOT NULL,
    title VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    img VARCHAR(250) NOT NULL,
    price INT NOT NULL,
    date_end DATE,
    user_id INT NOT NULL,
    category_id INT NOT NULL,
    city_id INT NOT NULL,
    location VARCHAR(100),
    status_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (city_id) REFERENCES cities(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

/*
status_id статусы заданий
1-New,
2-Cancel,
3-Work,
4-Ready,
5-Failed
*/

--Заполнение с помощью json
CREATE TABLE settings (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    users_id INT NOT NULL,
    setting TEXT NOT NULL,
    FOREIGN KEY (users_id) REFERENCES users(id)
);



CREATE TABLE files (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    users_id INT NOT NULL,
    file_1 VARCHAR(250),
    file_2 VARCHAR(250),
    file_3 VARCHAR(250),
    file_4 VARCHAR(250),
    file_5 VARCHAR(250),
    file_6 VARCHAR(250),
    FOREIGN KEY (users_id) REFERENCES users(id)
);

CREATE TABLE reviews (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    task_id INT NOT NULL,
    rating INT NOT NULL,
    review TEXT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (task_id) REFERENCES tasks(id)
);
