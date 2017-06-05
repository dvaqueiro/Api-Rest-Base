<?php

namespace Dvaqueiro\Domain\Model\Book;

/**
 * @author dvaqueiro
 */
class Book
{
    private $isbn;
    private $title;
    private $year;

    function __construct($isbn, $title, $year)
    {
        $this->isbn = $isbn;
        $this->title = $title;
        $this->year = $year;
    }

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

    function setYear($year)
    {
        $this->year = $year;
    }
}