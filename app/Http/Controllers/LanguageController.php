<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function slovak()
    {
        \App::setLocale('sk');

        return redirect()->back();
    }

    public function english()
    {
        \App::setLocale('en');

        return redirect()->back();
    }

}
