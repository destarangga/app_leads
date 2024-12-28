<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('origin');
            $table->string('address')->nullable();
            $table->boolean('taken_by_salesman')->default(false);
            $table->unsignedBigInteger('salesman_id')->nullable();
            $table->timestamps();

            $table->foreign('salesman_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('leads');
    }
}
