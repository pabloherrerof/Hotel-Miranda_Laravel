<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->text('description');
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->integer('room_number');
            $table->foreign('user_id')->references('id')->on('users_guest');
            $table->foreign('room_number')->references('roomNumber')->on('rooms');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

