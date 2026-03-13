<?php

namespace Database\Seeders;

use App\Models\Book;
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
        $book->save();

    }
}
