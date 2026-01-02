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
        Schema::create('user_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reported_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('reporter_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('reporter_email')->nullable(); // Для незарегистрированных пользователей
            $table->string('reporter_ip')->nullable(); // IP адрес для дополнительной проверки
            $table->integer('category_id'); // ID категории из констант ReportCategory
            $table->text('description')->nullable(); // Дополнительные детали
            $table->enum('status', ['pending', 'reviewed', 'resolved', 'rejected'])->default('pending');
            $table->text('admin_notes')->nullable(); // Заметки администратора
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete(); // Кто рассмотрел жалобу
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
            
            $table->index(['reported_user_id', 'status']);
            $table->index('status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_reports');
    }
};


