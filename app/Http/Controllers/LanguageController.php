<?php

namespace App\Http\Controllers;

use App;

class LanguageController extends Controller
{
    public function language($locale) {
        session()->put('locale',$locale);
        return redirect()->back();
    }
}
