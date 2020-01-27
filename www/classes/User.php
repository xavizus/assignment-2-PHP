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
    public function validate($rows)
    {
        $this->db->query('SELECT * FROM users WHERE (email, password) VALUES(:email, :password)');

        // Bind values
        $this->db->bind(':email', $rows['email']);
        $this->db->bind(':password', $rows['password']);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
