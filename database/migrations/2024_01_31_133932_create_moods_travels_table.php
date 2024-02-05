<?php

use App\Models\Mood;
use App\Models\Travel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('moods_travels', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Mood::class);
            $table->foreignIdFor(Travel::class);
            $table->integer('value')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('moods_travels');
    }
};
