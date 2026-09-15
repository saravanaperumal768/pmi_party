<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pmi_registration', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('father_name', 200);
            $table->date('dob');
            $table->smallInteger('age');
            $table->string('community', 50);
            $table->enum('gender', ['Male', 'Female', 'others']);
            $table->enum('martialstatus', ['Single', 'Married', 'others']);
            $table->string('blood_group', 10);
            $table->string('mobile_number', 15);
            $table->string('email', 100);


            $table->string('qualification', 100);
            $table->string('occupation', 25);
            $table->string('social_media', 100);
            $table->string('state', 20);
            $table->string('constitution', 50);
            $table->string('district', 50);
            $table->string('taluk', 50);
            $table->string('block', 50);
            $table->string('part', 50);
            $table->text('address');
            $table->text('photo');
            $table->string('voter_id', 20);
            $table->text('id_proof');
            $table->string('regi_flag');
            $table->string('member_registration');
            $table->string('regi_status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pmi_registration');
    }
};
