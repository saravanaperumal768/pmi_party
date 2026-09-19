<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function change(Request $request, $lang)
    {
        if (!in_array($lang, ['en', 'ta'])) {
            $lang = 'en';
        }

        session()->put('locale', $lang);

        App::setLocale($lang);

        return redirect()->back();
    }
}
