Adapter Pattern
===

Story
-------
Ifalo 是一間購物網，有自己登入的入口，供會員登入
```php
interface IfaloInterface
{
    public function getToken();
    public function login();
}

class Ifalo implements IfaloInterface {
    public function getToken() {
        return md5(uniqid(rand()));
    }

    public function login() {
        return 'Ifalo 登入成功';
    }
}
```
但購物網為了擴大經營，並且方便客人快速登入，行銷提供文件請工程師介接Facebook API
```php
interface FaceBookInterface
{
    public function getAccessToken();
    public function userLogin();
}

class Facebook implements FaceBookInterface {

    public function getAccessToken() {
        return md5(uniqid(rand()));
    }

    public function userLogin() {
        return 'FB 登入成功';
    }
}
```
問題來了，FB的API與原本Ifalo的方法不一樣，但我們又不想改到原本的程式，於是寫了一個轉接器
```php
class LoginAdapter implements IfaloInterface
{
    private $facebook;

    public function __construct(FaceBook $facebook)
    {
        $this->facebook = $facebook;
    }

    public function getToken()
    {
        return $this->facebook->getAccessToken();
    }

    public function login()
    {
        return $this->facebook->userLogin();
    }
}
```
Client 執行一下
```php
// Ifalo 登入
$Ifalo = new Ifalo();
var_dump($Ifalo->getToken());
var_dump($Ifalo->login());

// FB 登入
$FB = new Facebook();
$Adapter = new LoginAdapter($FB);
var_dump($Adapter->getToken());
var_dump($Adapter->login());
```

