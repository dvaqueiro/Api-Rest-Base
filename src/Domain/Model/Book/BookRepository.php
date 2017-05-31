<?php

namespace Dvaqueiro\Domain\Model\Book;

/**
 * @author dvaqueiro
 */
interface BookRepository
{
    /**
     * @return array
     */
    public function findAll();
}