<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function slovak()
    {
        \App::setLocale('sk');

        session()->push('lang','sk');

        return redirect()->back();
    }

    public function english()
    {
        \App::setLocale('en');

        session()->push('lang','en');

        return redirect()->back();

    }

}
