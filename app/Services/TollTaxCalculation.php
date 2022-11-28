<?php

namespace App\Services;

use App\Models\VehicleTollDetail;
use Carbon\Carbon;

class TollTaxCalculation
{
    private $vehicleTollDetailModel;
    private $PERKMCHARGES = 0.2; //20% charges
    private $TAXBASERATE = 20;
    private $INTERCHANGESGAP = [
        "Zero Point"=> 0,
        "NS Interchange"=> 5,
        "Ph4 Interchange"=> 10,
        "Ferozpur Interchange"=> 17,
        "Lake City Interchange"=> 24,
        "Raiwand Interchange"=> 29,
        "Bahria Interchange"=> 34
    ];

    private $WEEKDAYS = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

    public function __construct(VehicleTollDetail $vehicleTollDetail)
    {
        $this->vehicleTollDetailModel = $vehicleTollDetail;
    }

    public function storeEntryData($entry_data){
        return $this->vehicleTollDetailModel->create($entry_data);
    }

    public function storeExitDataAndCalculateTax($exit_data){
        $record = $this->vehicleTollDetailModel->where('number_plate',$exit_data['number_plate'])->whereNull('exit_date_time')->latest()->first();
        if($record){
            $record->exit_interchange = $exit_data['exit_interchange'];
            $record->exit_date_time = $exit_data['exit_date_time'];
            if ($record->save()) $res = array("status" => true, "tax_details" => $this->calculateTax($record));
            else $res = array("status" => false, "error_message" => "Couldn't update!");
        }
        else $res = array("status" => false, "error_message" => "Couldn't find!");
        return $res;
    }

    private function getDistanceCharges($vehicle){
        $distanceCharges = (float)(
            $this->PERKMCHARGES * ($this->INTERCHANGESGAP[$vehicle->exit_interchange] - $this->INTERCHANGESGAP[$vehicle->entry_interchange])
        );

        $currentDay = $this->WEEKDAYS[Carbon::parse($vehicle->exit_date_time)->dayOfWeek];
        if (in_array( $currentDay, ["Saturday", "Sunday"])) {
            return 1.5 * $distanceCharges;
        }
        return $distanceCharges;
    }

    private function getDiscount($vehicle){
        $specialDay = Carbon::parse($vehicle->exit_date_time)->format('d F');
        $currentDay = $this->WEEKDAYS[Carbon::parse($vehicle->exit_date_time)->dayOfWeek];
        $vehicleDigitNum = explode("-", $vehicle->number_plate)[1];

        if (in_array($specialDay, ["23 March", "14 August", "25 December"])) {
            return 0.5; //50% discount
        }

        if (
            (in_array($currentDay, ["Monday", "Wednesday"]) && $vehicleDigitNum % 2 === 0)
            || (in_array($currentDay, ["Tuesday", "Thursday"]) && $vehicleDigitNum % 2 !== 0)
        ) {
            return 0.1; //10% discount
        }

        return 0; //no discount
    }

    private function calculateTax($vehicle_details){
    $base_rate = $this->TAXBASERATE;
    $distance_cost = $this->getDistanceCharges($vehicle_details);
    $subtotal = (float)($distance_cost + $base_rate);
    $discount = $this->getDiscount($vehicle_details) * $subtotal;
    $total_tax = $subtotal - $discount;

    $tax_details = [
        "base_rate" => $base_rate,
        "distance_cost" => $distance_cost,
        "subtotal" => $subtotal,
        "discount" => $discount,
        "total_tax" => $total_tax
    ];
    return $tax_details;
}

}
