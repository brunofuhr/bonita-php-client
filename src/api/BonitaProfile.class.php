<?php

class BonitaProfile extends BonitaRestAPI {
    
    /**
     * Class that handle requests to 'portal/profile' endpoint.
     * 
     * @author Bruno E. Fuhr <brunofuhr@gmail.com>
     */
    public function __construct() {
        $this->setEndpoint('portal/profile');
    }
    
}
