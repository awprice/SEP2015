<?php

    class User {

        /**
         * Attempts a login by hashing the password and comparing to stored password
         *
         * @param $userId
         * @param $password
         * @return bool
         */
        static function attemptLogin($userId, $password) {

            $mysql = new MySQL();
            $results = $mysql->query('SELECT password FROM user WHERE userid = :userid', [':userid' => $userId]);

            if ($results['success'] == true && !empty($results['results']) && $results['results'] != null) {
                if (self::verifyPassword($password, $results['results']['password'])) {
                    return true;
                }
            }

            return false;

        }

        /**
         * Checks as to whether a user is logged in
         *
         * @return bool
         */
        static function isLoggedIn() {

            if (!empty($_SESSION['userId']) && $_SESSION['userId'] != null) {
                return true;
            }

            return false;

        }

        /**
         * Hashes a password
         *
         * @param $password
         * @return bool|string
         */
        static function hashPassword($password) {
            return password_hash($password, PASSWORD_DEFAULT);
        }

        /**
         * Verifies a password and hash
         *
         * @param $password
         * @param $hash
         * @return bool
         */
        static function verifyPassword($password, $hash) {
            return password_verify($password, $hash);
        }

    }

?>