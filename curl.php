<?php
class Curl {
    public $ch;
    public $headers;
    public $cookie;
    public $error;
    public $response;
    function __construct() {
        $this->ch = curl_init();
        $this->headers = array();
        $this->cookie = "";
        $this->error = array("error" => false, "message" => "");
        $this->response = "";
    }

    /**
     * @param string $url
     */
    function get($url) {
        $this->setUrl($url);
        // $this->setOpt(CURLOPT_POST, false);
        $this->response = curl_exec($this->ch);
        $this->error["error"] = !(!curl_error($this->ch));
        $this->error["message"] = curl_error($this->ch);
        curl_close($this->ch);
    }

    /**
     * @param string $url
     * @param array $data
     */
    function post($url, $data=array()) {
        $this->setUrl($url);
        $this->setOpt(CURLOPT_POST, true);
        $this->setOpt(CURLOPT_POSTFIELDS, $data);
        $this->response = curl_exec($this->ch);
        $this->error["error"] = !(!curl_error($this->ch));
        $this->error["message"] = curl_error($this->ch);
        curl_close($this->ch);
    }

    /**
     * @param int $option
     * @param mixed $value
     */
    function setOpt($option, $value) {
        curl_setopt($this->ch, $option, $value);
    }

    /**
     * @param int $time
     */
    function setTimeOut($time) {
        $this->setOpt(CURLOPT_TIMEOUT, $time);
    }

    /**
     * 
     */
    function stopSSL() {
        $this->setOpt(CURLOPT_SSL_VERIFYPEER, false);
        $this->setOpt(CURLOPT_SSL_VERIFYHOST, false);
    }

    /**
     * 
     */
    function startSSL() {
        $this->setOpt(CURLOPT_SSL_VERIFYPEER, true);
        $this->setOpt(CURLOPT_SSL_VERIFYHOST, true);
    }

    /**
     * @param string $url
     */
    function setUrl($url) {
        $this->setOpt(CURLOPT_URL, $url);
    }

    /**
     * @param string $headerName
     * @param string $headerValue
     */
    function addHeader($headerName, $headerValue) {
        array_push($this->headers, "$headerName: $headerValue");
        $this->setHeader();
    }

    /**
     * @param array $headerArray
     */
    function addHeaderArray($headerArray) {
        foreach ($headerArray as $name=>$value) {
            array_push($this->headers, "$name: $value");
            $this->setHeader();
        }
    }

    /**
     * 
     */
    function setHeader() {
        $this->setOpt(CURLOPT_HTTPHEADER, $this->headers);
    }

    /**
     * @param string $cookieName
     * @param string $cookieValue
     */
    function addCookie($cookieName, $cookieValue) {
        $this->cookie += "$cookieName=$cookieValue;";
        $this->setOpt(CURLOPT_COOKIE, $this->cookie);
    }

    /**
     * @param string $proxyIP
     * @param string $proxyPost
     * @param int $proxyType
     * @param string $proxyUserPassword
     * @param bool $proxyAuth
     */
    function setProxy($proxyIP, $proxyPost, $proxyType, $proxyUserPassword=null, $proxyAuth=false) {
        $this->setOpt(CURLOPT_PROXY, $proxyIP);
        $this->setOpt(CURLOPT_PROXYPORT, $proxyPost);
        $this->setOpt(CURLOPT_PROXYTYPE, $proxyType);
        if ($proxyUserPassword !== null) {
            $this->setOpt(CURLOPT_PROXYUSERPWD, $proxyIP);
        }
        if ($proxyAuth !== false) {
            $this->setOpt(CURLOPT_PROXYAUTH, CURLAUTH_BASIC);
        }
    }

    /**
     * @param bool $name
     */
    function setReturnTransfer($value) {
        $this->setOpt(CURLOPT_RETURNTRANSFER, $value);
    }

    /**
     * 
     */
    function close() {
        unset($this->ch);
    }
}
?>