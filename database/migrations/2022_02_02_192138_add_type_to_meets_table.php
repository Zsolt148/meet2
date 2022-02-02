<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToMeetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meets', function (Blueprint $table) {
            $table->boolean('is_entriable')->default(0)->after('is_visible');
            $table->string('entry_type')->nullable()->after('name');
            $table->string('entry_app')->nullable()->after('entry_type');
            $table->unsignedInteger('entry_price')->default(0)->after('entry_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meets', function (Blueprint $table) {
            $table->dropColumn('is_entriable', 'entry_type', 'entry_app', 'entry_price');
        });
    }
}
