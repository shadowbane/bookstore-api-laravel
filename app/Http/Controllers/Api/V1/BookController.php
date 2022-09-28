<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Traits\ApiFormatter;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    use ApiFormatter;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->sendResponse(
            Book::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BookRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BookRequest $request): JsonResponse
    {
        try {
            $book = Book::create($request->all());
        } catch (\Exception $e) {
            return $this->sendErrorResponse(
                [
                    'message' => $e->getMessage(),
                ],
                400
            );
        }

        return $this->sendResponse(
            $book->toArray()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  Book  $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Book $book): JsonResponse
    {
        return $this->sendResponse(
            $book->toArray()
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BookRequest  $request
     * @param  Book  $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BookRequest $request, Book $book): JsonResponse
    {
        $book->update($request->all());

        return $this->sendResponse(
            [
                'message' => 'Book updated successfully',
                'data' => $book->toArray(),
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Book  $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Book $book): JsonResponse
    {
        try {
            $book->delete();
        } catch (\Exception $e) {
            return $this->sendErrorResponse(
                [
                    'message' => $e->getMessage(),
                ],
                400
            );
        }

        return $this->sendResponse(
            [
                'message' => 'Book deleted successfully',
            ]
        );
    }
}
