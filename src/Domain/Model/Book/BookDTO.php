<?php
namespace Dvaqueiro\Domain\Model\Book;

/**
 * @author dvaqueiro
 */
class BookDTO
{
    public $isbn;
    public $title;
    public $year;

    function __construct($isbn, $title, $year)
    {
        $this->isbn = $isbn;
        $this->title = $title;
        $this->year = $year;
    }
}