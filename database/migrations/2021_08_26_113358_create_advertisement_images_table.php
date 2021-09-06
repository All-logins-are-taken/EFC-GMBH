<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementImagesTable extends Migration
{

    public function up(): void
    {
        Schema::create('advertisement_images', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->id();
            $table->foreignId('advertisement_id')
                ->nullable()
                ->constrained('advertisements')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('image_name', 1024);
            $table->string('image_path', 2048);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('advertisement_images');
    }
}
