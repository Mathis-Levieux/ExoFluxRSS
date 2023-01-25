<?php


// logo pour $console
$playstation = "../assets/img/playstation.png";
$xbox = "../assets/img/xbox.png";
$switch = "../assets/img/switch.png";
$pc = "../assets/img/computer.png";
$mobile = "../assets/img/mobile.png";

function getRssArticles($rsslink, $console) // Fonction qui prend en paramètre l'URL du flux RSS et qui retourne un tableau d'articles
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
            'console' => $console,
        ];
    }
    return $articlesArray; // On retourne le tableau d'articles
}



function getArticlesInArray()
{
    $allArticles = [];
    if (isset($_SESSION['user'])) { // Si l'utilisateur est connecté, on récupère ses préférences de consoles
        if (isset($_COOKIE[$_SESSION['user']['nickname'] . 'consolepref'])) { // Si le cookie existe, on récupère les préférences de l'utilisateur
            $console_preferences = json_decode($_COOKIE[$_SESSION['user']['nickname'] . 'consolepref']); // On décode le cookie

            if (in_array("ps4", $console_preferences)) { // Si une console est cochée dans les préférences, on récupère les articles de cette console
                $ps4Articles = getRssArticles('https://www.jeuxactu.com/rss/ps4.rss', 'playstation');
                $allArticles = array_merge($allArticles, $ps4Articles);
            }
            if (in_array("ps5", $console_preferences)) {
                $ps5Articles = getRssArticles('https://www.jeuxactu.com/rss/ps5.rss', 'playstation');
                $allArticles = array_merge($allArticles, $ps5Articles);
            }
            if (in_array("xbox", $console_preferences)) {
                $xboxArticles = getRssArticles('https://www.jeuxactu.com/rss/xbox-series-x.rss', 'xbox');
                $allArticles = array_merge($allArticles, $xboxArticles);
            }
            if (in_array("pc", $console_preferences)) {
                $pcArticles = getRssArticles('https://www.jeuxactu.com/rss/pc.rss', 'pc');
                $allArticles = array_merge($allArticles, $pcArticles);
            }
            if (in_array("mobile", $console_preferences)) {
                $mobileArticles = getRssArticles('https://www.jeuxactu.com/rss/mobile.rss', 'mobile');
                $allArticles = array_merge($allArticles, $mobileArticles);
            }
            if (in_array("switch", $console_preferences)) {
                $switchArticles = getRssArticles('https://www.jeuxactu.com/rss/switch.rss', 'switch');
                $allArticles = array_merge($allArticles, $switchArticles);
            }

            // Trie les articles par date
            usort($allArticles, function ($a, $b) {
                return strtotime($b['date']) - strtotime($a['date']);
            });
            return $allArticles; // Retourne le tableau d'articles trié
        } else {
            $ps5Articles = getRssArticles('https://www.jeuxactu.com/rss/ps5.rss', 'playstation');
            $xboxArticles = getRssArticles('https://www.jeuxactu.com/rss/xbox-series-x.rss', 'xbox');
            $switchArticles = getRssArticles('https://www.jeuxactu.com/rss/switch.rss', 'switch');
            $allArticles = array_merge($allArticles, $ps5Articles, $xboxArticles, $switchArticles);
            usort($allArticles, function ($a, $b) { // Trie les articles par date
                return strtotime($b['date']) - strtotime($a['date']);
            });
            return $allArticles; // Retourne le tableau d'articles trié
        }
    } else { // Si l'utilisateur n'est pas connecté, on récupère tous les articles
        $ps5Articles = getRssArticles('https://www.jeuxactu.com/rss/ps5.rss', 'playstation');
        $xboxArticles = getRssArticles('https://www.jeuxactu.com/rss/xbox-series-x.rss', 'xbox');
        $switchArticles = getRssArticles('https://www.jeuxactu.com/rss/switch.rss', 'switch');
        $allArticles = array_merge($allArticles, $ps5Articles, $xboxArticles, $switchArticles);
        usort($allArticles, function ($a, $b) { // Trie les articles par date
            return strtotime($b['date']) - strtotime($a['date']);
        });
        return $allArticles; // Retourne le tableau d'articles trié
    }
}

function displayPreferencesArticles()
{
    $allArticles = getArticlesInArray();
    $allArticles = deleteDuplicate($allArticles);
    $allArticles = array_slice($allArticles, 0, getUserNbArticleCookie()); // Récupère les articles dans un tableau et supprime les articles en trop
    // foreach de $allarticles
    foreach ($allArticles as $article) {

        // récupérer la date <dc:date>
        $date = $article['date'];
        $date = date('d/m/Y', strtotime($date));

        // récupérer le premier mot de $item->title (id de la modal)
        $first_word = explode(' ', $article['title'])[0];

        // diviser le title en Title et subtitle
        $Title = explode(':', $article['title'])[0];
        @$subtitle = explode(':', $article['title'])[1];

        // Récupèrer l'image de la console
        $console = $article['console'];
        $consoleimage = "assets/img/$console.png";
        displayCarousel(getFirst5InArray($allArticles), $consoleimage); // Affiche le carousel

        echo '
        <div class="card mb-3" data-bs-toggle="modal" data-bs-target="#' . $first_word . '">
            <img src="' . $article['image'] . '" class="card-img-top" alt="photo article">
            <div class="card-body">
                <h5 class="card-title text-light mb-0"><img src="' . $consoleimage . '" alt="logo">
                ' . $Title . '
                </h5>
                <p class="card-text text-light mb-0">
                    ' . $subtitle . '
                </p>
                <p class="card-text text-end">
                    <small class="text-info">' . $date . '</small>
                </p>  
            </div>
        </div>

        <div class="modal fade" id="' . $first_word . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="' . $first_word . '"><img src="' . $consoleimage . '" alt="logo">' . $Title . '</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
            <img class="img-fluid " src="' . $article['image'] . '" alt="photo article">
            <h5 class="p-2"> ' . $subtitle . '</h5>
            <p class="p-2">' . $article['description'] . '</p>
            </div>
            <div class="modal-footer">
              <a href="' . $article['link'] . '" type="button" class="btn btn-primary">en savoir plus</a>
            </div>
          </div>
        </div>
      </div>
         ';
    }
}



function getUserNbArticleCookie()
{
    if (isset($_SESSION['user']['nickname'])) {
        if (isset($_COOKIE[$_SESSION['user']['nickname'] . 'nbarticles'])) {
            return $_COOKIE[$_SESSION['user']['nickname'] . 'nbarticles'];;
        } else {
            return 12;
        }
    } else {
        return 12;
    }
}


function deleteDuplicate($array)
{
    $titles = array();
    foreach ($array as $key => $value) {
        $titles[] = $value['title'];
    }
    $titles = array_unique($titles);

    foreach ($array as $key => $value) {
        if (!in_array($value['title'], $titles)) {
            unset($array[$key]);
        }
    }
    return $array;
}

function displayOnlyOnePage($console, $imgconsole)
{
    $consoleArticles = getRssArticles('https://www.jeuxactu.com/rss/' . $console . '.rss', $imgconsole);
    $consoleArticles = deleteDuplicate($consoleArticles);
    $consoleArticles = array_slice($consoleArticles, 0, getUserNbArticleCookie()); // Récupère les articles dans un tableau et supprime les articles en trop
    // Trie les articles par date
    usort($consoleArticles, function ($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });
    displayCarousel(getFirst5InArray($consoleArticles), $imgconsole); // Affiche le carousel
    foreach ($consoleArticles as $article) {

        // récupérer la date <dc:date>
        $date = $article['date'];
        $date = date('d/m/Y', strtotime($date));

        // récupérer le premier mot de $item->title (id de la modal)
        $first_word = explode(' ', $article['title'])[0];

        // diviser le title en Title et subtitle
        $Title = explode(':', $article['title'])[0];
        @$subtitle = explode(':', $article['title'])[1];

        // Récupèrer l'image de la console
        $console = $article['console'];
        $consoleimage = "assets/img/$console.png";
        echo '
        <div class="card mb-3" data-bs-toggle="modal" data-bs-target="#' . $first_word . '">
            <img src="' . $article['image'] . '" class="card-img-top" alt="photo article">
            <div class="card-body">
                <h5 class="card-title text-light"><img src="' . $consoleimage . '" alt="logo">
                ' . $Title . '
                </h5>
                <p class="card-text text-light">
                    ' . $subtitle . '
                </p>
                <p class="card-text text-end">
                    <small class="text-info">' . $date . '</small>
                </p>  
            </div>
        </div>

        <div class="modal fade" id="' . $first_word . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="' . $first_word . '"><img src="' . $consoleimage . '" alt="logo">' . $Title . '</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
            <img class="img-fluid " src="' . $article['image'] . '" alt="photo article">
            <h5 class="p-2"> ' . $subtitle . '</h5>
            <p class="p-2">' . $article['description'] . '</p>
            </div>
            <div class="modal-footer">
              <a href="' . $article['link'] . '" type="button" class="btn btn-primary">en savoir plus</a>
            </div>
          </div>
        </div>
      </div>
         ';
    }
}

function getUserPage() // Affiche la page demandée par l'utilisateur
{
    if (isset($_GET['ps4'])) {
        displayOnlyOnePage("ps4", "playstation");
    } else if (isset($_GET['ps5'])) {
        displayOnlyOnePage("ps5", "playstation");
    } else if (isset($_GET['switch'])) {
        displayOnlyOnePage("switch", "switch");
    } else if (isset($_GET['mobile'])) {
        displayOnlyOnePage("mobile", "mobile");
    } else if (isset($_GET['pc'])) {
        displayOnlyOnePage("pc", "pc");
    } else if (isset($_GET['xbox'])) {
        displayOnlyOnePage("xbox", "xbox");
    } else {
        displayPreferencesArticles();
    }
}


function getFirst5InArray($array)
{
    $arrayCarousel = array_slice($array, 0, 5);
    return $arrayCarousel;
}

function displayCarousel($array, $imgconsole)
{
    echo '
    <div id="carouselExample" class="carousel slide">
<div class="carousel-inner">';
    foreach ($array as $item) {
        echo '
    <div class="carousel-item active">
      <img src="' . $item['image'] . '" class="d-block w-100" alt="...">
    </div>';
    }
    echo '</div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>';
}
