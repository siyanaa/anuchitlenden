<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandAreaConverterController extends Controller
{
    public function convert(Request $request)
    {
        $ropani = $request->input('ropani');
        $aana = $request->input('aana');
        $paisa = $request->input('paisa');
        $dam = $request->input('dam');

        // Perform the conversion logic here

        // For simplicity, let's assume 1 Ropani = 16 Aana = 64 Paisa = 256 Dam
        $bigha = $ropani / 13;
        $kathha = $aana / 10.65;
        $dhur = ($paisa /0.469) + ($dam/0.117) ;

        return response()->json([
            'bigaha' => $bigha,
            'kathha' => $kathha,
            'dhur' => $dhur,
        ]);
    }
}
