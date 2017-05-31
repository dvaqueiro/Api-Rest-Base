<?php

namespace Dvaqueiro\Domain\Model\Book;

/**
 * @author dvaqueiro
 */
class Isbn
{
    private $isbn;

    function __construct($isbn)
    {
        $this->setIsbn($isbn);
    }

    private function setIsbn($isbn)
    {
        $this->validate($isbn);
        $this->isbn = $isbn;
    }

    /**
     * @todo falta validar el isbn o lanzar una excepción cuando no es correcto
     */
    private function validate($isbn)
    {
    }

    public function equalsTo(Isbn $isbn)
    {
        return $this->isbn() == $isbn->isbn();
    }

    public function isbn()
    {
        return $this->isbn;
    }
}