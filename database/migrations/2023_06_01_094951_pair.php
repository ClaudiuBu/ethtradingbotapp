<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pairs', function (Blueprint $table) {
            $table->id('id_pair');
            $table->string('pair_address', 42)->unique();
            $table->string('token0_address', 42);
            $table->string('token1_address', 42);
            $table->boolean('blacklisted')->default(false);
            $table->string('block_timestamp')->nullable()->default(null);
            $table->string('block_number')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
