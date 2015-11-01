USE labourhire;

CREATE TABLE advertisement(
  id INT PRIMARY KEY,
  owner INT NOT NULL,
  title TEXT NOT NULL,
  startdate TEXT NULL,
  enddate TEXT NULL,
  status INT NOT NULL,
  description TEXT NOT NULL,
  location TEXT NOT NULL,
  created TEXT NOT NULL,
  category TEXT NOT NULL,
  salary TEXT NOT NULL,
  tags TEXT NULL
);