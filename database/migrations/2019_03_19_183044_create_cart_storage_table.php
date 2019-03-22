<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartStorageTable extends Migration
{
    public function up(): void
    {
        Schema::create('cart_storage', static function (Blueprint $table): void {
            $table->string('id')->index()->primary();
            $table->longText('cart_data');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_storage');
    }
}
