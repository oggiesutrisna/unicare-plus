<?php

use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->string('judul_post');
            $table->string('slug');
            $table->text('deskripsi');
            $table->longText('gambar');
            $table->string('date_released');

            $table->foreignIdFor(User::class)->constrained('users');
            $table->foreignIdFor(Category::class)->constrained('categories');
            $table->foreignIdFor(Tag::class)->constrained('tags');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
