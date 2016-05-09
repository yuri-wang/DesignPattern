<?php

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

$Ifalo = new Ifalo();
var_dump($Ifalo->getToken());
var_dump($Ifalo->login());

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

class FacebookAdapter implements IfaloInterface
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

$FB = new Facebook();
$Adapter = new FacebookAdapter($FB);

var_dump($Adapter->getToken());
var_dump($Adapter->login());