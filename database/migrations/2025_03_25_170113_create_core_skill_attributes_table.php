<?php

use App\Models\CoreSkill;
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
        Schema::create('core_skill_attributes', function (Blueprint $table) {
            $table->id();
            $table->string("name");

            $table->foreignIdFor(CoreSkill::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('core_skill_attributes');
    }
};
