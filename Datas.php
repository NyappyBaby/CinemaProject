<?php
require_once 'Database.php';

class Datas {

    public static function getAll(){
        $stmt = "SELECT films.id, films.titre, films.date_sortie, films.synopsis, films.realisateur_id, CONCAT(people.nom, ' ', people.prenom) AS realisateur FROM films 
        JOIN people ON films.realisateur_id = people.id";
        $db = Database::getDB();

        $req = $db->query($stmt);
        $req->execute();
        $films = $req->fetchAll(PDO::FETCH_OBJ);
       

        foreach($films as $film){
            $film->actors = self::actors($film->id);
        }

        return $films; 

       
    }


    private static function actors($id){
        $stmt = "SELECT people.nom, people.prenom, play.personnage 
        FROM films JOIN play ON films.id = play.films_id 
        JOIN people ON play.people_id = people.id 
        WHERE films.id = $id";

        $db = Database::getDB();

        $req = $db->query($stmt);
        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getGenre(){
        $stmt='SELECT genre.name FROM genre';

        $db = Database::getDB();

        $req = $db->query($stmt);
        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getFilmsByGenres(){
        $stmt = "SELECT films.id FROM films
        JOIN genre_assoc ON films.id = genre_assoc.films_id 
        JOIN genre ON genre_assoc.genre_id = genre.id 
        WHERE genre_assoc.genre_id IN (genre.id)";

        
        
        $db = Database::getDB();

        $req = $db->query($stmt);
        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

  
}
