<?php

use App\Models\DodgeMultiplier;
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
        Schema::create('dodge_dazes', function (Blueprint $table) {
            $table->id();
            $table->integer("lvl");
            $table->string("multiplier");

            $table->foreignIdFor(DodgeMultiplier::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dodge_dazes');
    }
};
