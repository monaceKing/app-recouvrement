<?php

namespace App\Http\Controllers;

use App\Models\MonModel;
use App\Models\ModelCompteT;
use App\Models\ModelCollaborateurs;
use Illuminate\Http\Request;


class MonController extends Controller
{
    public function montrer(Request $request){
        $dataBase = MonModel::select('JM_Date', 'JO_Num', 'CT_Num', 'EC_RefPiece', 'EC_Intitule', 'CG_Num', 'EC_Echeance', 'EC_Sens', 'EC_Montant', 'EC_Lettrage')
            // ->whereYear('JM_Date','2022')
            // ->whereYear('EC_Echeance','2022')
            // ->where('CG_Num', '=', '411000')
            // ->where('EC_Lettrage', '=', '')
            ->get();
            return view('juste',compact('dataBase'));


}


    public function faux(Request $request){
        // $data = MonModel::select('CT_Num', 'EC_Intitule', 'EC_Sens', 'EC_Montant','EC_Echeance')
        // ->whereNotNull('CT_Num')
        // ->whereYear('EC_Echeance','2023')
        // ->get();
        // return view('faux',compact('data'));

        $data = ModelCompteT ::join('F_ECRITUREC', 'F_COMPTET.CT_Num', '=', 'F_ECRITUREC.CT_Num')
        ->join('F_COLLABORATEUR', 'F_COMPTET.CO_No', '=', 'F_COLLABORATEUR.CO_No')
        ->select('F_COMPTET.CO_No','F_COLLABORATEUR.CO_Nom', 'F_ECRITUREC.CT_Num', 'F_ECRITUREC.EC_Intitule', 'F_ECRITUREC.EC_sens', 'F_ECRITUREC.Ec_Montant', 'F_ECRITUREC.EC_Echeance')
        ->where('F_ECRITUREC.CT_Num', 'like', 'CL%')
        ->orderBy('F_ECRITUREC.CT_Num')
        ->whereYear('EC_Echeance','2023')
        ->get();

        return view('faux',compact('data'));
    }

    
    

    public function details($CT_Num){
        $show = MonModel::select('JM_Date', 'JO_Num', 'CT_Num', 'EC_RefPiece', 'EC_Intitule', 'CG_Num', 'EC_Echeance', 'EC_Sens', 'EC_Montant', 'EC_Lettrage')
        ->where('CT_Num','=', $CT_Num)
        ->whereYear('EC_Echeance','2023')
        ->get();
        return view('details', compact('show'));
    }




    
    public function fusion()
    {
        $data = ModelCompteT ::join('F_ECRITUREC', 'F_COMPTET.CT_Num', '=', 'F_ECRITUREC.CT_Num')
        ->join('F_COLLABORATEUR', 'F_COMPTET.CO_No', '=', 'F_COLLABORATEUR.CO_No')
        ->select('F_COMPTET.CO_No','F_COLLABORATEUR.CO_Nom', 'F_ECRITUREC.CT_Num', 'F_ECRITUREC.EC_Intitule', 'F_ECRITUREC.EC_sens', 'F_ECRITUREC.Ec_Montant', 'F_ECRITUREC.EC_Echeance')
        ->where('F_ECRITUREC.CT_Num', 'like', 'CL%')
        ->orderBy('F_ECRITUREC.CT_Num')
        ->whereYear('EC_Echeance','2023')
        ->get();
       
        return view('jointure',compact('data'));
    }

}







