<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Chain;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chain_multipliers', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("multiplier_type");
            $table->integer("order");
            $table->foreignIdFor(Chain::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chain_multipliers');
    }
};
