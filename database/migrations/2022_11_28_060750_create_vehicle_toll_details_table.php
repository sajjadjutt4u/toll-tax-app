<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleTollDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_toll_details', function (Blueprint $table) {
            $table->id();
            $table->string('number_plate');
            $table->string('entry_interchange');
            $table->string('exit_interchange')->nullable();
            $table->dateTime('entry_date_time');
            $table->dateTime('exit_date_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_toll_details');
    }
}
