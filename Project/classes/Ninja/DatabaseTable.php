<?php

namespace Ninja;

Class DatabaseTable{

// Declaration of Variables

private $pdo;
private $table;
private $primarykey;

public function __construct(\PDO $pdo, STRING $table, STRING $primarykey){

    $this->pdo = $pdo;
    $this->table = $table;
    $this->primarykey=$primarykey;

}


private function query($sql, $parameters=[]){
        $query = $this->pdo->prepare($sql);
    
        foreach($parameters as $name => $value){
            $query -> bindValue($name, $value);
        }
        $query->execute();
        return $query;
    
    }

public function findAll(){
    $result = $this->query('SELECT * FROM '.$this->table);
    return $result->fetchAll();
}


public function total() {
    $query = $this->query('SELECT COUNT(*) FROM `' . $this->table . '`');
    $row = $query->fetch();
    return $row[0];
}


public function deleteAuthor($id) {
    $parameters = [':id' => $id];
    $this->query($this->pdo, 'DELETE FROM `author`
    WHERE `id` = :id', $parameters);
    }

        


public function findById($value){

    $query = 'SELECT * FROM `'.$this->table.'`
    WHERE `'.$this->primarykey.'` = :value';

    $parameters = [':value' => $value];

    $query = $this->query($query, $parameters);
    return $query->fetch();

}

public function find($column, $value) {
    $query = 'SELECT * FROM ' . $this->table . ' WHERE ' .
    $column . ' = :value';
    $parameters = [
    'value' => $value
    ];
    $query = $this->query($query, $parameters);
    return $query->fetchAll();
    }



public function delete($id){
    $parameters = [':id' => $id];

    $this->query('DELETE FROM `'. $this->table .'` WHERE `'.$this->primarykey.'` = :id', $parameters);
}




private function processDate($fields){
    foreach($fields as $key => $value){
        if($value instanceof \DateTime){
            $fields[$key] = $value->format('Y-m-d');
        }
    }

    return $fields;

}


private function insert( $fields) {
    $query = 'INSERT INTO `' . $this->table . '` (';
foreach ($fields as $key => $value) {
    $query .= '`' . $key . '`,';
    }
    $query = rtrim($query, ',');
    $query .= ') VALUES (';
    foreach ($fields as $key => $value) {
    $query .= ':' . $key . ',';
    }
    $query = rtrim($query, ',');
    $query .= ')';
    $fields = $this->processDate($fields);
    $this->query( $query, $fields);
    }
    


private function update( $fields){

    $query = 'UPDATE `'.$this->table.'` SET';

    foreach($fields as $key => $value){
        $query .= '`' .$key . '`= :' .$key . ',';
    }

    $query = rtrim($query, ',');

    $query .= ' WHERE `'.$this->primarykey.'` = :primaryKey ';

    $fields = $this->processDate($fields);

    // Set the :primaryKey variable
    $fields['primaryKey'] = $fields['id'];

    $this->query($query, $fields);

}


public function save( $record){
    try{
        if($record[$this->primarykey] == ''){
            $record[$this->primarykey] = null;

        }

        $this->insert($record);
     }
    catch(\PDOException $e){
        $this->update($record);

    }
}

}



