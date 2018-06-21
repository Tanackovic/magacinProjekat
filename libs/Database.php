<?php

class Database extends PDO
{
    function __construct() {
        parent::__construct(DBTYPE . ':host='. DBHOST . ';dbname=' . DBNAME  , DBUSER , DBPASS );
    }
    
    function beginTransaction() {
        parent::beginTransaction();
    }
    
    function commit() {
        parent::commit();
    }
    
    function rollBack() {
        parent::rollBack();
    }
    
}
