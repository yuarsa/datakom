<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worksheets', function (Blueprint $table) {
            $table->bigIncrements('work_id');
            $table->string('work_symptomp');
            $table->string('work_klarifikasi');
            $table->string('work_tindak_lanjut');
            $table->string('work_rekomendasi');
            $table->string('work_progres');
            $table->unsignedBigInteger('work_agen')->default(0);
            $table->string('work_status')->nullable();
            $table->string('work_keterangan')->nullable();
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
        Schema::dropIfExists('worksheets');
    }
}
