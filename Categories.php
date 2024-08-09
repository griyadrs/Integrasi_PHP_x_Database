<?php

require "Database.php";

class Category extends Database
{
    private string $table = 'categories';

    // Select data
    public function findAll(): array
    {
        $sql    = "SELECT * FROM {$this->table}";
        $result = $this->connection()->query($sql);

        if ($result->num_rows > 0) {
            $categories = [];

            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }

            return $categories;
        }

        return [];
    }

    // Add data 
    public function insert()
    {
        $sql  = "INSERT INTO {$this->table} (name) VALUES (?)";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bind_param("s", $_POST['name']);
        $stmt->execute();
    }

    // Update data
    public function update(int $id)
    {
        $sql  = "UPDATE {$this->table} SET name = (?) WHERE id = (?)";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bind_param("si", $_POST['name'], $id);
        $stmt->execute();
    }

    // Delete data
    public function delete(int $id)
    {
        $sql  = "DELETE FROM {$this->table} WHERE id = (?)";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    // Categories.php
    public function findById(int $id)
    {
        $sql  = "SELECT * FROM {$this->table} WHERE id = (?)";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }
}
