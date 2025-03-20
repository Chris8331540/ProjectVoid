<?php

use App\Models\SpecialMultiplier;
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
        Schema::create('special_dmgs', function (Blueprint $table) {
            $table->id();
            $table->integer("lvl");
            $table->string("multiplier");
            $table->timestamps();

            $table->foreignIdFor(SpecialMultiplier::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_dmgs');
    }
};
