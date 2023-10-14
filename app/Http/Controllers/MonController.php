<?php

namespace App\Http\Controllers;

use App\Models\MonModel;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PhpParser\Node\Stmt\Echo_;

class MonController extends Controller
{
    public function montrer(Request $request){
        $dataBase = MonModel::select('JM_Date', 'JO_Num', 'CT_Num', 'EC_RefPiece', 'EC_Intitule', 'CG_Num', 'EC_Echeance', 'EC_Sens', 'EC_Montant', 'EC_Lettrage')
            ->whereYear('JM_Date','2022')
            ->whereYear('EC_Echeance','2022')
            ->where('CG_Num', '=', '411000')
            // ->where('EC_Lettrage', '=', '')
            ->get();
            return view('juste',compact('dataBase'));


}


    public function faux(Request $request){
        $data = MonModel::select('CT_Num', 'EC_Intitule', 'EC_Sens', 'EC_Montant')
        ->whereYear('JM_Date', '2022')
        ->whereYear('EC_Echeance', '2022')
        ->where('CG_Num', '=', '411000')
        ->get();
        return view('faux',compact('data'));
    }

    
    

    public function details($CT_Num){
        $show = MonModel::select('JM_Date', 'JO_Num', 'CT_Num', 'EC_RefPiece', 'EC_Intitule', 'CG_Num', 'EC_Echeance', 'EC_Sens', 'EC_Montant', 'EC_Lettrage')
        ->whereYear('JM_Date','2022')
        ->whereYear('EC_Echeance','2022')
        ->where('CG_Num', '=', '411000')
        ->where('CT_Num', '=', $CT_Num)
        ->get();
        return view('details', compact('show'));
    }

}

