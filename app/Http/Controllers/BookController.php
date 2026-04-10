<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Js;

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

    public function save(Request $request): JsonResponse {
        $request = $this->parseRequest($request);

        DB::beginTransaction();
        try {
            $book = Book::create($request->all());

            if (isset($request->images) && is_array($request->images)) {
                foreach ($request->images as $image) {
                    $book->images()->save(
                        new Image(
                            [
                                'url' => $image['url'],
                                'title' => $image['title']
                            ])
                    );
                }
            }

            DB::commit();

            return response()->json($book, 200);
        }
        catch (\Exception $e) {

            DB::rollBack();
            return response()->json("saving failed: " . $e->getMessage(), 500);
        }


    }


    private function parseRequest(Request $request): Request {
        // convert ISO 8601 date format to mysql datetime
        $date = new \DateTime($request['published']);
        $request->merge(['published' => $date->format('Y-m-d H:i:s')]);

        return $request;


    }
}
