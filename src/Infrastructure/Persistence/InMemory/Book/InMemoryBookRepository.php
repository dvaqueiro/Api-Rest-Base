<?php

namespace Dvaqueiro\Infrastructure\Persistence\InMemory\Book;

use Dvaqueiro\Domain\Model\Book\Book;
use Dvaqueiro\Domain\Model\Book\BookRepository;

/**
 * @author dvaqueiro
 */
class InMemoryBookRepository implements BookRepository
{
    /**
     * @var Book[]
     */
    private $books = array();


    public function add(Book $book)
    {
        $this->books[$book->isbn()->isbn()] = $book;
    }

    public function findAll(): array
    {
        return $this->books;
    }
}