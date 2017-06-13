<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('customers', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('first_name');
//            $table->string('last_name');
//            $table->string('phone_number')->nullable();
//            $table->string('email')->unique()->nullable();
//            $table->string('postal_address')->nullable();
//            $table->string('physical_address')->nullable();
//            $table->string('description', 255)->nullable();
//            $table->boolean('status')->default(true);
//            $table->integer('location_id')->unsigned()->index();
//            $table->integer('community_id')->unsigned()->index();
//            $table->integer('village_id')->unsigned()->index();
//            $table->timestamps();
//            $table->softDeletes();
//
//            $table->foreign('location_id')
//                ->references('id')
//                ->on('locations')
//                ->onDelete('cascade');
//
//            $table->foreign('community_id')
//                ->references('id')
//                ->on('communities')
//                ->onDelete('cascade');
//
//            $table->foreign('village_id')
//                ->references('id')
//                ->on('villages')
//                ->onDelete('cascade');
//
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
