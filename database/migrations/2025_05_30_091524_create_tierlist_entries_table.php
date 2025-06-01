<?php

use App\Models\Agent;
use App\Models\Tierlist;
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
        Schema::create('tierlist_entries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string("category");
            $table->integer("order");
            
            $table->foreignIdFor(Tierlist::class);
            $table->foreignIdFor(Agent::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tierlist_entries');
    }
};
