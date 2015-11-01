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

INSERT INTO advertisement(
  id,
  owner,
  title,
  startdate,
  enddate,
  status,
  description,
  location,
  created,
  category,
  salary,
  tags
) VALUES (
  1,
  1,
  'Casual Job - Need holes dug',
  '1420110000',
  '1420117200',
  1,
  'I need a worker that is hard working to dig some holes for my new swimming pool.',
  'Sydney CBD',
  '1419508800',
  'Casual',
  '$50 an hour',
  'Casual, Holes, Dug'
);

INSERT INTO advertisement(
  id,
  owner,
  title,
  startdate,
  enddate,
  status,
  description,
  location,
  created,
  category,
  salary,
  tags
) VALUES (
  2,
  1,
  'Casual Job - Need sewage trench made',
  '1423573200',
  '1423587600',
  1,
  'I need a trench made for a new toilet',
  'Parramatta',
  '1419508800',
  'Casual',
  '$10 an hour',
  'Casual, Trench, Dug, Sewage, Toilet'
);