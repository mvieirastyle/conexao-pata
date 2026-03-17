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
          Schema::create('form_volunteers', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->date('birth_date');
            $table->string('nationality');
            $table->string('id_number');
            $table->string('phone');
            $table->string('address');
            $table->string('occupation');
            $table->string('company_school')->nullable();
            $table->string('hobbies')->nullable();
            $table->string('transport');
            $table->json('animals');
            $table->json('area');
            $table->json('activities');
            $table->json('courses');
            $table->boolean('accident_responsibility');
            $table->boolean('adaptation_terms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_volunteers');
    }
};
