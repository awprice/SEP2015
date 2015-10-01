USE labourhire;

DROP TABLE offer;

CREATE TABLE offer(
  id INT PRIMARY NOT NULL,
  owner INT FOREIGN NOT NULL,
  advertisement INT FOREIGN NOT NULL,
  description TEXT NULL,
  status INT NOT NULL,
  CONSTRAINT owner_fk FOREIGN KEY (owner) REFERENCES user(id),
  CONSTRAINT owner_fk FOREIGN KEY (advertisement) REFERENCES advertisement(id)
);