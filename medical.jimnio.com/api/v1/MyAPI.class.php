<?php
require_once 'API.class.php';
class MyAPI extends API
{
    protected $User;

    public function __construct($request, $origin) {
        parent::__construct($request);
        $deny = array("127.0.0.1","Add more here");
        if (!in_array ($_SERVER['REMOTE_ADDR'], $deny)) {
            throw new Exception("Illegal Not In Network, Join Jimnio API visit medeasybilling.com");
        }
        // Abstracted out for example
        $APIKey = '235523234234';
        //$APIKey = new Models\APIKey();
        $gatekeeper = 'DSfer4fSRRGe5g5evdg';
        //$User = new Models\User();
        $User = 'Intrust';
        if (!array_key_exists('apiKey', $this->request)) {
            throw new Exception('No API Key provided');
        } else if ($this->request['apiKey'] != $APIKey) {
            throw new Exception('Invalid API Key');
        } else if (!array_key_exists('username', $this->request)) {
            throw new Exception('No username provided');
        } else if (!array_key_exists('password', $this->request)) {
            throw new Exception('No password provided');
        } else if ($this->request['gatekeeper'] != $gatekeeper) {
            throw new Exception('Invalid User Gate Keeper Invalid, Cease This Atrocity!');
        }

    }
    /**
      * *INTRUST ENDPOINTS
      */
     protected function instamed() {
        if ($this->method == 'GET') {
            header("Access-Control-Allow-Origin: ".$this->request['return_url']);
            $username = $this->request['username'];
            $password = $this->request['password'];
            $url = 'https://connect.instamed.com/healthcare/service.asmx/DoEligibilityInquiryEDI?requestEDI='.urlencode ($this->request['requestEDI']);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            $additionalHeaders = array('requestEDI'=>'');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
            $result = curl_exec($ch);
            if ($result){
                return $result;
            }
            curl_close($ch);
        } else {
            return "Only accepts GET requests";
        }
     }
 }
 ?>