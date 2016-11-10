<?php

class BonitaProxy {

    /**
     * @var String URL where Bonita BPM is running
     */
    private $bonitaURL;

    /**
     * @var String Username of a administrator user to connect with Bonita BPM and do requisitions
     */
    private $bonitaUserName;

    /**
     * @var String Password of the administrator user
     */
    private $bonitaPassword;

    /**
     *
     * @param String $url
     * @param String $userName
     * @param String $password
     */
    public function __construct($url, $userName, $password) {
        $this->setBonitaURL($url);
        $this->setBonitaUserName($userName);
        $this->setBonitaPassword($password);
    }

    private function commonAuthenticate($curlHandler) {
        // User with administrator profile
        $data = array('username' => $this->getBonitaUserName(), 'password' => $this->getBonitaPassword());
        $dataCURL = $this->prepareCURLFieldString($data);
        curl_setopt($curlHandler, CURLOPT_URL, "{$this->bonitaURL}/loginservice");
        curl_setopt($curlHandler, CURLOPT_POST, $dataCURL['count']);
        curl_setopt($curlHandler, CURLOPT_POSTFIELDS, $dataCURL['urlifyedstring']);
        curl_setopt($curlHandler, CURLOPT_COOKIEJAR, 'cookie.txt');
        curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);
        $auth = curl_exec($curlHandler);

        return $auth;
    }

    public function executeCURLGETaction($routeCURL) {
        $curlHandler = curl_init();
        $this->commonAuthenticate($curlHandler);
        curl_setopt($curlHandler, CURLOPT_URL, $routeCURL);
        curl_setopt($curlHandler, CURLOPT_POST, 0);
        $content = curl_exec($curlHandler);
        curl_close($curlHandler);
        return $content;
    }

    public function executeCURLPOSTaction($routeCURL, $post_array, $login = true) {
        $curlHandler = curl_init($routeCURL);

        if ($login) {
            $this->commonAuthenticate($curlHandler);
        }

        $data = json_encode($post_array);

        curl_setopt($curlHandler, CURLOPT_URL, $routeCURL);
        curl_setopt($curlHandler, CURLOPT_POST, true);
        curl_setopt($curlHandler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curlHandler, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandler, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
        );
        $response = curl_exec($curlHandler);

        curl_close($curlHandler);
        return $response;
    }

    public function executeCURLPUTaction($routeCURL, $post_array, $login = true) {
        $curlHandler = curl_init($routeCURL);

        if ($login) {
            $this->commonAuthenticate($curlHandler);
        }

        $data = json_encode($post_array);

        curl_setopt($curlHandler, CURLOPT_URL, $routeCURL);
        curl_setopt($curlHandler, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curlHandler, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandler, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
        );
        $response = curl_exec($curlHandler);

        curl_close($curlHandler);
        return $response;
    }

    public function executeCURLDELETEaction($routeCURL, $post_array, $login = true) {
        $curlHandler = curl_init($routeCURL);

        if ($login) {
            $this->commonAuthenticate($curlHandler);
        }

        $data = json_encode($post_array);

        curl_setopt($curlHandler, CURLOPT_URL, $routeCURL);
        curl_setopt($curlHandler, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($curlHandler, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandler, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
        );
        $response = curl_exec($curlHandler);

        curl_close($curlHandler);
        return $response;
    }

    protected function prepareCURLFieldString($fields) {
        $urlifyedFields = "";
        $dataFieldsForCURL = array();

        foreach ($fields as $key => $value) {
            $urlifyedFields.=$key . '=' . urlencode($value) . '&';
        }
        $urlifyedFields = substr($urlifyedFields, 0, strlen($urlifyedFields) - 1);

        $dataFieldsForCURL['count'] = count($fields);
        $dataFieldsForCURL['urlifyedstring'] = $urlifyedFields;

        return $dataFieldsForCURL;
    }

    function getBonitaUserName() {
        return $this->bonitaUserName;
    }

    function getBonitaPassword() {
        return $this->bonitaPassword;
    }

    function setBonitaUserName($bonitaUserName) {
        $this->bonitaUserName = $bonitaUserName;
    }

    function setBonitaPassword($bonitaPassword) {
        $this->bonitaPassword = $bonitaPassword;
    }

    function getBonitaURL() {
        return $this->bonitaURL;
    }

    function setBonitaURL($bonitaURL) {
        $this->bonitaURL = $bonitaURL;
    }

}
