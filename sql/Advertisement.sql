USE labourhire;

DROP TABLE advertisement;

CREATE TABLE advertisement(
  id INT PRIMARY NOT NULL,
  owner INT FOREIGN NOT NULL,
  title TEXT NOT NULL,
  startdate TEXT NULL,
  enddate TEXT NULL,
  status INT NOT NULL,
  description TEXT NOT NULL,
  location TEXT NOT NULL,
  created TEXT NOT NULL,
  category TEXT NOT NULL,
  salary TEXT NOT NULL,
  tags TEXT NULL,
  CONSTRAINT owner_fk FOREIGN KEY (owner) REFERENCES user(id)
);