<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class MDMStatusInitialize extends Migration
{

    public function up()
    {

        $capsule = new Capsule();

        $capsule::schema()->create('insight_idr', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial_number')->unique();
            $table->string('client_id')->default('');
            $table->string('sorted_collectors_list')->default('');
            $table->string('agent_version')->default('');
            $table->string('agent_status')->default('');

            $table->index('client_id');
            $table->index('sorted_collectors_list');
            $table->index('agent_version');
            $table->index('agent_status');
        });
    }

    public function down()
    {
        $capsule = new Capsule();
        $capsule::schema()->dropIfExists('insight_idr');
    }


}
