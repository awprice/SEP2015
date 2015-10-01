USE labourhire;

DROP TABLE user;

CREATE TABLE user(
  id INT PRIMARY NOT NULL,
  usertype INT NOT NULL,
  name TEXT NOT NULL,
  email TEXT NOT NULL,
  password TEXT NOT NULL,
  contactno TEXT NOT NULL,
  aboutme TEXT NOT NULL,
  qualifications TEXT NULL,
  website TEXT NULL,
);