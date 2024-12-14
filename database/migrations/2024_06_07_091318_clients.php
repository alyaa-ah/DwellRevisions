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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('fullname' , 100);
            $table->string('position' , 30);
            $table->string('address' , 100);
            $table->string('contact' , 13);
            $table->string('agency' , 30);
            $table->string('email' , 100)->unique();
            $table->string('username', 30)->unique();
            $table->string('password' , 120);
            $table->string('role', 10);
            $table->string('status', 20);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
