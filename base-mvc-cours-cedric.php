<?php

// src/Controller/ArticlesListController.php

class ArticlesListController
{
    public function execute($select)
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
}

// src/Model/Article.php

class Article
{
    private string $title;
    private DateTime $createdAt;

    public static function createFromSqlRow(array $row): self
    {
        $article = new self();
        $article->title = $row['title'];
        $article->createdAt = DateTime::createFromFormat('Y-m-d H:i:s', $row['created_at']);

        return $article;
    }

    Article::createFromSqlRow($row);

    /**
     * @return Article[]
     */
    public static function getList(int $page = 1): array
    {
        // $sql = ......
        $articles = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $articles[] = Article::createFromSqlRow($row);
        }

        return $articles;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getAge(): int
    {
        $diff = $this->getCreatedAt()->diff(new DateTime());

        return $diff->days;
    }

}



// src/View/ArticlesListView.php

class ArticlesListView
{
    public function render(array $articles)
    {
        include "articles.html.php";
    }
}

// articles.html.php
include "header.php";
?>
<div>
    <?php foreach ($articles as $article): ?>
        <h1><?php echo $article->getCreatedAt(); ?></h1>
    <?php endforeach; ?>
</div>

<?php

// src/Security/Security.php
class Security
{
    public function isGranted(string $role): bool
    {
        return false;
    }
}


// public/login.php
$security = new Security();
if ($security->isLoggedIn()) {
    header('Location: index.php');
    return;
}

// public/articles.php

$security = new Security();
if (!$security->isGranted('USER')) {
    return $security->redirectToLogin();
}

(new ArticlesListController())->execute();