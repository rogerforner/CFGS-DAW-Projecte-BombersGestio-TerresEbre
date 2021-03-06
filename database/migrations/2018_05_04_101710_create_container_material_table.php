<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContainerMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('container_material', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('quantitat_prevista')->default(0);
            $table->unsignedInteger('quantitat')->default(0);
            $table->boolean('es_del_parc')->default(true);
            // Foreign Keys.
            $table->unsignedInteger('container_id');
            $table->foreign('container_id')->references('id')->on('containers')->onDelete('cascade');
            $table->unsignedInteger('material_id');
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('containers_materials');
    }
}
