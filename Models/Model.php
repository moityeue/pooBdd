<?php

namespace App\Models;

use App\Db\Db;

//Prépares toutes les interactions avec la BDD
class Model extends Db
{
    //Table de la base de donnée
    protected $table;

    //Instance de Db
    private $Db;

     public function findAll( array $attributs = null)
     {
          $query = $this->query('SELECT * FROM '. $this->table);
          $query->execute($attributs);
          return $query->fetchAll();
     }

     public function findBy(array $criteres)
     {
          $champs = [];
          $valeurs = [];

          //Faire une boucle pour récupérer le tableau
          foreach($criteres as $champ =>$valeur){
               //SELECT * FROM annoces WHERE actif = ?
               //bindValue(1, valeur)

               $champs[] = "$champ = ?";
               $valeurs[] = "$valeur";
          }

          // On transforme le tableau "champs" en une chaine de caractere
          $liste_champs = implode(' AND ', $champs);
         
          //On execute la requete 
          return $this->query('SELECT * FROM ' .$this->table.' WHERE'. $liste_champs, $valeurs)->fetchAll();
     }


    public function query(string $sql, array $attributs = null)
    {
       //On récupère l'instance de DB
       $this->db = Db::getInstance();
       
       //On vérifie si on a des attributs
       if($attributs !== null){
            //requete attributs
            $query = $this->db->query($sql);
            return $query;
       }else{
            //Requete simple
            return $this->db->query($sql);
       }
    }
}