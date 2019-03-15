<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetsTable extends Migration
{
    public function up(): void
    {
        Schema::create('pets', static function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->string('name', 128);
            $table->string('description', 512);
            $table->decimal('price');
            $table->string('image');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
}
