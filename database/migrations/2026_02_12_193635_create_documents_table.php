<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_type'); // pdf, jpg, png
            $table->integer('file_size'); // en Ko

            $table->foreignId('member_id')->constrained()->onDelete('cascade');
            $table->foreignId('uploaded_by')->constrained('users');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
};
