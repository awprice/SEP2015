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


    }

?>