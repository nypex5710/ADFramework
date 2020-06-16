<?php

class ADDatabase extends PDO
{

    public function __construct($dsn, $user, $password)
    {
        parent::__construct($dsn, $user, $password);
        $this->query("SET NAMES 'utf8'");
        $this->query("SET CHARACTER SET 'utf8'");
    }

    /**
     * PDO select function
     * PDO tabloda veri arama işlemi
     */
    public function select($sq $array = array(), $fetchMode = PDO::FETCH_ASSOC)
    {
        $sth = $this->prepare($sql);
        foreach($array as $key => $value){
            $sth->bindValue($key, $value);
        }
        $sth->execute();
        return $sth->fetchAll($fetchMode); 
    }

    /**
     * PDO rowCount function
     * PDO tablodaki verileri bulma
     */
    public function affectedRows($sql, $array = array())
    {
        $sth = $this->prepare($sql);
        foreach($array as $key => $value){
            $sth->bindValue($key, $value);
        }
        $sth->execute();
        return $sth->rowCount();
    }

    /**
     * PDO insert function
     * PDO tabloya veri ekleme
     */
    public function insert($tableName, $data)
    {
        $fieldKeys = implode(",", array_keys($data));
        $fieldValues = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO $tableName($fieldKeys) VALUES ($fieldValues)";
        $sth = $this->prepare($sql);
        foreach($data as $key => $value){
            $sth->bindValue(":$key", $value);
        }
        return $sth->execute();
    }

    /**
     * PDO update function
     * PDO tabloda veriyi güncelleme
     */
    public function update($tableName, $data, $where)
    {
        $updateKeys = "";
        foreach($data as $key => $value){
            $updateKeys .= "$key=:$key,";
        }
        $updateKeys = rtrim($updateKeys, ",");
        echo $updateKeys;
        $sql = "UPDATE $tableName SET $updateKeys WHERE $where";
        $sth = $this->prepare($sql);
        foreach($data as $key => $value){
            $sth->bindValue(":$key", $value);
        }
        return $sth->execute();
    }

    /**
     * PDO delete function
     * PDO tablodaki veriyi silme
     */
    public function delete($tableName, $where, $limit = 1){
        return $this->exec("DELETE FROM $tableName WHERE $where limit $limit");
    }
}

?>