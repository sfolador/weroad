<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignIdFor(Role::class)->nullable()->constrained();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropForeignIdFor(Role::class);
        });
    }
};
