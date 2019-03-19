<?php
  // Déclaration d'une nouvelle classe
  class ConnexionDB {

    private $pdo;

    public function getPDO()
    {
      if($this->pdo === null){
      $this->pdo = new \PDO('mysql:host=localhost;dbname=monjob', 'root', '');
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      
      return $this->pdo;
    }

    public function query($statement)
    {
      $req = $this->getPDO()->query($statement);
      if(strpos($statement, 'INSERT') === 0 ||
      strpos($statement, 'DELETE') === 0 ||
      strpos($statement, 'UPDATE') === 0 
      ){
        return $req;
      }
      return $req->fetchAll(PDO::FETCH_OBJ);
    }

    public function prepare($statement)
    {
      $req = $this->getPDO()->prepare($statement);
      $req->execute($params);
      if(strpos($statement, 'INSERT') === 0 ||
      strpos($statement, 'DELETE') === 0 ||
      strpos($statement, 'UPDATE') === 0 
      ){
        return $req;
      }
      return $req->fetchAll(PDO::FETCH_OBJ);
    }

    public function find($id)
    {
      return $this->query('SELECT * FROM membres WHERE membreId='.$id);
    }
    

}
