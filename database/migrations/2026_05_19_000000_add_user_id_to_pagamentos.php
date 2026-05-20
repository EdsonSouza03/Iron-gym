<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add nullable user_id referencing alunos
        Schema::table('pagamentos', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('usuario')->constrained('alunos')->nullOnDelete();
        });

        // Try to populate user_id by matching pagamentos.usuario to alunos.email
        // This will set user_id where the `usuario` column stores the aluno's email.
        DB::table('pagamentos')
            ->join('alunos', 'pagamentos.usuario', '=', 'alunos.email')
            ->update(['pagamentos.user_id' => DB::raw('alunos.id')]);

        // Note: if `usuario` contains names or other values, those won't be mapped automatically.
        // After confirming data, you may remove the `usuario` column in a follow-up migration.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pagamentos', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
        });
    }
};
