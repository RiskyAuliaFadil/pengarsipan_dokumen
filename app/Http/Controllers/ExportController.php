<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function export(){
        
        $provinsiId = request('tableFilters.provinsi_id.value');

        return "Hello Export Provinsi : $provinsiId ";
    }
}
