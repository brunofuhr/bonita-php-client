<?php

class BonitaActivityVariable extends BonitaRestAPI {

    /**
     * Class that handle requests to 'bpm/activityVariable' endpoint.
     *
     * @author Bruno E. Fuhr <brunofuhr@gmail.com>
     */
    public function __construct() {
        $this->setEndpoint('bpm/activityVariable');
    }

    public function getActivityVariable($activityId, $variableName) {
        return parent::get("{$activityId}/{$variableName}");
    }

}
