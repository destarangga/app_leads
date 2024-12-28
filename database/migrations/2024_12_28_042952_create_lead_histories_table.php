<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('lead_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_id');
            $table->unsignedBigInteger('salesman_id');
            $table->string('follow_up_via');
            $table->date('follow_up_date');
            $table->string('status');
            $table->text('notes')->nullable();
            $table->date('next_follow_up_date')->nullable();
            $table->timestamps();

            $table->foreign('lead_id')->references('id')->on('leads')->onDelete('cascade');
            $table->foreign('salesman_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lead_histories');
    }
}
