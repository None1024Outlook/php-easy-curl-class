<?php
class Curl {
    public $ch;
    public $headers = array();
    public $cookie = "";
    public $error = false;
    public $errormessage = "";
    public $response = "";
    public $httpcode = 0;
    function __construct() {
        $this->ch = curl_init();
    }

    /**
     * @param string $url
     */
    function get($url) {
        $this->setUrl($url);
        // $this->setOpt(CURLOPT_POST, false);
        $this->response = curl_exec($this->ch);
        $this->getResInfo();
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
        $this->getResInfo();
        curl_close($this->ch);
    }

    /**
     * @param string $url
     * @param array $data
     */
    function put($url, $data=array()) {
        $this->setUrl($url);
        $this->setOpt(CURLOPT_CUSTOMREQUEST, "put");
        $this->setOpt(CURLOPT_POSTFIELDS, $data);
        $this->response = curl_exec($this->ch);
        $this->getResInfo();
        curl_close($this->ch);
    }

    /**
     * @param string $url
     * @param array $data
     */
    function patch($url, $data=array()) {
        $this->setUrl($url);
        $this->setOpt(CURLOPT_CUSTOMREQUEST, "patch");
        $this->setOpt(CURLOPT_POSTFIELDS, $data);
        $this->response = curl_exec($this->ch);
        $this->getResInfo();
        curl_close($this->ch);
    }

    /**
     * @param string $url
     * @param array $data
     */
    function delete($url, $data=array()) {
        $this->setUrl($url);
        $this->setOpt(CURLOPT_CUSTOMREQUEST, "delete");
        $this->setOpt(CURLOPT_POSTFIELDS, $data);
        $this->response = curl_exec($this->ch);
        $this->getResInfo();
        curl_close($this->ch);
    }

    function getError() {
        $this->error = !(!curl_error($this->ch));
        $this->errormessage = curl_error($this->ch);
    }

    function getHttpCode() {
        $this->httpcode = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
    }

    function getResInfo() {
        $this->getError();
        $this->getHttpCode();
    }

    /**
     * @param int $option
     * @param mixed $value
     */
    function setOpt($option, $value) {
        curl_setopt($this->ch, $option, $value);
    }

    /**
     * @param bool $value
     */
    function setFollowLocation($value) {
        $this->setOpt(CURLOPT_FOLLOWLOCATION, $value);
    }

    /**
     * @param string $httpUserName
     * @param string $httpPassword
     */
    function setBasicAuthentication($httpUserName, $httpPassword) {
        $this->setOpt(CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        $this->setOpt(CURLOPT_USERPWD, "$httpUserName:$httpPassword");
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
     * @param string $UserAgent
     */
    function setUserAgent($UserAgent) {
        $this->addHeader("user-agent", $UserAgent);
    }

    /**
     * @param array $headerArray
     */
    function addHeaderArray($headerArray) {
        foreach ($headerArray as $name=>$value) {
            $this->addHeader($name, $value);
        }
    }

    /**
     * 
     */
    function setHeader() {
        $this->setOpt(CURLOPT_HTTPHEADER, $this->headers);
    }

    function setCookie() {
        $this->setOpt(CURLOPT_COOKIE, $this->cookie);
    }

    /**
     * @param string $cookieName
     * @param string $cookieValue
     */
    function addCookie($cookieName, $cookieValue) {
        $this->cookie = intval($this->cookie) . "$cookieName=$cookieValue";
        $this->setCookie();
    }

    /**
     * @param string $cookieString
     */
    function addCookieString($cookieString) {
        $this->cookie = intval($this->cookie) . $cookieString;
        $this->setCookie();
    }

    /**
     * @param array $cookieArray
     */
    function addCookieArray($cookieArray) {
        foreach ($cookieArray as $name=>$value) {
            $this->addCookie($name, $value);
        }
    }

    /**
     * @param string $url
     */
    function getUrlCookie($url) {
        $tmpCurl = new Curl();
        $tmpCurl->setOpt(CURLOPT_RETURNTRANSFER, true);
        $tmpCurl-> setOpt(CURLOPT_HEADER, true);
        $tmpCurl->get($url);
        preg_match_all('/^Set-Cookie: (.*?);/m', $tmpCurl->response,$tmp);
        $tmpCookie = $tmp[1][0].';'.$tmp[1][1];
        unset($tmpCurl);
        return $tmpCookie;
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
