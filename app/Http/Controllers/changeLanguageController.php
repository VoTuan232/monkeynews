<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class changeLanguageController extends Controller
{
    public function changeLanguage($language)
	{
	    \Session::put('lang', $language);

	    return redirect()->back();
	}

}
