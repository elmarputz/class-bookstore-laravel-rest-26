<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(): JsonResponse {
        $books = Book::with(['authors', 'images', 'user'])->get();
        return response()->json($books, 200);
    }


    public function findByISBN (string $isbn): JsonResponse {
        $book = Book::where('isbn', $isbn)
            ->with(['authors', 'images', 'user'])
            ->first();
        return $book != null ?  response()->json($book, 200) : response()->json(null, 200);
    }

    public function checkISBN(string $isbn): JsonResponse {
        $book = Book::where('isbn', $isbn)->first();
        return $book != null ?  response()->json(true, 200) : response()->json(false, 404);
    }

    public function findBySearchTerm (string $searchTerm): JsonResponse {
        $books = Book::with(['authors', 'images', 'user'])
            ->where('title', 'like', '%' . $searchTerm . '%')
            ->orWhere('subtitle', 'like', '%' . $searchTerm . '%')
            ->orWhere('description', 'like', '%' . $searchTerm . '%')
            ->orWhereHas('authors', function ($query) use ($searchTerm) {
                $query->where('firstName', 'like', '%' . $searchTerm . '%')
                    ->orWhere('lastName', 'like', '%' . $searchTerm . '%');
            })->get();
        return response()->json($books, 200);
    }

}
