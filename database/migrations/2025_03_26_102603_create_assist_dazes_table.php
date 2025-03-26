<?php

use App\Models\AssistMultiplier;
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
        Schema::create('assist_dazes', function (Blueprint $table) {
            $table->id();
            $table->integer("lvl");
            $table->string("multiplier");

            $table->foreignIdFor(AssistMultiplier::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assist_dazes');
    }
};
