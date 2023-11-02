<?php
require_once('model/Model.php');
class Controller
{
    private $model;
    public function Home()
    {
        require('view/home.php');
    }
    public function Login()
    {
        require('view/login.php');
    }
    public function Profile()
    {
        require('view/profile.php');
    }
    
    public function Register()
    {
        require('view/register.php');
    }
    public function Logout()
    {
    }
}
