<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait FileJsonTrait
{

    public function getData($nameFile)
    {
        if ($this->verifyIfFileExists($nameFile))
            return json_decode(Storage::disk('simulation')->get($nameFile), true);
        else
            return response()->json(['msg' => 'Arquivo não encontrado'], 404);
    }

    public function verifyIfFileExists($nameFile)
    {
        if (Storage::disk('simulation')->exists($nameFile))
            return true;
        else
            return false;
    }

    public function getResponseSimulation($request)
    {
        $rate_institutions = $this->getData('taxas_instituicoes.json');
        $keys = $this->getKeyResponse($rate_institutions);
        return $this->getbodyResponse($keys, $rate_institutions, $request);
    }

    protected function getKeyResponse($rate_institutions)
    {
        $dataKeys = array_unique(array_column($rate_institutions, 'instituicao'));
        $keys = [];

        foreach ($dataKeys as $key => $dataKey) {
            array_push($keys, $dataKey);
        }

        return $keys;
    }

    protected function getbodyResponse($keys, $rate_institutions, $request)
    {
        $response = [];
        foreach ($keys as $key_k => $value_key) {

            foreach ($rate_institutions as $key => $value) {

                if ($value_key == $value['instituicao'])
                    $calc = [
                        "taxa" => $value['taxaJuros'],
                        "parcelas" => $value['parcelas'],
                        "valor_parcela" => (float) number_format($value['coeficiente'] * $request->input('valor_emprestimo'), 2, '.', ''),
                        "convenio" => $value['convenio']
                    ];
                $response[$value_key][] = $calc;
            }
        }
        return $response;
    }
}
