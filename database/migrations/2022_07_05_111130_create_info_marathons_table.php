<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoMarathonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_marathons', function (Blueprint $table) {
            $table->integer('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('runners')->onDelete('cascade');
            $table->string('event')->nullable();
            $table->string('event_category')->nullable();
            $table->string('tshirt_size')->nullable();
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
        Schema::dropIfExists('info_marathons');
    }
}
