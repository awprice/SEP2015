<?php

    class User {

        /**
         * For converting camelcase keys to the keys used in the sql database
         *
         * @var array
         */
        private static $mysql_keys = [
            'name' => 'name',
            'email' => 'email',
            'password' => 'password',
            'contactNo' => 'contactno',
            'aboutMe' => 'aboutme',
            'qualifications' => 'qualifications',
            'website' => 'website'
        ];

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

        /**
         * Set a user's attribute
         *
         * @param $key
         * @param $value
         * @return bool
         */
        static function setAttribute($key, $value) {

            if (array_key_exists($key, self::$mysql_keys)) {

                // Make sure we encrypt the password
                if (self::$mysql_keys[$key] == 'password') {
                    $value = self::hashPassword($value);
                }

                $mysql = new MySQL();
                $results = $mysql->query('UPDATE user SET ' . self::$mysql_keys[$key] . ' = :attribute_value WHERE id = :id',
                    [':attribute_value' => $value, ':id' => self::getId()]);

                // If it worked, return true
                if ($results['success'] == true) {
                    return true;
                }

            }

            return false;

        }

        /**
         * Create a new user
         *
         * @param $details
         * @return bool
         */
        static function createUser($details) {

            // Make sure the email doesn't already exist
            if (self::getUserId($details['email']) != null) {
                Session::setError('Email has already been used before, please use a different one.');
                Session::redirect('/signup');
            }

            $id = self::getNextId();

            if ($details['user-type'] == "employer") {
                $usertype = 1;
            } else {
                $usertype = 0;
            }

            if ($details['password'] == $details['confirm-password']) {
                $password = self::hashPassword($details['password']);
            } else {
                $password = '';
                Session::setError('Passwords do not match, please try again.');
                Session::redirect('/signup');
            }

            $mysql = new MySQL();
            $results = $mysql->query('INSERT INTO user(id, usertype, name, email, password, contactno, aboutme, qualifications, website, companyname, companylocation) VALUES (:id, :usertype, :name, :email, :password, :contactno, :aboutme, :qualifications, :website, :companyname, :companylocation)', [
                ':id' => $id,
                ':usertype' => $usertype,
                ':name' => $details['name'],
                ':email' => $details['email'],
                ':password' => $password,
                ':contactno' => $details['contactno'],
                ':aboutme' => $details['aboutme'],
                ':qualifications' => $details['qualifications'],
                ':website' => $details['website'],
                ':companyname' => $details['companyname'],
                ':companylocation' => $details['companylocation']

            ]);

            return $results['success'];

        }

        /**
         * Get the id for the next inserted user
         *
         * @return null
         */
        static function getNextId() {

            $mysql = new MySQL();
            $results = $mysql->query('SELECT id FROM user ORDER BY id DESC', null);

            if ($results['success'] == true) {
                $id = (int) $results['results']['id'];
                $id++;
                return $id;
            }

            return null;

        }

    }

?>