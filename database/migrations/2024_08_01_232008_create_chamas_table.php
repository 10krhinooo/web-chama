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
        Schema::create('chamas', function (Blueprint $table) {
            $table->id();
            $table->string('name')->required()->searchable();
            $table->string('description');
            $table->integer('Number_of_members');
            $table->string('Chama_type')->searchable();
            $table->string('currency');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chamas');
    }
};
