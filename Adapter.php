<?php

interface IfaloInterface
{
    public function getToken();
    public function login();
}

class Ifalo implements IfaloInterface
{
    public function getToken()
    {
        return md5(uniqid(rand()));
    }

    public function login()
    {
        return 'Ifalo 登入成功';
    }
}

$ifalo = new Ifalo();
var_dump($ifalo->getToken());
var_dump($ifalo->login());

interface FaceBookInterface
{
    public function getAccessToken();
    public function userLogin();
}

class Facebook implements FaceBookInterface
{
    public function getAccessToken()
    {
        return md5(uniqid(rand()));
    }

    public function userLogin()
    {
        return 'FB 登入成功';
    }
}

class FacebookAdapter implements IfaloInterface
{
    private $facebook;

    public function __construct(Facebook $facebook)
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

$fb = new Facebook();
$adapter = new FacebookAdapter($fb);

var_dump($adapter->getToken());
var_dump($adapter->login());
