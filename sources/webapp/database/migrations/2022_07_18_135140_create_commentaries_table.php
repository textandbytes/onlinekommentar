<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentaries', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique()->nullable();
            $table->string('label_de');
            $table->string('label_en')->nullable();
            $table->string('label_fr')->nullable();
            $table->string('label_it')->nullable();
            $table->longtext('content_de')->nullable();
            $table->longtext('content_en')->nullable();
            $table->longtext('content_fr')->nullable();
            $table->longtext('content_it')->nullable();
            $table->enum('original_language', ['de', 'en', 'fr', 'it'])->default('de');
            $table->text('suggested_citation_long')->nullable();
            $table->text('suggested_citation_short')->nullable();
            $table->string('doi')->nullable();
            $table->enum('status', ['draft', 'in_review', 'published'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commentaries');
    }
};
