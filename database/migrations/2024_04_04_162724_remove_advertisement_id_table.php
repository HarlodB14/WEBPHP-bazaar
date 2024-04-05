<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('components', function (Blueprint $table) {
            $table->dropForeign('components_advertisements_id_foreign');
        });

        Schema::table('components', function (Blueprint $table) {
            $table->dropColumn('advertisements_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add the column back
        Schema::table('components', function (Blueprint $table) {
            $table->foreignId('advertisements_id')->constrained()->onDelete('cascade');
        });
    }
};
