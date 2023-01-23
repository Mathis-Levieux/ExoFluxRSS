<?php

// logo pour $console
$playstation = "../assets/img/playstation.png";
$xbox = "../assets/img/xbox.png";
$switch = "../assets/img/switch.png";
$pc = "../assets/img/computer.png";
$mobile = "../assets/img/mobile.png";


function getRssArticles($rsslink) // Fonction qui prend en paramètre l'URL du flux RSS et qui retourne un tableau d'articles
{
    $rss = simplexml_load_file($rsslink); // On charge le flux RSS
    $articlesArray = []; // On crée un tableau vide
    foreach ($rss->channel->item as $item) { // On parcourt les articles du flux RSS et on les ajoute au tableau
        $articlesArray[] = [
            'title' => $item->title,
            'link' => $item->link,
            'description' => $item->description,
            'date' => $item->children('dc', true)->date,
            'image' => $item->enclosure['url'],
        ];
    }
    return $articlesArray; // On retourne le tableau d'articles
}

function sortArticlesByDate($console) // Fonction qui trie les articles par date et prend en paramètre l'image de la console
{

    $ps4Articles = (getRssArticles('https://www.jeuxactu.com/rss/ps4.rss')); // On récupère les articles de la PS4
    $ps5Articles = (getRssArticles('https://www.jeuxactu.com/rss/ps5.rss')); // On récupère les articles de la PS5
    $allArticles = array_merge($ps4Articles, $ps5Articles);
    usort($allArticles, function ($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });


    foreach ($allArticles as $article) {
        // récupérer la date <dc:date>
        $date = $article['date'];
        $date = date('d/m/Y', strtotime($date));
        // récupérer le premier mot de $item->title
        $first_word = explode(' ', $article['title'])[0];

        echo '
        <div class="card mb-3" data-bs-toggle="modal" data-bs-target="#' . $first_word . '">
            <img src="' . $article['image'] . '" class="card-img-top" alt="photo article">
            <div class="card-body">
                <h5 class="card-title text-light"><img src="" alt="logo">
                ' . $article['title'] . '
                </h5>
                <p class="card-text">
                    <small class="text-secondary">' . $date . '</small>
                </p>  
            </div>
        </div>

        <div class="modal fade" id="' . $first_word . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="' . $first_word . '"><img src="' . $console . '" alt="logo">' . $article['title'] . '</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              ' . $article['description'] . '
            </div>
            <div class="modal-footer">
              <button href="' . $article['link'] . '"type="button" class="btn btn-primary">en savoir plus</button>
            </div>
          </div>
        </div>
      </div>
         ';
    }
}







function getArticlesInArray()
{
    if (isset($_COOKIE[$_SESSION['user']['nickname'] . 'consolepref'])) {
        $allArticles = [];
        $console_preferences = json_decode($_COOKIE[$_SESSION['user']['nickname'] . 'consolepref']);
        if (in_array("PS4", $console_preferences)) {
            // Met dans un tableau les articles PS4 à partir du flux RSS
            $ps4Articles = getRssArticles('https://www.jeuxactu.com/rss/ps4.rss');
            $allArticles = array_merge($allArticles, $ps4Articles);
        }
        if (in_array("PS5", $console_preferences)) {
            // Met dans un tableau les articles PS5 à partir du flux RSS
            $ps5Articles = getRssArticles('https://www.jeuxactu.com/rss/ps5.rss');
            $allArticles = array_merge($allArticles, $ps5Articles);
        }
        if (in_array("XBOX", $console_preferences)) {
            // Afficher les articles XBOX à partir du flux RSS
            $xboxArticles = getRssArticles('https://www.jeuxactu.com/rss/xbox-series-x.rss');
            $allArticles = array_merge($allArticles, $xboxArticles);
        }
        if (in_array("PC", $console_preferences)) {
            // Afficher les articles PC à partir du flux RSS
            $pcArticles = getRssArticles('https://www.jeuxactu.com/rss/pc.rss');
            $allArticles = array_merge($allArticles, $pcArticles);
        }
        if (in_array("Mobile", $console_preferences)) {
            // Afficher les articles Mobile à partir du flux RSS
            $mobileArticles = getRssArticles('https://www.jeuxactu.com/rss/mobile.rss');
            $allArticles = array_merge($allArticles, $mobileArticles);
        }
        if (in_array("Switch", $console_preferences)) {
            // Afficher les articles Switch à partir du flux RSS
            $switchArticles = getRssArticles('https://www.jeuxactu.com/rss/switch.rss');
            $allArticles = array_merge($allArticles, $switchArticles);
        }
        // Supprime les doublons
        $allArticles = array_unique($allArticles, SORT_REGULAR);

        // Trier les articles par date
        usort($allArticles, function ($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });
        var_dump($allArticles);
        return $allArticles;
    } else {
        // showAllArticles();
    }
}

function displayAllArticles()
{
    $allArticles = getArticlesInArray();

    // foreach de $allarticles
    foreach ($allArticles as $article) {
        // récupérer la date <dc:date>
        $date = $article['date'];
        $date = date('d/m/Y', strtotime($date));
        // récupérer le premier mot de $item->title
        $first_word = explode(' ', $article['title'])[0];

        echo '
        <div class="card mb-3" data-bs-toggle="modal" data-bs-target="#' . $first_word . '">
            <img src="' . $article['image'] . '" class="card-img-top" alt="photo article">
            <div class="card-body">
                <h5 class="card-title text-light"><img src="" alt="logo">
                ' . $article['title'] . '
                </h5>
                <p class="card-text">
                    <small class="text-secondary">' . $date . '</small>
                </p>  
            </div>
        </div>

        <div class="modal fade" id="' . $first_word . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="' . $first_word . '"><img src="" alt="logo">' . $article['title'] . '</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              ' . $article['description'] . '
            </div>
            <div class="modal-footer">
              <button href="' . $article['link'] . '"type="button" class="btn btn-primary">en savoir plus</button>
            </div>
          </div>
        </div>
      </div>
         ';
    }
}
