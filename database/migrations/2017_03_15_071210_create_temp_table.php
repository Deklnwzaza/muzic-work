<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        /*Schema::create('temps', function (Blueprint $table) {
            $table->increments('id');
            $table->float('mean_temp');
            $table->float('max_temp');
            $table->float('min_temp');
            $table->string('Date');
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
       // Schema::dropIfExists('temps');
    }
}
