<?php

// images pour chaque console
$playstation = "https://w0.peakpx.com/wallpaper/342/1021/HD-wallpaper-sony-logo-playstation.jpg";
$xbox = "https://wallpapercave.com/wp/wp10502006.jpg";
$switch = "http://i.imgur.com/61EZYqD.png";
$pc = "https://img.lovepik.com/background/20211030/medium/lovepik-computer-circuit-background-mobile-phone-wallpaper-image_400482049.jpg";
$mobile = "https://w0.peakpx.com/wallpaper/456/555/HD-wallpaper-cool-color-design-designs-flat-material-mobile.jpg";


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
        echo '
        <div class="row">
         <div class="col-sm-12">
            <div class="card m-3 rounded " >
                <div class="row g-0">
                    <div class="col-sm-2">
                   <img src="' . $console . '" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-sm-10">
                        <div class="card-body">
                            <h5 class="card-title"><a href="' . $article['link'] . '" target="_blank">' . $article['title'] . '</a></h5>
                            <p class="card-text text-light mb-0">' . $article['description'] . '</p>
                            <p class="card-text"><small class="text-secondary">' . $date . '</small></p>
                        </div>
                    </div>
                </div>
            </div>
         </div>
        </div>
            ';
    }
}
