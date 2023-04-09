# PHP Easy Curl Class
## 使用説明
### 1.在PHP文件中導入包含Curl類的PHP文件
### 2.請按照規範使用Curl類
## 函數
### get
```php
$curl->get("https://www.example.com/"); // 導入URL
$response = $curl->response;
if ($curl->error) {
    echo "Error: " . $curl->errormessage;
} else {
    echo $response;
}
```

### post
```php
$data = array(
    "data_tmp1" => "hello",
    "data_tmp2" => "world"
);
$curl->post("https://www.example.com/", $data); // 導入URL, data
$response = $curl->response;
if ($curl->error) {
    echo "Error: " . $curl->errormessage;
} else {
    echo $response;
}
```

### put
```php
$data = array(
    "data_tmp1" => "hello",
    "data_tmp2" => "world"
);
$curl->put("https://www.example.com/", $data); // 導入URL, data
$response = $curl->response;
if ($curl->error) {
    echo "Error: " . $curl->errormessage;
} else {
    echo $response;
}
```

### patch
```php
$data = array(
    "data_tmp1" => "hello",
    "data_tmp2" => "world"
);
$curl->put("https://www.example.com/", $data); // 導入URL, data
$response = $curl->response;
if ($curl->error) {
    echo "Error: " . $curl->errormessage;
} else {
    echo $response;
}
```

### delete
```php
$data = array(
    "data_tmp1" => "hello",
    "data_tmp2" => "world"
);
$curl->delete("https://www.example.com/", $data); // 導入URL, data
$response = $curl->response;
if ($curl->error) {
    echo "Error: " . $curl->errormessage;
} else {
    echo $response;
}
```

### setOpt
``` php
$curl->setOpt(CURLOPT_ENCODING, ""); // 導入option, value
$curl->get("https://www.example.com/");
```

### setFollowLocation
``` php
$curl->setFollowLocation(true / false); // true為遵循服务器作为3xx响应中HTTP标头的一部分发送的任何Location, false反之
$curl->get("https://www.example.com/");
```

### setBasicAuthentication
``` php
$curl->setBasicAuthentication("TestUserName", "TestPassword") // 導入用戶名, 用戶密碼
$curl->get("https://www.example.com/");
```

### setTimeOut
``` php
$curl->setTimeOut(10); // 導入請求頁面超時時間(s)
$curl->get("https://www.example.com/");
```

### stopSSL
``` php
$curl->stopSSL(); // 停止使用SSL, 停止使用(CURLOPT_SSL_VERIFYPEER, CURLOPT_SSL_VERIFYHOST)
$curl->get("https://www.example.com/");
```

### startSSL
``` php
$curl->startSSL(); // 使用SSL, 使用(CURLOPT_SSL_VERIFYPEER, CURLOPT_SSL_VERIFYHOST)
$curl->get("https://www.example.com/");
```

### addHeader
``` php
$curl->addHeader("user-agent", "Edge"); // 導入請求頭名稱, 請求頭值 (添加Header到現有的請求頭中)
$curl->get("https://www.example.com/");
```

### addHeaderArray
``` php
$headers = array(
    "test1" => "1",
    "test2" => "2"
);
$curl->addHeaderArray($headers); // 導入請求頭Array (鍵: 請求頭名稱, 值: 請求頭值) (添加Header到現有的請求頭中)
$curl->get("https://www.example.com/");
```

### setUserAgent
``` php
$curl->setUserAgent("Edge"); // 導入User-Agent值
$curl->get("https://www.example.com/");
```

### addCookie
``` php
$curl->addCookie("testCookieName", "testCookieValue") ; // 導入Cookie名稱, Cookie值 (添加Cookie到現有的Cookie中)
$curl->get("https://www.example.com/");
```

### addCookieString
``` php
$curl->addCookieString("test1CookieName=test1CookieValue;test2CookieName=test2CookieValue") ; // 導入Cookie (添加Cookie到現有的Cookie中)
$curl->get("https://www.example.com/");
```

### addCookieArray
``` php
$cookie = array(
    "test1CookieName" => "test1CookieValue",
    "test2CookieName" => "test2CookieValue"
);
$curl->addCookieArray($cookie) ;  // 導入Cookie Array (鍵: Cooike名稱, 值: Cookie值) (添加Cookie到現有的Cookie中)
$curl->get("https://www.example.com/");
```

### getUrlCookie
``` php
$cookie = $curl->getUrlCookie("https://www.example.com/"); // 導入要獲取Cookie的網站
```

### setProxy
``` php
$curl->setProxy("127.0.0.1", "7890", CURLPROXY_HTTP, "user:password", true); // 導入代理網址, 代理端口, 代理類型, 代理用戶名與密碼(username:password), 是否啓用代理後面的資源的驗證方法(CURLAUTH_BASIC)->(true啓用 false禁用)
$curl->get("https://www.example.com/");
```

### setReturnTransfer
``` php
$curl->setReturnTransfer(true / false); // true為不把獲取内容輸出頁面轉為文件流輸出, false反之
$curl->get("https://www.example.com/");
```

### close
``` php
$curl->close(); // 刪除$curl->ch
```

## 反饋
### 如果有BUG可以反饋給我 (hhrh1123@outlook.com)
### 電子郵件格式如下
### Title
#### PHP Easy Curl Class問題反饋
### Body
#### 問題如下:
#### - { 報錯信息 }
#### - { 如何使用Curl類得到報錯信息 }
