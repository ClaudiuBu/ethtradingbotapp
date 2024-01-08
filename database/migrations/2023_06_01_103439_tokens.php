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
        Schema::create('tokens', function (Blueprint $table) {
            $table->id();
            $table->string('token_address')->unique();
            $table->string('token_name')->unique();
            $table->string('token_symbol')->unique();
            $table->string('token_decimals');
            $table->string('token_total_supply');
            $table->string('token_owner');
            $table->boolean('scam')->default(false);
            $table->string('tx_hash');
            $table->boolean('snipe_active')->default(false);
            $table->bigInteger('value')->default(0);
            $table->integer('sell_tax')->default(0);
            $table->integer('buy_tax')->default(0);
            $table->boolean('contract_verified')->default(false);
            $table->json('bytecode')->nullable();
            $table->json('abi')->nullable();
            $table->string('token_block_timestamp');
            $table->string('token_block_number');
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
