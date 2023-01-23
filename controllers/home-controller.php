<?php

session_start(); // On démarre la session

// Cookie thème
if (isset($_SESSION['user'])) {
    if (isset($_COOKIE[$_SESSION['user']['nickname'] . 'theme'])) {
        $theme = $_COOKIE[$_SESSION['user']['nickname'] . 'theme'];
    }
} else {
    $theme = 'light';
}

function rss_reader($rss_feed, $console) // Fonction qui prend en paramètre l'URL du flux RSS et l'image de la console
{
    $rss = simplexml_load_file($rss_feed);

    foreach ($rss->channel->item as $item) {
        // récupérer la date <dc:date>
        $date = $item->children('dc', true)->date;
        $date = date('d/m/Y', strtotime($date));

        // récupérer l'url de l'image 
        $image = $item->enclosure['url'];

        // récupérer le premier mot de $item->title
        $first_word = explode(' ', $item->title)[0];

        echo '
        <div class="card mb-3" data-bs-toggle="modal" data-bs-target="#' . $first_word . '">
            <img src="'.$image.'" class="card-img-top" alt="photo article">
            <div class="card-body">
                <h5 class="card-title text-light"><img src="'.$console.'" alt="logo">
                ' . $item->title . '
                </h5>
                <p class="card-text">
                    <small class="text-secondary">' . $date . '</small>
                </p>  
            </div>
        </div>

        <div class="modal fade" id="' . $first_word . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header p-0">
              <h1 class="modal-title fs-5" id="' . $first_word . '"><img src="'.$console.'" alt="logo">' . $item->title . '</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              '.$item->description.'
            </div>
            <div class="modal-footer">
              <button href="'.$item->link.'"type="button" class="btn btn-primary">en savoir plus</button>
            </div>
          </div>
        </div>
      </div>
         ';
    }

}

// logo pour $console
$playstation = "../assets/img/playstation.png"; 
$xbox = "../assets/img/xbox.png";
$switch = "../assets/img/switch.png";
$pc = "../assets/img/computer.png";
$mobile = "../assets/img/mobile.png";


var_dump(rss_reader('https://www.jeuxactu.com/rss/switch.rss', $switch));

