<?php

namespace Framework\Database\Table;

class CategorizedTable implements Table
{
    public function __construct(private $dataAccess)
    {

    }
}