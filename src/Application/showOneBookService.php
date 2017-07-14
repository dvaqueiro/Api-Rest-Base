<?php

namespace Dvaqueiro\Application;

use Dvaqueiro\Domain\Model\Book\BookDTO;
use Dvaqueiro\Domain\Model\Book\bookRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @author dvaqueiro
 */
class showOneBookService
{
    private $bookRepository;

    function __construct(bookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function execute($id)
    {
        $book = $this->bookRepository->findById($id);
        if(!$book) return "Book with id {$id} not found!!";

        return new BookDTO($book->isbn(), $book->title(), $book->year());
    }
}