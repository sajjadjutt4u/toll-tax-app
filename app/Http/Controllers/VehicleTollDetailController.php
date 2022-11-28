<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateEntryData;
use App\Http\Requests\ValidateExitData;
use App\Services\TollTaxCalculation;

class VehicleTollDetailController extends Controller
{
    private $tollTaxService;

    public function __construct(TollTaxCalculation $tollTaxCalculation)
    {
        $this->tollTaxService = $tollTaxCalculation;
    }

    public function storeEntryData(ValidateEntryData $request){
        $newDetail = $this->tollTaxService->storeEntryData($request->all());
        if($newDetail) $res = array("status" => true, "message" => "Data inserted successfully!");
        else $res = array("status" => false, "message" => "Something went wrong. Please try again!");
        return response()->json($res);
    }

    public function calculateTollTax(ValidateExitData $request){
        $res = $this->tollTaxService->storeExitDataAndCalculateTax($request->all());
        return response()->json($res);
    }
}
