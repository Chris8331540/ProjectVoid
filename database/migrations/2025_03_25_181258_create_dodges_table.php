<?php

use App\Models\Agent;
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
        Schema::create('dodges', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("info");
            $table->integer("order");
            $table->string("image");

            $table->foreignIdFor(Agent::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dodges');
    }
};
