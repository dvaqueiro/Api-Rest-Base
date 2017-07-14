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
        $this->books[$book->isbn()] = $book;
    }

    public function findAll(): array
    {
        return $this->books;
    }

    public function findById($id)
    {
        $out = null;
        if(array_key_exists($key, $this->books)){
            $out = $this->books[$id];
        }
        
        return $out;
    }

    public function update($book)
    {
        $this->add($book);
    }
}