<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suspects', function (Blueprint $table) {
            $table->id();
            $table->string('case_ref');
            $table->string('station');
            $table->string('offence');
            $table->text('briefs_on_case');
            $table->string('name');
            $table->string('sex');
            $table->integer('age');
            $table->string('nationality');
            $table->string('nin');
            $table->string('other_id_no');
            $table->string('tribe');
            $table->string('religion');
            $table->string('marital_status');
            $table->string('place_of_birth');
            $table->string('present_address');
            $table->text('distinguishing_features');
            $table->decimal('height', 8, 2);
            $table->string('bodybuild');
            $table->string('eye_color');
            $table->string('hair_color');
            $table->string('level_of_education');
            $table->string('languages_spoken');
            $table->text('travel_history');
            $table->text('previous_crime_records');
            $table->string('occupation');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suspects');
    }
};
