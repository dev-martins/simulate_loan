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
    
}
