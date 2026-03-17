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
        Schema::create('form_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 25);
            $table->string('email', 55);
            $table->string('subject', 255);
            $table->text('message');    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_contacts');
    }
};
