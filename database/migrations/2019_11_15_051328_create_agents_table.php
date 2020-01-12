<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->bigIncrements('agen_id');
            $table->string('agen_name', 50);
            $table->string('agen_email');
            $table->string('agen_phone')->nullable();
            $table->text('agen_address')->nullable();
            $table->unsignedTinyInteger('agen_grpagen_id')->index()->nullable();
            $table->timestamps();
        });

        Schema::create('agent_groups', function (Blueprint $table) {
            $table->bigIncrements('grpagen_id');
            $table->string('grpagen_name', 50);
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
        Schema::dropIfExists('agent_groups');
        Schema::dropIfExists('agents');
    }
}
