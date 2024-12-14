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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('facility_id');
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
            $table->string('room_type' , 50);
            $table->string('room_number' , 50);
            $table->decimal('room_rate' , 7,2);
            $table->string('room_status' , 30);
            $table->string('room_capacity' , 10);
            $table->string('room_description' , 500);
            $table->string('room_amenities' , 500);
            $table->string('room_inclusion' , 500);
            $table->string('room_photo1' , 100);
            $table->string('room_photo2' , 100);
            $table->string('room_photo3' , 100);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
