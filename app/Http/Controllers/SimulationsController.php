<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\FileJsonTrait;
use App\Http\Requests\ValidateRequest;

class SimulationsController extends Controller
{
    use FileJsonTrait;

    public function getInstitutions()
    {
        return $this->getData('instituicoes.json');
    }

    public function getConvenants()
    {
        return $this->getData('convenios.json');
    }

    public function SimulationCredit(ValidateRequest $request)
    {
        $rate_institutions = $this->getData('taxas_instituicoes.json');

        $dataKeys = array_unique(array_column($rate_institutions, 'instituicao'));
        $keys = [];

        foreach ($dataKeys as $key => $dataKey) {
            array_push($keys, $dataKey);
        }

        $response = [];
        foreach ($keys as $key_k => $value_key) {

            foreach ($rate_institutions as $key => $value) {

                if ($value_key == $value['instituicao'])
                    $response[$value_key][] = $value;
            }
        }

        return response()->json($response, 200);
    }
}
