<?php

class BonitaActorMember extends BonitaRestAPI {

    /**
     * Class that handle requests to 'bpm/actorMember' endpoint.
     *
     * @author Bruno E. Fuhr <brunofuhr@gmail.com>
     */
    public function __construct() {
        $this->setEndpoint('bpm/actorMember');
    }

    /**
     * Get members of an actor
     *
     * @param String $actorId
     * @return Object Returns an array of actors members
     */
    public function getMembersByActor($actorId) {
        $this->setFilters(array('actor_id' => $actorId));
        return parent::get();
    }
}
