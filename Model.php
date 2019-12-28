<?php

class Model
{
    private $db;
    private $env;

    public function __construct()
    {
        $env = parse_ini_file("app.ini");
        $this->env = $env;
        $this->db = new PDO("mysql:host={$env['DB_HOST']};dbname={$env['DB_NAME']}",
                      $env['DB_USER_NAME'], $env['DB_USER_PASSWORD']);
    }

    public function save($data)
    {
        try
        {
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== add this line
            $sql = "INSERT INTO enregistrement(prenom, nom, date_naissance, sexe, quartier)
                    VALUES (:prenom, :nom, :date_naissance, :sexe, :quartier)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':prenom', $data['prenom']);
            $stmt->bindParam(':nom', $data['nom']);
            $stmt->bindParam(':date_naissance', $data['date_naissance']);
            $stmt->bindParam(':sexe', $data['sexe']);
            $stmt->bindParam(':quartier', $data['quartier']);

            $stmt->execute();

            return [
                'status' => 'OK',
                'message' => 'Enregistrement OK'
            ];
        }
        catch(\PDOException $ex)
        {
            return [
                'status' => 'NOK',
                'message' => "Erreur lors de l'enregistrement"
            ];
        }
    }

    public function getQuartiers()
    {
        if($this->env['QUARTIERS_SOURCE'] == 'file')
        {
            return $this->getQuartiersFromFile();
        }
        else
        {
            return $this->getQuartiersFromDatabase();
        }
    }

    private function getQuartiersFromDatabase()
    {
        try
        {
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== add this line
            $quartiersTable = $this->env['QUARTIERS_TABLE'];
            $quartiersColumnName = $this->env['QUARTIERS_COLUMN_NAME'];

            $sql = "SELECT * FROM $quartiersTable";
            $stmt = $this->db->query($sql);

            $quartiers = [];

            while ($row = $stmt->fetch()) 
            {
                $quartiers[] = $row[$quartiersColumnName];
            }

            return $quartiers;
        }
        catch(\PDOException $ex)
        {
            return [
                
            ];
        }

    }

    private function getQuartiersFromFile()
    {
        $file = fopen($this->env['QUARTIERS_FILE'],"r");

        $quartiers = [];
        while(! feof($file))
        {
         $quartiers[] = fgets($file). "<br />";
        }

        fclose($file);

        return $quartiers;
    }
    
}