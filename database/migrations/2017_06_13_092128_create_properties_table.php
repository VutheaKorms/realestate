<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->float('price')->default(0);
            $table->string('room')->default(0);
            $table->string('category');
            $table->string('bed-room')->default(0);
            $table->string('bath-room')->default(0);
            $table->string('size')->default(0);
            $table->string('postal_address')->nullable();
            $table->string('physical_address')->nullable();
            $table->string('description', 255)->nullable();
            $table->integer('type_id')->unsigned()->index();
            $table->integer('property_type_id')->unsigned()->index();
            $table->integer('location_id')->unsigned()->index();
            $table->integer('community_id')->unsigned()->index();
            $table->integer('village_id')->unsigned()->index();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('type_id')
                ->references('id')
                ->on('types')
                ->onDelete('cascade');

            $table->foreign('property_type_id')
                ->references('id')
                ->on('property_types')
                ->onDelete('cascade');

            $table->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->onDelete('cascade');

            $table->foreign('community_id')
                ->references('id')
                ->on('communities')
                ->onDelete('cascade');

            $table->foreign('village_id')
                ->references('id')
                ->on('villages')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
