<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up(): void
    {
        Schema::create('categories', static function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->string('name', 128);
            $table->string('description', 512);
            $table->string('image');
            $table->unsignedTinyInteger('display_order');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
}
