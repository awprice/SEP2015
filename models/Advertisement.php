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


    }

?>