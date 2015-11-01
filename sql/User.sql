USE labourhire;

CREATE TABLE user(
  id INT PRIMARY KEY,
  usertype INT NOT NULL,
  name TEXT NOT NULL,
  email TEXT NOT NULL,
  password TEXT NOT NULL,
  contactno TEXT NOT NULL,
  aboutme TEXT NOT NULL,
  qualifications TEXT NULL,
  website TEXT NULL,
  companyname TEXT NULL,
  companylocation TEXT NULL,
  availability TEXT NOT NULL
);