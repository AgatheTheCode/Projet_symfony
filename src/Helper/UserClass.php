<?php

namespace App\Helper;

class UserClass
{
    private $id;
    private $username;
    private $password;
    private $email;

    public function __construct($id, $username, $password, $email)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->setPassword($password);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        // Encodage du mot de passe en utilisant l'algorithme bcrypt
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function verifyPassword($password)
    {
        // Vérification du mot de passe encodé en utilisant la fonction password_verify
        return password_verify($password, $this->password);
    }
}
