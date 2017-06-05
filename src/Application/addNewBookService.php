<?php

namespace Dvaqueiro\Application;

use Dvaqueiro\Domain\Model\Book\Book;
use Dvaqueiro\Domain\Model\Book\BookDTO;
use Dvaqueiro\Domain\Model\Book\BookRepository;

class addNewBookService
{
    private $bookRepository;

    function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function execute($jsonData)
    {
        $data = json_decode($jsonData, true);
        $book = new Book($data['isbn'], $data['title'], $data['year']);
        $this->bookRepository->update($book);

        return new BookDTO($book->isbn(), $book->title(), $book->year());
    }
}
