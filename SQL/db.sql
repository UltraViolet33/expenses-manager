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


CREATE TABLE incomes(
   id_income INT NOT NULL AUTO_INCREMENT,
   name VARCHAR(100),
   amount DECIMAL(15,2),
   created_at DATE,
   id_user INT NOT NULL,
   id_recurence INT,
   PRIMARY KEY(id_income),
   FOREIGN KEY(id_user) REFERENCES users(id_user),
   FOREIGN KEY(id_recurence) REFERENCES recurences(id_recurence)
);

CREATE TABLE recurences(
   id_recurence COUNTER,
  	period ENUM('week','month') NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
   PRIMARY KEY(id_recurence)
);
