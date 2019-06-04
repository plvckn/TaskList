CREATE DATABASE task_list;

CREATE TABLE User (
    id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(255),
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    Email VARCHAR(255),
    password VARCHAR(255),
    PRIMARY KEY (id)
);

INSERT INTO User (username, password) VALUES ('admin', 'admin');

CREATE USER 'user'@'localhost' IDENTIFIED BY 'user';
GRANT ALL ON task_list.* TO 'user'@'localhost';
FLUSH PRIVILEGES;

ALTER USER 'user'@'localhost' IDENTIFIED WITH mysql_native_password BY 'user';

CREATE TABLE Task (
  id INT(11) NOT NULL AUTO_INCREMENT,
  description VARCHAR(255),
  PRIMARY KEY (id)
);

CREATE TABLE Assigned_task (
  task_id INT(11),
  user_id INT(11),
  completed BOOLEAN,
  FOREIGN KEY (task_id) REFERENCES Task(id),
  FOREIGN KEY (user_id) REFERENCES User(id)
);
