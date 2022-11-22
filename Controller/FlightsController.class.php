<?php
// src/Controller/ArticlesListController.php

class FlightsController
{
    public function getList()
    {
        // Appeler la base pour recuperer les articles
            // -> en fonction du $_GET['page']
            // $length = 20;
            // $start = ($_GET['page'] - 1) * $length;
            // SELECT * FROM articles LIMIT $start, $length
            $articles = Article::getList($_GET['page'] ?? 1);

        // Passer les articles au template
        // Envoyer le collage à l'user echo
        (new ArticlesListView)->render($articles);
    }

    public static function add()
    {
        include('add-flight.html.php');
    }

    public static function addSuccess()
    {
        
    }
}
