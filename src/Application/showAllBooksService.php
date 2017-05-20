<?php

namespace dvaqueiro\Application;

use dvaqueiro\Domain\Model\Book\BookDTO;
use dvaqueiro\Domain\Model\Book\bookRepository;

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
            $response[] = new BookDTO($book->isbn()->isbn(), $book->title(), $book->year());
        }

        return $response;
    }
}