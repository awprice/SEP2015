--USE labourhire;

--DROP TABLE offer;

CREATE TABLE offer(
  id INT PRIMARY KEY,
  owner INT NOT NULL,
  advertisement INT NOT NULL,
  description TEXT NULL,
  status INT NOT NULL,
  FOREIGN KEY(owner) REFERENCES user(id),
  FOREIGN KEY(advertisement) REFERENCES advertisement(id)
);