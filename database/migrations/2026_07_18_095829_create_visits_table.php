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
    Schema::create('visits', function (Blueprint $table) {

        $table->id();

        $table->foreignId('mother_id')
              ->constrained('mothers')
              ->cascadeOnDelete();

        $table->foreignId('midwife_id')
              ->constrained('midwives')
              ->cascadeOnDelete();

        $table->date('visit_date');

        $table->date('next_visit_date')->nullable();

        $table->enum('visit_type', [
            'Home Visit',
            'Clinic Visit'
        ]);

        $table->string('blood_pressure')->nullable();

        $table->decimal('weight', 5, 2)->nullable();

        $table->text('notes')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
