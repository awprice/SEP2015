<?php

    class Advertisement {

        /**
         * Gets an advertisement by id
         *
         * @param $id
         * @return null
         */
        static function getAdvertisement($id) {

            $mysql = new MySQL();
            $results = $mysql->query('SELECT * FROM advertisement WHERE id = :id', [':id' => $id]);

            if ($results['success'] == true && !empty($results['results']) && $results['results'] != null) {
                return $results['results'];
            }

            return null;

        }

        /**
         * Get all of the advertisements, paginated
         *
         * @param $page
         * @return null
         */
        static function getAdvertisements($page) {

            $page = (int) $page;

            if ($page <= 0) {
                return null;
            }

            $offset = ($page - 1) * 10;

            $mysql = new MySQL();
            $results = $mysql->queryAll('SELECT * FROM advertisement ORDER BY startdate ASC LIMIT ' . $offset . ', 10', []);

            if ($results['success'] == true && !empty($results['results']) && $results['results'] != null) {
                // trim the description
                foreach($results['results'] as &$result) {
                    if (strlen($result['description']) > 150) {
                        $result['description'] = substr($result['description'], 0, 150) . '...';
                    }
                }
                return $results['results'];
            }

            return null;

        }

        /**
         * Get all of the advertisements for a user
         *
         * @param $id
         * @return null
         */
        static function getUserAdvertisements($id)
        {
            $mysql = new MySQL();
            $results = $mysql->queryAll('SELECT * FROM advertisement WHERE owner = :id', [':id' => $id]);

            if ($results['success'] == true && !empty($results['results']) && $results['results'] != null) {
                return $results['results'];
            }

            return null;
        }

        /**
         * Get the total amount of advertisements
         *
         * @return null
         */
        static function getAdvertisementCount() {

            $mysql = new MySQL();
            $results = $mysql->query('SELECT COUNT(*) FROM advertisement', []);

            if ($results['success'] == true && !empty($results['results']) && $results['results'] != null) {
                return (int) $results['results']['COUNT(*)'];
            }

            return null;

        }

        /**
         * Get the next advertisement id
         *
         * @return int|null
         */
        static function getNextId() {

            $mysql = new MySQL();
            $results = $mysql->query('SELECT id FROM advertisement ORDER BY id DESC', null);

            if ($results['success'] == true) {
                $id = (int) $results['results']['id'];
                $id++;
                return $id;
            }

            return null;

        }

        /**
         * Create an advertisement
         *
         * @param $owner
         * @param $title
         * @param $startdate
         * @param $enddate
         * @param $description
         * @param $location
         * @param $category
         * @param $salary
         * @param $tags
         * @return mixed
         */
        static function createAdvertisement($owner, $title, $startdate, $enddate, $description, $location, $category, $salary, $tags) {

            $mysql = new MySQL();
            $results = $mysql->query('INSERT INTO advertisement(id, owner, title, startdate, enddate, status, description, location, created, category, salary, tags) VALUES (:id, :owner, :title, :startdate, :enddate, :status, :description, :location, :created, :category, :salary, :tags)', [
                ':id' => self::getNextId(),
                ':owner' => $owner,
                ':title' => $title,
                ':startdate' => $startdate,
                ':enddate' => $enddate,
                ':status' => 1,
                ':description' => $description,
                ':location' => $location,
                ':created' => time(),
                ':category' => $category,
                ':salary' => $salary,
                ':tags' => $tags
            ]);

            return $results['success'];

        }

        /**
         * Close an advertisement
         *
         * @param $id
         * @return mixed
         */
        static function close($id) {

            $mysql = new MySQL();
            $results = $mysql->query('UPDATE advertisement SET status = 2 WHERE id = :id', [
                ':id' => $id
            ]);

            return $results['success'];

        }

        /**
         * Open an advertisement
         *
         * @param $id
         * @return mixed
         */
        static function open($id) {

            $mysql = new MySQL();
            $results = $mysql->query('UPDATE advertisement SET status = 1 WHERE id = :id', [
                ':id' => $id
            ]);

            return $results['success'];

        }


    }

?>