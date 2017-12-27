<?php

class BonitaActivity extends BonitaRestAPI {

    /**
     * Class that handle requests to 'bpm/activity' endpoint.
     *
     * @author Bruno E. Fuhr <brunofuhr@gmail.com>
     */
    public function __construct() {
        $this->setEndpoint('bpm/activity');
    }

    public function getActivity($id) {
        if ( is_null($id) ) {
            return new Exception('You must inform the id of the activity.');
        }

        $activity = parent::get($id);
        return strlen($activity->id) > 0 ? $activity : NULL;
    }

    public function getProcessActivities($processId) {
        $this->setFilters(array('processId' => $processId));
        return parent::get();
    }

    public function getCaseActivities($caseId) {
        $this->setFilters(array('caseId' => $caseId));
        return parent::get();
    }

}
