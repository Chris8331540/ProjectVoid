<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Special;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('special_multipliers', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("multiplier_type");
            $table->integer("order");
            $table->timestamps();

            $table->foreignIdFor(Special::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_multipliers');
    }
};
