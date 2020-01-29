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

    public function validate($data)
    {
        $this->db->query('SELECT password, username FROM users WHERE email = :email');
        // Bind values
        $this->db->bind(':email', $data['email']);
        // Execute
        $result = $this->db->single();
        // error_log(json_encode($result));
        if (password_verify($data['password'], $result->password))
        {
            return $result;
        } else {
            return false;
        }
    }
}
