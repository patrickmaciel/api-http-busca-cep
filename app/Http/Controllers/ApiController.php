<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CorreiosApi;

class ApiController extends Controller
{
    protected $correios;

    public function __construct(CorreiosApi $correios) {
        $this->correios = $correios;
    }
}
