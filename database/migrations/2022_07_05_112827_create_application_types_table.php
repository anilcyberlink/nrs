<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_types', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('runners')->onDelete('cascade');
            $table->string('individual_entry')->nullable();
            $table->string('group_entry')->nullable();
            $table->string('group_name')->nullable();
            $table->string('group_size')->nullable();
            $table->string('group_type')->nullable();
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
        Schema::dropIfExists('application_types');
    }
}
