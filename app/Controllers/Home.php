<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $session = session();
        $data['session'] = $session;
        return view('home', $data);
    }
}
