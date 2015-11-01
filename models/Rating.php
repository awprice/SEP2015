<?php

/**
 * Class Rating
 */
class Rating {

    /**
     * Get a users rating
     *
     * @param $id
     * @return int
     */
    static function getUserRating($id) {

        $mysql = new MySQL();
        $results = $mysql->query('SELECT AVG(rating) FROM rating WHERE owner = :owner', [
            ':owner' => $id
        ]);

        if ($results['success'] == true && !empty($results['results']) && $results['results'] != null) {
            if ($results['results']['AVG(rating)'] === null) {
                return 0;
            } else {
                return $results['results']['AVG(rating)'];
            }
        }

        return 0;

    }

    /**
     * Get the next rating id
     *
     * @return int|null
     */
    static function getNextId() {

        $mysql = new MySQL();
        $results = $mysql->query('SELECT id FROM rating ORDER BY id DESC', null);

        if ($results['success'] == true) {
            $id = (int) $results['results']['id'];
            $id++;
            return $id;
        }

        return null;

    }

    /**
     * Insert a new rating
     *
     * @param $owner
     * @param $offer
     * @param $advertisement
     * @param $rating
     * @param $comment
     * @return mixed
     */
    static function createRating($owner, $offer, $advertisement, $rating, $comment) {

        $mysql = new MySQL();
        $results = $mysql->query('INSERT INTO rating(id, owner, offer, advertisement, rating, comment, createdby) VALUES (:id, :owner, :offer, :advertisement, :rating, :comment, :createdby)', [
            ':id' => self::getNextId(),
            ':owner' => $owner,
            ':offer' => $offer,
            ':advertisement' => $advertisement,
            ':rating' => $rating,
            ':comment' => $comment,
            ':createdby' => User::getId()
        ]);

        return $results['success'];

    }

    /**
     * Get a specific rating
     *
     * @param $offerId
     * @param $userId
     * @return null
     */
    static function getRating($offerId, $userId) {

        $mysql = new MySQL();
        $results = $mysql->query('SELECT * FROM rating WHERE offer = :offer AND createdby = :createdby', [
            ':offer' => $offerId,
            ':createdby' => $userId,
        ]);

        if ($results['success'] == true && !empty($results['results']) && $results['results'] != null) {
            return $results['results'];
        }

        return null;

    }

    /**
     * Create array of stars for icons
     *
     * @param $rating
     * @return array
     */
    static function getStarsArray($rating) {

        $stars = [];
        for ($x = 1; $x <= $rating; $x++) {
            $stars[] = '1';
        }
        if (count($stars) != 5) {
            $size = count($stars);
            for ($x = 1; $x <= (5 - $size); $x++) {
                $stars[] = '0';
            }
        }

        return $stars;

    }

}