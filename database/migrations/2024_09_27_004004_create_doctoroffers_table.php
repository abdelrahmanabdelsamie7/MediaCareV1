<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doctoroffers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('details');
            $table->text('infoAboutOffer');
            $table->decimal('priceBeforDiscount');
            $table->integer('discount');
            $table->foreignId('doctor_id')->constrained('doctors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctoroffers');
    }
};
