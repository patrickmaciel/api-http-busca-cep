<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\ApiController;

class CepController extends ApiController
{
    public function buscaEnderecoPorCep($cep)
    {
        $responseCorreios = $this->correios->buscar($cep);
        return response()->json($responseCorreios);
    }

    public function buscaCepPorEndereco($endereco)
    {
        $responseCorreios = $this->correios->buscar($endereco);
        return response()->json($responseCorreios);
    }
}
