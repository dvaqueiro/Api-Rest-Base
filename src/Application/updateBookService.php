<?php

namespace Dvaqueiro\Application;

use Dvaqueiro\Domain\Model\Book\Book;
use Dvaqueiro\Domain\Model\Book\BookDTO;
use Dvaqueiro\Domain\Model\Book\BookRepository;

class updateBookService
{
    private $bookRepository;

    function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function execute($bookId, $jsonData)
    {
        /* @var $book Book */
        $book = $this->bookRepository->findById($bookId);

        $data = json_decode($jsonData, true);
        if($data['year']) $book->setYear($data['year']);
        if($data['title']) $book->setTitle($data['title']);
        
        $this->bookRepository->update($book);

        return new BookDTO($book->isbn(), $book->title(), $book->year());
    }
}
