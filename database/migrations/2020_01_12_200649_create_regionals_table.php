<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regionals', function (Blueprint $table) {
            $table->increments('reg_id');
            $table->string('reg_name');
            $table->string('reg_display_name');
            $table->timestamps();
        });

        Schema::create('witels', function (Blueprint $table) {
            $table->increments('witel_id');
            $table->unsignedInteger('witel_regional_id')->index();
            $table->string('witel_name');
            $table->string('witel_display_name');
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
        Schema::dropIfExists('regionals');
        Schema::dropIfExists('witels');
    }
}
