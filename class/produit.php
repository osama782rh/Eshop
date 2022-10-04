<?php 
class Produit{
    #attributs
    
    private $idProduit;
    private $libelle;
    private $description;
    private $prix;
    private $image;

    #propiètes
    public function getLibelle() {
        return $this->libelle;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getImage() {
        return $this->image;
    }

    public function setLibelle($libelle): void {
        $this->libelle = $libelle;
    }

    public function setDescription($description): void {
        $this->description = $description;
    }

    public function setPrix($prix): void {
        $this->prix = $prix;
    }

    public function setImage($image): void {
        $this->image = $image;
    }
    #constructeur

    #méthodes
    public static function fetchAll() {
        $collectionProduit = array();
        $dba = new DBA();
        $pdo = $dba->getPDO();
        $pdoStatement = $pdo->query(Produit::$select);
        $recordSet = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($recordSet as $record) {
        $collectionProduit[] = Produit::arrayToProduit($record);
        }
        return $collectionProduit;
    }
    public static function fetch($idProduit) {
        $produit = null ;
        $dba = new DBA();
        $pdo = $dba->getPDO();
        $pdoStatement = $pdo->prepare(Produit::$selectById);
        $pdoStatement->bindParam(":idProduit", $idProduit);
        $pdoStatement->execute();
        $record = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        if($record==false){
        $produit = Produit::arrayToProduit($record);
        }
        return $produit;
    }
    public function save() {
        if ($this->idProduit == null) {
            $this->insert();
        } else {
            $this->update();
        }
    }
    private function insert(){
        $dba = new DBA();
        $pdo = $dba->getPDO();
        $pdoStatement = $pdo->prepare(Produit::$insert);
        $pdoStatement->bindParam(":libelle", $this->libelle);
        $pdoStatement->bindParam(":description",$this->description);
        $pdoStatement->bindParam(":image", $this->image);
        $pdoStatement->bindParam(":prix", $this->prix);
        $pdoStatement->execute();
        $this->idProduit = $pdo->lastInsertId(); 
    }
    private function update() {
        $dba = new DBA();
        $pdo = $dba->getPDO();
        $pdoStatement = $pdo->prepare(Produit::$update);
        $pdoStatement->bindParam(":idProduit", $this->idProduit);
        $pdoStatement->bindParam(":libelle", $this->libelle);
        $pdoStatement->bindParam(":description",$this->description);
        $pdoStatement->bindParam(":image", $this->image);
        $pdoStatement->bindParam(":prix", $this->prix);
        $pdoStatement->execute();
    }   
    public function delete() {
        $dba = new DBA();
        $pdo = $dba->getPDO();
        $pdoStatement = $pdo->prepare(Produit::$delete);
        $pdoStatement->bindParam("idProduit", $this->idProduit);
        $resultat = $pdoStatement->execute();
        $nblignesAffectees = $pdoStatement->rowCount();
        if ($nblignesAffectees == 1) {
        $this->idProduit = null;
        }
        return $resultat;
    }
    
       

