<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeatherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weathers', function (Blueprint $table) {
            $table->increments('id');
            $table->float('temp');
            $table->string('weather');
            $table->float('pressure');
            $table->string('relative_humidity');
            $table->string('soil_humidity');
            $table->timestamps();
        });
        $sql = 'ALTER TABLE weathers ADD pi_image MEDIUMBLOB';
        DB::connection()->getPdo()->exec($sql);
        $sql2 = 'ALTER TABLE weathers ADD matlab_image MEDIUMBLOB IS NULL';
        DB::connection()->getPdo()->exec($sql2);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weathers');
    }
}
