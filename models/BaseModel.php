<?php

namespace Models;

class BaseModel {
	
    protected $table;
    protected $where;
    protected $columns;
    protected $limit;
    protected $dbconn;
	
    public function __construct( $args = array() ) {
        $args = array_merge( array(
            'where' => '',
            'columns' => '*',
            'limit' => 0
        ), $args );

        if (!isset($args['table'])) {
            die('Table not defined. Please define a model table.');
        }

        extract($args);

        $this->table = $table;
        $this->where = $where;
        $this->columns = $columns;
        $this->limit = $limit;

        $db = \Lib\Database::get_instance();
        $this->dbconn = $db::get_db();
    }

    public function get( $id ) {
        $results = $this->find( array( 'where' => 'id = ' .$id ) );

        return $results;
    }

    public function add($pairs,$tags) {
        // Get keys and values separately
        $keys = array_keys($pairs);
        $values = array();

        // Escape values, like prepared statement
        foreach($pairs as $key => $value) {
            $newKeys[] = $key;	
            $values[] = '"' . $value . '"';
        }

        $keys = implode($newKeys, ',');
        $values = implode($values, ',');

        $stmt = $this->dbconn->query("insert into " . $this->table . " (".$keys.") values(".$values.")");
        
        $postId = $this->dbconn->lastInsertId();
        
        if(is_array($tags) && $tags != null){
            foreach($tags as $tag){
                $stmt = $this->dbconn->prepare('INSERT INTO tagsposts (tagId,postId) VALUES (:tagId,:postId) ');
                $stmt->execute(array('tagId' => $tag, 'postId' => $postId));
            }
        }
        
        if($stmt->rowCount() > 0){
            return $postId;
        }
        return 0;
    }

    public function delete($id) {
        
        try {
            
            $stmt = $this->dbconn->prepare('DELETE FROM ' . $this->table . ' WHERE Id = :id AND userId = :userId');
            $stmt->execute(array('id' => $id, 'userId' => $_SESSION['userId']));
            
            $rowCount = $stmt->rowCount();
            
            if($this->table == 'posts'){
                $stmt = $this->dbconn->prepare('DELETE FROM tagsposts WHERE postId = :id');
                $stmt->execute(array('id' => $id));
            }
            
            return $rowCount;

        } catch(PDOException $e) {
            echo '<p>'.$e->getMessage().'</p>';
        }
        
        
    }

    public function update($model,$tags){
        $query = "UPDATE " . $this->table . " SET ";

        foreach($model as $key => $value) {
                if($key === 'id') continue;
                $query .= "$key = " . $this->dbconn->quote($value) . ","; 
        }
        $query = rtrim($query, ",");
        $query .= " WHERE id = " . $model['id'];

        $stmt = $this->dbconn->prepare($query);
        $stmt->execute();
        
        $postRowCount = $stmt->rowCount();
        
        $stmt = $this->dbconn->prepare("DELETE FROM tagsposts WHERE postId = :id");
        $stmt->execute(array('id' => $model['id']));
        
        $deleteTagsCount = $stmt->rowCount();
        
        $count = 0;
        if(is_array($tags) && $tags != null){
            foreach($tags as $tag){
                $stmt = $this->dbconn->prepare('INSERT INTO tagsposts (tagId,postId) VALUES (:tagId,:postId) ');
                $stmt->execute(array('tagId' => $tag, 'postId' => $model['id']));
                $count += $stmt->rowCount();
            }
        }
        
        return $postRowCount + $deleteTagsCount + $count;
    }

    public function find($args = array()){
        $args = array_merge( array(
            'table' => $this->table,
            'where' => '',
            'columns' => '*',
            'limit' => 0
        ), $args );

        extract($args);

        $query = "select {$columns} from {$table}";

        if(!empty($where)){
            $query .= ' where ' . $where;
        }

        if(!empty($limit)){
            $query .= ' limit ' . $limit;
        }
        
        $stmt = $this->dbconn->prepare($query);
        $stmt->execute();

        $results = $this->process_results($stmt);

        return $results;
    }

    protected function process_results($result_set){
        $results = array();

        if(!empty($result_set)) {
            while($row = $result_set->fetch(\PDO::FETCH_ASSOC)) {
                $results[] = $row;
            }
        }

        return $results;
    }
}