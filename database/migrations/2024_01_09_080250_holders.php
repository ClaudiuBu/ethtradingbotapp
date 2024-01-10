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
        Schema::create('metrics_holders', function (Blueprint $table) {
            $table->id();
            $table->string('token_id');
            $table->integer('holders_count')->default(0); // count of holders
            $table->integer('velocity_holders_count')->default(0);
            $table->decimal('average_holdings', 18, 8)->default(0); // average amount of tokens held by holders//This field represents the average amount of tokens held by each holder. It can be useful to understand the distribution of tokens among holder
            $table->integer('active_holders_count')->default(0); // count of active holders which actively trade the token
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
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
