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
        $response = $this->getResponseSimulation($request);
        return response()->json($response, 200);
    }
}
