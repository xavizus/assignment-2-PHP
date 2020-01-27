<?php
namespace classes;

class User
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }
    public function register($data)
    {

        $this->db->query('INSERT INTO users (username, email, password) VALUES(:username, :email, :password)');

        // Bind values
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
