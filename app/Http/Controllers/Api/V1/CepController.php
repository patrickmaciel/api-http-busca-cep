<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use GuzzleHttp;
use DOMDocument;
use App\Http\Requests;
use App\Http\Controllers\ApiController;

class CepController extends ApiController
{
    public function buscaEnderecoPorCep($cep)
    {
        $client = new GuzzleHttp\Client();
        $response = $client->request('POST', 'http://www.buscacep.correios.com.br/sistemas/buscacep/resultadoBuscaCepEndereco.cfm', [
                'form_params' => [
                    'relaxation' => $cep
                ]
        ]);
        // var_dump($response);
        $body = $response->getBody(true);
        // var_dump($body);
        // $file = fopen("cep.html", "w+");
        // fwrite($file, $body);

        libxml_use_internal_errors(true);
        $dom = new DOMDocument;
        $dom->preserveWhiteSpace = false;
        // $dom->loadHTMLFile('cep.html');
        $dom->loadHTML($body);
        $rows = $dom->getElementsByTagName('tr');

        if ($rows->length <= 1) {
            return response()->json([
                'error' => true,
                'message' => 'Nenhum endereço encontrado para o CEP informado'
            ]);
        }

        $header = [];
        foreach ($rows as $row) {
            $tds = $row->childNodes;
            foreach ($tds as $index => $td) {
                if ($index % 2 != 0) {
                    continue;
                }
                $header[$index] = preg_replace('/:/', '', $td->nodeValue);
            }
            break;
        }

        $addresses = [];
        foreach ($rows as $index => $row) {
            if ($index == 0) {
                continue;
            }

            $tds = $row->childNodes;
            $address = [];
            foreach ($tds as $tdIndex => $td) {
                if ($tdIndex % 2 != 0) {
                    continue;
                }
                $address[$header[$tdIndex]] = $td->nodeValue;
            }
            array_push($addresses, $address);
        }

        return response()->json([
            'error' => false,
            'addresses' => $addresses
        ]);

    }
}
