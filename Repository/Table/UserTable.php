<?php
///////////////////////////////////////////////////////////////////////////////
//////////////////////////////  USER TABLE  /////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The 'User' table singleton.
/// TO DO : Apply parameters verification to methods.
namespace Framework\Database\Table;

class UserTable
{
    use BasicTable;
    use IdentifiedTable;
    const TABLE = 'user';
    private function newEntity(array $data) : \User
    {
        $ID = $data[0];
        $passsword = $data[1];
        $username = $data[2];
        $first_connexion = $data[3];
        $last_connexion = $data[4];
        return new Category($ID, $passsword, $username, $first_connexion, $last_connexion);
    }
    public function isUser($username, $password) : bool
    {
        $request = "SELECT $password FROM users where $username = :username LIMIT $this->limit";
        if($response = $this->execute($request) === FALSE){
            return FALSE;
        }
        $user = $response->fetch(PDO::FETCH_ASSOC);

        if(isset($user['password']) && password_verify($password, $user['password']))
            return TRUE;
        else
            return FALSE;
    }
    public function register(string $username, string $password) : bool
    {
        if($this->exists($username, 'username'))
        {
            return FALSE;
        }
        $newUser = User::register($username, $password);
        if ($this->insert($newUser) === FALSE)
        {
            return FALSE;
        }
        return TRUE;
    }
}