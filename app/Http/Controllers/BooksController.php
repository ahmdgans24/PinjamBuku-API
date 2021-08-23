<?php

namespace App\Http\Controllers;

use App\Models\Books;

class BooksController extends Controller
{
    public function databook() {
        $book = Books::all();

        if($book->count() <= 0) {
            return response()->json([
                'message' => 'Not Found'
            ], 404);
        } else {
            return response()->json([
                'message' => 'success',
                'data' => $book
            ], 200);
        }

    }

    public function insertbook() {
        $book = Books::create([
            'name' => request()->name,
            'author' => request()->author,
            'publisher' => request()->publisher
        ]);

        return response()->json([
            'message' => 'success input.',
            'data' => $book
        ]);
    }

    public function updatebook($id) {
        $name = request()->name;
        $author = request()->author;
        $publisher = request()->publisher;

        $book = Books::find($id);
        if($book === null) {
            return response()->json([
                'message' => 'data tidak ditemukan'
            ], 404);
        } else {
            $book->name = $name;
            $book->author = $author;
            $book->publisher = $publisher;
            $book->save();
    
            return response()->json([
                'message' => 'data berhasil di update',
                'data' => $book
            ], 200);
        }
    }

    public function deletebook($id) {
        $book = Books::find($id);

        if($book === null) {
            return response()->json([
                'message' => 'data tidak ditemukan'
            ], 404);
        } else {
            $book->delete();
            return response()->json([
                'message' => 'data berhasil dihapus'
            ], 202);
        }
    }
}
