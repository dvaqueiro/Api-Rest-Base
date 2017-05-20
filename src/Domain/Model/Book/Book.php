<?php

namespace dvaqueiro\Domain\Model\Book;

/**
 * @author dvaqueiro
 */
class Book
{
    private $isbn;
    private $title;
    private $year;

    function __construct(Isbn $isbn, $title, $year)
    {
        $this->isbn = $isbn;
        $this->title = $title;
        $this->year = $year;
    }

    /**
     *
     * @return Isbn
     */
    function isbn()
    {
        return $this->isbn;
    }

    function title()
    {
        return $this->title;
    }

    function year()
    {
        return $this->year;
    }
}