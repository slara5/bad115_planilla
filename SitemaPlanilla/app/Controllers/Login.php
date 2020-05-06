<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Login extends BaseController
{
    public function index() 
    {
        $data = [
            'url' => base_url()
        ];
        return view('login', $data);
    }

}