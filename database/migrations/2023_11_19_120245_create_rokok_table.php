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
        Schema::create('rokok', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('merk');
            $table->string('jenis');
            $table->decimal('tart_conten');
            $table->decimal('nikotin_content');
            $table->decimal('harga');
            $table->integer('stock');
            $table->timestamps('created_at');
            $table->timestamps('updated_at');
            $table->decimal('pajak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rokok');
    }
};
