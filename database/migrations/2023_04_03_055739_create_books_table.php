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
        Schema::create('books', function (Blueprint $table) {
           //data gathered as of initial visit to the stakeholder
           $table->id();
           $table->string('book_title');
           $table->unsignedBigInteger('author_id')->nullable();
           $table->foreign('author_id')->references('id')->on('authors');
           $table->unsignedBigInteger('section_id');
           $table->foreign('section_id')->references('id')->on('book_sections');
           $table->string('author_no')->nullable();
           $table->float('class_no')->nullable();
           $table->string('accession')->nullable();
           $table->string('edition')->nullable();
           $table->string('publication_year')->nullable();
           $table->date('date_acquired')->nullable();
           $table->string('no_of_copies');
           $table->string('book_status'); //available or not
           $table->string('book_condition'); //functional or not
           //ADDED FIELDS : suggested to be included supposedly base on research
           $table->string('isbn')->nullable();
           $table->string('publisher')->nullable();
           $table->string('number_of_pages')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('book_locations');
           $table->text('summary')->nullable();
           $table->string('added_by')->nullable(); //the name sa nag add sa book
           $table->tinyInteger('is_available')->default(1); //current state of the book
           $table->smallInteger('available_copies'); //current state of the book
           $table->string('book_cover')->nullable();
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
