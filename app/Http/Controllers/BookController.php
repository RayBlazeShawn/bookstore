<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
//  this function will be used for search and filtering purpose

    public function index(Request $request)
    {
        $query = Book::query();

//       filtering by title

        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }

        // Filtering by author
        if ($request->has('author')) {
            $query->where('author', 'like', '%' . $request->input('author') . '%');
        }

        // Filtering by publication date
        if ($request->filled('publication_date')) {

            $query->whereDate('publication_date', $request->input('publication_date'));
        }


        // Filtering by ISBN
        if ($request->has('isbn')) {
            $query->where('isbn', $request->input('isbn'));
        }

        // Filtering by genre
        if ($request->has('genre')) {
            $query->where('genre', 'like', '%' . $request->input('genre') . '%');
        }


        return $query->paginate(10);
    }

    // A Function to show a specific book
    public function show(Book $book)
    {
        return $book;
    }

    // Function to store a new book
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'publication_date' => 'required|date',
            'isbn' => 'required|unique:books,isbn',
            'genre' => 'required',
        ]);

        $book = Book::create($validatedData);

        return response()->json($book, Response::HTTP_CREATED);
    }

    // Function to update an existing book
    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'publication_date' => 'required|date',
            'isbn' => 'required|unique:books,isbn,' . $book->id,
            'genre' => 'required',
        ]);

        $book->update($validatedData);

        return response()->json($book);
    }

    // Function to delete a book
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
