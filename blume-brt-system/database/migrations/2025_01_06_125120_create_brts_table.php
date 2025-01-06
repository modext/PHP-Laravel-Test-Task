<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('brts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('brt_code')->unique();
        $table->decimal('reserved_amount', 10, 2);
        $table->string('status');
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

    });


}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brts');
    }
};
