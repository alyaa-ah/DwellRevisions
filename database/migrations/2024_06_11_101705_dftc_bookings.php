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
        Schema::create('dftc_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->string('DFTC_date');
            $table->string('DFTC_number')->unique();
            $table->string('fullname', 100);
            $table->string('position', 20);
            $table->string('agency', 50);
            $table->string('contact', 13);
            $table->string('address', 255);
            $table->string('email', 120);
            $table->string('activity', 255);
            $table->string('room_number', 100);
            $table->integer('number_of_days');
            $table->integer('number_of_nights');
            $table->string('check_in_date');
            $table->string('check_out_date');
            $table->string('arrival');
            $table->string('departure');
            $table->decimal('rate', 7, 2);
            $table->decimal('total_amount', 7, 2);
            $table->integer('num_of_male');
            $table->integer('num_of_female');
            $table->integer('total_lodgers');
            $table->string('status', 30);
            $table->decimal('janitor_services', 7,2)->nullable();
            $table->decimal('av_services', 7,2)->nullable();
            $table->string('special_request', 500)->nullable();
            $table->string('reason', 500)->nullable();
            $table->float('ratings')->nullable();
            $table->string('feedbacks', 500)->nullable();
            $table->string('comment_date', 30)->nullable();
            $table->string('remarks', 120)->nullable();
            $table->string('or_number', 30)->nullable();
            $table->string('anonymous', 5)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dftc_bookings');
    }
};
