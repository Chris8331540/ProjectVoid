<?php

use App\Models\CoreSkillAttribute;
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
        Schema::create('core_skill_additions', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("value");
            $table->integer("lvl");

            $table->foreignIdFor(CoreSkillAttribute::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('core_skill_additions');
    }
};
