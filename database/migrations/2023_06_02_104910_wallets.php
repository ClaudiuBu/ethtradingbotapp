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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id('id_wallet');
            $table->string('wallet_address', 42)->unique();
            $table->json('balances')->nullable();
            $table->string('source_of_funds')->nullable()->default(null); //exchange, airdrop, presale, private sale, public sale, other - to think about this
            $table->json('interacted_with')->nullable(); //wallets that the wallet interacted with
            $table->string('first_activity')->nullable()->default(null); //new/old wallet - intensity of the activity // numbers of txs
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
