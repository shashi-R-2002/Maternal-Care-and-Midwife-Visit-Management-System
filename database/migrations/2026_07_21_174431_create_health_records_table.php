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
    Schema::create('health_records', function (Blueprint $table) {

        $table->id();

        $table->foreignId('visit_id')
            ->constrained('visits')
            ->cascadeOnDelete();

        $table->foreignId('mother_id')
            ->constrained('mothers')
            ->cascadeOnDelete();

        $table->string('blood_pressure');
        $table->decimal('weight', 5, 2);

        $table->integer('blood_sugar')->nullable();

        $table->decimal('hemoglobin', 4, 1)->nullable();

        $table->enum('urine_protein', [
            'Negative',
            'Trace',
            '+1',
            '+2',
            '+3'
        ])->nullable();

        $table->enum('urine_sugar', [
            'Negative',
            'Trace',
            '+1',
            '+2',
            '+3'
        ])->nullable();

        $table->text('notes')->nullable();

        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_records');
    }
};
