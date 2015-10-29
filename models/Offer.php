<?php

class Offer {

    /**
     * Gets the offer for a specific id for the specified user
     *
     * @param $id
     * @param $owner
     * @return null
     */
    static function getOffer($id, $owner) {

        $mysql = new MySQL();
        $results = $mysql->query('SELECT * FROM offer WHERE id = :id and owner = :owner', [':id' => $id, ':owner' => $owner]);

        if ($results['success'] == true && !empty($results['results']) && $results['results'] != null) {
            return $results['results'];
        }

        return null;

    }

    /**
     * Gets all offers for a specific owner
     *
     * @param $owner
     * @return null
     */
    static function getOffersForUser($owner) {

        $mysql = new MySQL();
        $results = $mysql->queryAll('SELECT * FROM offer WHERE owner = :owner', [':owner' => $owner]);

        if ($results['success'] == true && !empty($results['results']) && $results['results'] != null) {
            return $results['results'];
        }

        return null;

    }

    /**
     * Create a new offer, makes sure the user hasn't made an offer for this advertisement before.
     *
     * @param $owner
     * @param $advertisement
     * @param $description
     * @return bool
     */
    static function createOffer($owner, $advertisement, $description) {

        $offers = self::getOffersForUser($owner);

        foreach($offers as $offer) {
            if ($offer['advertisement'] == $advertisement) {
                return false;
            }
        }

        $mysql = new MySQL();
        $results = $mysql->query('INSERT INTO offer(owner, advertisement, description, status) VALUES (:owner, :advertisement, :description, 0)', [':owner' => $owner, ':advertisement' => $advertisement, ':description' => $description]);

        if ($results['success'] == true) {
            return true;
        }

        return false;

    }

}

?>