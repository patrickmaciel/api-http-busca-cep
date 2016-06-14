<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SinglePageController extends Controller
{
    public function home()
    {
        return view('singlepage.home')
            ->with('title', 'API Http Busca CEP');
    }
}
