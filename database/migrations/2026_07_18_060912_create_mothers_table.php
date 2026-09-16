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
       Schema::create('mothers', function (Blueprint $table) {

    $table->id();

    $table->string('registration_no')->unique();

    $table->string('full_name');

    $table->string('nic')->unique();

    $table->date('dob');

    $table->integer('age');

    $table->string('phone');

    $table->text('address');

    $table->enum('blood_group', [
        'A+','A-',
        'B+','B-',
        'AB+','AB-',
        'O+','O-'
    ]);

    $table->date('lmp');

    $table->date('edd');

    $table->integer('gravida');

    $table->integer('para');

    $table->enum('status', [
        'Pregnant',
        'Delivered'
    ])->default('Pregnant');

    $table->unsignedBigInteger('midwife_id');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mothers');
    }
};
