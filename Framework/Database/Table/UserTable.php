<?php
///////////////////////////////////////////////////////////////////////////////
//////////////////////////////  USER TABLE  /////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The 'User' table singleton.
/// TO DO : Apply parameters verification to methods.
namespace Framework\Database\Table;

class UserTable extends Database implements Table
{
    use IdentifiedTable;
    const TABLE = 'User';
    private function newEntity(array $data) : \User
    {
        $ID = $data[0];
        $passsword = $data[1];
        $username = $data[2];
        $first_connexion = $data[3];
        $last_connexion = $data[4];
        return new Category($ID, $passsword, $username, $first_connexion, $last_connexion);
    }
}