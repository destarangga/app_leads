<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToLeadHistoriesTable extends Migration
{
    public function up()
    {
        Schema::table('lead_histories', function (Blueprint $table) {
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('job')->nullable();
            $table->string('hobby')->nullable();
        });
    }

    public function down()
    {
        Schema::table('lead_histories', function (Blueprint $table) {
            $table->dropColumn(['email', 'address', 'job', 'hobby']);
        });
    }
}
