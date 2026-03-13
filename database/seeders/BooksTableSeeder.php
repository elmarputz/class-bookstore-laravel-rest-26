<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $book = new Book();
        $book->title = "Herr der Ringe";
        $book->subtitle = "Die 2 Türme";
        $book->isbn = "23o49239234039234";
        $book->rating = rand(1, 5);
        $book->description = Str::random(1000);
        $book->published = new \DateTime();

        $user = User::all()->first();
        $book->user()->associate($user);

        $book->save();

        $image1 = new Image();
        $image1->title = 'Image 1';
        $image1->url = 'https://picsum.photos/600';

        $image2 = new Image();
        $image2->title = 'Image 2';
        $image2->url = 'https://picsum.photos/600';

        $book->images()->saveMany([$image1, $image2]);

        // authors
        $authors = Author::all()->pluck('id');
        $book->authors()->sync($authors);


        $book->save();

    }
}
