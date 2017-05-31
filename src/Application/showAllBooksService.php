<?php

namespace Dvaqueiro\Application;

use Dvaqueiro\Domain\Model\Book\BookDTO;
use Dvaqueiro\Domain\Model\Book\bookRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @author dvaqueiro
 */
class showAllBooksService
{
    private $bookRepository;

    function __construct(bookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function execute()
    {
        $books = $this->bookRepository->findAll();

        foreach ($books as $book) {
            $response[] = new BookDTO($book->isbn(), $book->title(), $book->year());
        }

        return new JsonResponse($response, 200);
    }
}