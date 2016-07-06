<?php

class BonitaRole extends BonitaRestAPI {
    
    /**
     * Class that handle requests to 'identity/role' endpoint.
     * 
     * @author Bruno E. Fuhr <brunofuhr@gmail.com>
     */
    public function __construct() {
        $this->setEndpoint('identity/role');
    }
    
    public function getRole($id) {
        if (strlen($id) == 0) {
            return new Exception('You must inform the role id');
        }
        return parent::get($id);
    }
    
    public function getRolesList() {
        return parent::get();
    }
    
    public function create($name, $displayName, $description) {
        $data = array(
            "icon" => "",
            "name" => "{$name}",
            "displayName" => "{$displayName}",
            "description" => "{$description}"
        );
            return parent::post($data);
    }
    
}
