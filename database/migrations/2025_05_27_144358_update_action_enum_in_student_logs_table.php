<?php

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
        Schema::table('student_logs', function (Blueprint $table) {
            $table->enum('action', ['created', 'updated', 'deleted', 'restored', 'force_deleted'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_logs', function (Blueprint $table) {
            $table->string('action')->change(); // Revertir a los valores originales
        });
    }
};
