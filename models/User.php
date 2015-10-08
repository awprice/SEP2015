<?php

    class User {

        /**
         * Gets a user
         *
         * @param $id
         * @return null
         */
        static function getUser($id = null) {

            $mysql = new MySQL();
            if ($id == null) {
                $id = self::getId();
            }
            $results = $mysql->query('SELECT * FROM user WHERE id = :id', [':id' => $id]);

            if ($results['success'] == true && !empty($results['results']) && $results['results'] != null) {
                return $results['results'];
            }

            return null;

        }

        /**
         * Attempts a login by hashing the password and comparing to stored password
         *
         * @param $email
         * @param $password
         * @return bool
         */
        static function attemptLogin($email, $password) {

            $mysql = new MySQL();
            $results = $mysql->query('SELECT password FROM user WHERE email = :email', [':email' => $email]);

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

            if (!empty($_SESSION['id']) && $_SESSION['id'] != null) {
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

        /**
         * Gets the user id from the session
         *
         * @return mixed
         */
        static function getId() {
            return $_SESSION['id'];
        }

        /**
         * Gets the users id with an email
         *
         * @param $email
         * @return null
         */
        static function getUserId($email) {
            $mysql = new MySQL();
            $results = $mysql->query('SELECT id FROM user WHERE email = :email', [':email' => $email]);

            if ($results['success'] == true && !empty($results['results']) && $results['results'] != null) {
                return $results['results']['id'];
            }

            return null;
        }

    }

?>