<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meets', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_visible')->default(0);
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('folder')->nullable();
            $table->string('host');
            $table->string('type');
            $table->integer('phases');
            $table->string('date');
            $table->dateTime('deadline');
            $table->foreignId('location_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('contact_id')->nullable()->constrained()->nullOnDelete();
            $table->string('race_info_id')->nullable();
            $table->string('pre_startlist_id')->nullable();
            $table->string('race_record_id')->nullable();
            $table->string('time_schedule_id')->nullable();
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
        Schema::dropIfExists('meets');
    }
}
