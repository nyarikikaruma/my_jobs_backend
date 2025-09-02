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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('company');
            $table->text('location');
            $table->text('job_type');
            $table->text('experience');
            $table->text('salary');
            $table->text('what_you_will_do')->nullable();
            $table->text('requirements')->nullable();
            $table->text('nice_to_have')->nullable();
            $table->string('category')->nullable();
            $table->date('expires_at')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
