<?php

namespace dvaqueiro\Domain\Model\Book;

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