USE labourhire;

CREATE TABLE rating(
  id INT PRIMARY KEY,
  owner INT NOT NULL,
  offer INT NOT NULL,
  advertisement INT NOT NULL,
  rating INT NOT NULL,
  comment TEXT NOT NULL,
  createdby INT NOT NULL
);