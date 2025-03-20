<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Type;
use App\Models\Element;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string("info");
            $table->string("rank");
            $table->string("hp");
            $table->string("def");
            $table->string("atk");
            $table->string("crit_rate");
            $table->string("crit_dmg");
            $table->string("pen_ratio");
            $table->string("impact");
            $table->string("anomaly_mastery");
            $table->string("anomaly_proficiency");
            $table->string("energy_regen");
            $table->string("image");
            $table->string("image_show");

            $table->foreignIdFor(Type::class);
            $table->foreignIdFor(Element::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
