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
        Schema::create('form_adoptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('animal_id')->constrained('animals')->cascadeOnDelete();
            $table->string('full_name', 25);
            $table->string('email', 55);
            $table->date('birth_date');
            $table->string('nationality', 50);
            $table->string('id_number', 9);
            $table->string('phone', 9);
            $table->string('address', 255);
            $table->json('animals');
            $table->json('residence_type');
            $table->string('wall_height')->nullable();
            $table->string('lifestyle');
            $table->string('daily_routine');
            $table->string('dog_walks')->nullable();
            $table->string('house_access');
            $table->string('vacation_plans');
            $table->string('veterinarian');
            $table->string('past_animals');
            $table->string('concerns');
            $table->string('unacceptable_behaviors');
            $table->string('undesired_behaviors');
            $table->string('dog_training')->nullable();
            $table->string('adoption_decision');
            $table->string('life_changes');
            $table->string('past_separations');
            $table->string('family_constraints');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_adoptions');
    }
};
