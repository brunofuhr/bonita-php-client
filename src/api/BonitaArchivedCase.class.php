<?php

class BonitaArchivedCase extends BonitaRestAPI {

    /**
     * Class that handle requests to 'bpm/archivedCase' endpoint.
     *
     * @author Bruno E. Fuhr <brunofuhr@gmail.com>
     */
    public function __construct() {
        $this->setEndpoint('bpm/archivedCase');
    }

    public function get($id) {
        if ( is_null($id) ) {
            throw new Exception('You must inform the id of the case.');
        }
        
        $case = NULL;
        foreach ( $this->getArchivedCasesList() as $archivedCase ) {
            if ( $archivedCase->rootCaseId == $id ) {
                $case = $archivedCase;
            }
        }
        
        return $case;
    }
    
    public function getArchivedCasesList() {
        return parent::get();
    }

}

