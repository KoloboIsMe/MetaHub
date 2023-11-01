<?php
///////////////////////////////////////////////////////////////////////////////
//////////////////////////////  USER TABLE  /////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The 'User' table singleton.
/// TO DO : Apply parameters verification to methods.
namespace Framework\Database\Table;

class UserTable
{
    use Requests;
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
    public function isUser($username, $password)
    {
        $statement = $this->dataAccess->prepare('SELECT password FROM users where username = :username LIMIT 100');
        if(!$statement->execute([
            ':username' => $username,
        ])){
            echo "erreur requete (exception)";
            return null;
        }
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if(isset($user['password']) && password_verify($password, $user['password']))
            return true;
        else
            return false;
    }
    public function register($username, $password, $date){
        $statement = $this->dataAccess->prepare('SELECT username FROM users where username = :username LIMIT 100');
        if(!$statement->execute([
            ':username' => $username,
        ])){
            echo "erreur requete (exception)";
        }
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if(isset($user['username']))
            return 'nom d\'utilisateur déjà utilisé';
        else{
            $statement = $this->dataAccess->prepare('INSERT INTO users (username, password, first_connexion) VALUES (:username, :password, :date)');
            if(!$statement->execute([
                ':username' => $username,
                ':password' => password_hash($password, PASSWORD_DEFAULT),
                ':date' => $date,

            ])){
                echo "erreur requete (exception)";
            }
            return null;
        }
    }
}