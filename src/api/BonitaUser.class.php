<?php

class BonitaUser extends BonitaRestAPI {

    /**
     * Class that handle requests to 'identity/user' endpoint.
     *
     * @author Bruno E. Fuhr <brunofuhr@gmail.com>
     */
    public function __construct() {
        $this->setEndpoint('identity/user');
    }

    public function get($id) {
        if ( is_null($id) ) {
            throw new Exception('You must inform the id of the user.');
        }
        return parent::get($id);
    }

    /**
     * Returns a list with the Bonita BPM users
     *
     * @return Array List of users
     */
    public function getUsersList() {
        return parent::get();
    }

    /**
     * Get a user by his username
     *
     * @param String $userName Username of the user
     * @return Object Returns the user object if exists
     */
    public function getByUserName($userName) {
        $this->setFilters(array('userName' => $userName));
        $user = parent::get();

        if (!is_object($user[0])) {
            return false;
        }

        return $user[0];
    }

    public function create($userName, $password, $firstName, $lastName = '', $managerId = NULL) {
        $data = array(
            "userName" => "{$userName}",
            "password" => "{$password}",
            "password_confirm" => "{$password}",
            "icon" => "",
            "firstname" => "{$firstName}",
            "lastname" => "{$lastName}",
            "title" => "",
            "job_title" => "",
            "manager_id" => "{$managerId}",
            "enabled" => "true"
        );
        return parent::post($data);
    }
    
    public function update($id, $userName, $password, $firstName, $lastName, $managerId = NULL) {
        $data = array(
            "userName" => "{$userName}",
            "password" => "{$password}",
            "password_confirm" => "{$password}",
            "icon" => "",
            "firstname" => "{$firstName}",
            "lastname" => "{$lastName}",
            "title" => "",
            "job_title" => "",
            "manager_id" => "{$managerId}",
            "enabled" => "true"
        );
        return parent::put($id, $data);
    }

    public function delete($id) {
        $user = $this->get($id);
        if (is_null($user)) {
            return new Exception("The user {$id} does not exists");
        }

        try {
            $delete = parent::delete($id);
            return TRUE;
        } catch (Exception $e) {
            return $e;
        }
    }
    
    public function disableUser($id) {
        $data = array("enabled" => "false");
        return parent::put($id, $data);        
    }
}
