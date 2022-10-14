CREATE TABLE users(
   id_user INT NOT NULL AUTO_INCREMENT,
   name VARCHAR(100),
   lastname VARCHAR(100),
   email VARCHAR(100),
   password VARCHAR(200),
   PRIMARY KEY(id_user)
);

CREATE TABLE categories(
   id_category INT NOT NULL AUTO_INCREMENT,
   name VARCHAR(100),
   PRIMARY KEY(id_category)
);

CREATE TABLE expenses(
   id_expense INT NOT NULL AUTO_INCREMENT,
   name VARCHAR(100),
   amount DECIMAL(15,2),
   created_at DATE,
   id_category INT NOT NULL,
   id_user INT NOT NULL,
   PRIMARY KEY(id_expense),
   FOREIGN KEY(id_category) REFERENCES categories(id_category),
   FOREIGN KEY(id_user) REFERENCES users(id_user)
);
