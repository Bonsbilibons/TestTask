<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController
{
    public function mainPage(Request $request)
    {
        return view('main_page');
    }

}
