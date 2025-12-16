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
        // Если rating_history уже существует, просто обновляем структуру
        if (Schema::hasTable('rating_history')) {
            Schema::table('rating_history', function (Blueprint $table) {
                // Проверяем существование колонки перед удалением
                if (Schema::hasColumn('rating_history', 'match_id')) {
                    // Удаляем внешний ключ (если существует)
                    try {
                        $table->dropForeign(['match_id']);
                    } catch (\Exception $e) {
                        // Игнорируем ошибку, если внешний ключ не существует
                    }
                    
                    // Удаляем индекс (если существует)
                    try {
                        $table->dropIndex(['match_id', 'created_at']);
                    } catch (\Exception $e) {
                        // Игнорируем ошибку, если индекс не существует
                    }
                    
                    // Удаляем колонку
                    $table->dropColumn('match_id');
                }
            });
        } elseif (Schema::hasTable('transactions')) {
            // Переименовываем таблицу только если rating_history не существует
            Schema::rename('transactions', 'rating_history');
            
            // Удаляем поле match_id и связанные индексы
            Schema::table('rating_history', function (Blueprint $table) {
                // Удаляем внешний ключ (если существует)
                try {
                    $table->dropForeign(['match_id']);
                } catch (\Exception $e) {
                    // Игнорируем ошибку, если внешний ключ не существует
                }
                
                // Удаляем индекс (если существует)
                try {
                    $table->dropIndex(['match_id', 'created_at']);
                } catch (\Exception $e) {
                    // Игнорируем ошибку, если индекс не существует
                }
                
                // Удаляем колонку
                $table->dropColumn('match_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Возвращаем поле match_id
        Schema::table('rating_history', function (Blueprint $table) {
            $table->foreignId('match_id')->nullable()->after('game_id')->constrained('tournaments_matches')->nullOnDelete();
            $table->index(['match_id', 'created_at']);
        });
        
        // Переименовываем обратно
        Schema::rename('rating_history', 'transactions');
    }
};

