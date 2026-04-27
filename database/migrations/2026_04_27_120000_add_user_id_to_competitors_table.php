<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToCompetitorsTable extends Migration
{
    public function up()
    {
        Schema::table('competitors', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->nullable()
                ->after('team_id')
                ->constrained()
                ->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('competitors', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
