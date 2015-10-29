USE labourhire;

--DROP TABLE offer;
--DROP TABLE advertisement;
--DROP TABLE user;

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
  companylocation TEXT NULL
);

INSERT INTO user(id, usertype, name, email, password, contactno, aboutme, qualifications, website, companyname, companylocation) VALUES (1, 0, 'John Smith', 'john.smith@email.com', '$2y$10$HWcdIEcLNgsUN7kSFKjsq.SZn1G4AiesnlehHOLSzJChre3o999dm', '04 12345678', 'Hi I am john', 'I can dig holes', 'https://google.com/', '', '');