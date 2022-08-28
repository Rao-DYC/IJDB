<?php

namespace Ninja;

class DatabaseTable
{
    public function __construct(private \PDO $pdo, private string $table, private string $primary_key)
    {
    }

    public function getAllJokes()
    {
        $query = 'SELECT j.*, a.name,a.email FROM joke AS j INNER JOIN authors AS a ON(a.id = j.authorid)';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function total()
    {
        $query = 'SELECT COUNT(' . $this->primary_key . ') FROM ' . $this->table;

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

        $totalJokes = $stmt->fetch();
        return $totalJokes[0];
    }

    private function add($data)
    {
        $fields = $values = [];
        foreach ($data as $key => $value) {
            $fields[] = $key;
            $values[] = ':' . $key;
        }
        $query = 'INSERT INTO ' . $this->table . ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $values) . ')';

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($data);
        return $this->pdo->lastInsertId();
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM ' . $this->table . ' WHERE ' . $this->primary_key . ' = :primarykey');
        $stmt->bindValue(':primarykey', $id);
        $stmt->execute();
    }

    private  function update($data)
    {
        $query = 'UPDATE ' . $this->table . ' SET ';
        $update_fields = [];
        foreach ($data as $key => $value) {
            $update_fields[] = '`' . $key . '` = :' . $key;
            $data[$key] = trim($value);
        }
        $query .= implode(', ', $update_fields);
        $query .= ' WHERE ' . $this->primary_key . ' = :primarykey';
        $data['primarykey'] = $data[$this->primary_key];

        $stmt = $this->pdo->prepare($query);
        if ($stmt->execute($data)) {
            return true;
        }
        return false;
    }

    public function find($field, $value)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $field . ' = :value');
        $values = [
            ':value' => $value
        ];
        $stmt->execute($values);
        $data = $stmt->fetchAll();
        return $data;
    }

    public function save($data)
    {
        try {
            if (empty($data[$this->primary_key])) {
                unset($data[$this->primary_key]);
            }
            return $this->add($data);
        } catch (\Exception $e) {
            return $this->update($data);
        }
    }

    public function findAll()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
