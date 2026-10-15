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
        // Only create the table if it doesn't already exist
        if (!Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->text('excerpt')->nullable();
                $table->longText('content');
                $table->string('status')->default('draft')->index();
                $table->timestamp('published_at')->nullable()->index();
                
                $table->foreignId('category_id')
                    ->constrained('categories')
                    ->cascadeOnDelete()
                    ->index();
                
                $table->foreignId('user_id')
                    ->constrained('users')
                    ->cascadeOnDelete()
                    ->index();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index('title');
                $table->index('slug');
                $table->index(['status', 'published_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
