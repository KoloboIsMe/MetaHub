<?php
///////////////////////////////////////////////////////////////////////////////
////////////////////////////////  DATABASE  ///////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The database abstract class. Extended by every tables within it.
/// Used to factorize common methods and attributes for a more minimalist code.

namespace Framework\Database\Table;

abstract class Database
{
    protected string $limit = '100';
    public function __construct(protected readonly Connexion $connexion)
    {

    }
}