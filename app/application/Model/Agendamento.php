<?php

namespace SmartSolucoes\Model;

use SmartSolucoes\Core\Model;
use SmartSolucoes\Libs\Helper;

class Agendamento extends Model
{

    private $table = 'agendamento';


    public function update($id, ...$params)
    {
        
        $query = sprintf("UPDATE %s SET title = :title, , status = :status WHERE id = :id", $this->table);
        $query = $this->PDO()->prepare($query);
        $query->bindParam(':title', $params['title']);
        $query->bindParam(':status', $params['status']);
        $query->bindParam(':id', $id);

        return $query->execute();
    }

    public function findOne($id)
    {
        $sql = "SELECT title,start,end,status from" . $this->table;
        $sql .= "where id = :id";

        $query = $this->PDO()->prepare($sql);
        $query->execute([':id' => $id]);

        return $query->fetch();
    }

    public function store($params)
    {
        $sql = sprintf("INSERT INTO %s (title,start,end,status) VALUES (:title,:start,:end,:status)", $this->table);

        $query = $this->PDO()->prepare($sql);
        $query->bindParam(":title", $params['title']);
        $query->bindParam(":start", $params['start']);
        $query->bindParam(":end", $params['end']);
        $query->bindParam(":status", $params['status']);

        return $query->execute();
    }


    public function destroy($id)
    {
        $query = sprintf("DELETE FROM %s WHERE id = :id", $this->table);
        $query = $this->PDO()->prepare($query);

        $query->bindParam(':id', $id, );
        return $query->execute();
    }

    public function findAll()
    {
        $sql = sprintf("SELECT id, title,status,start,end from %s", $this->table);

        $query = $this->PDO()->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }



}