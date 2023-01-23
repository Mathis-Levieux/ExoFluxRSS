<?php

session_start(); // On démarre la session


// Cookie thème
if (isset($_COOKIE[$_SESSION['user']['nickname'] . 'theme'])) {
    $theme = $_COOKIE[$_SESSION['user']['nickname'] . 'theme'];
} else {
    $theme = 'light';
}

function rss_reader($rss_feed, $console)
{
    $rss = simplexml_load_file($rss_feed);

    foreach ($rss->channel->item as $item) {
        // récupérer la date <dc:date>
        $date = $item->children('dc', true)->date;
        $date = date('d/m/Y', strtotime($date));
        
    echo '
    <div class="row">
     <div class="col-sm-12">
        <div class="card m-3 rounded " >
            <div class="row g-0">
                <div class="col-sm-2">
                    <img src="'.$console.'" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-sm-10">
                    <div class="card-body">
                        <h5 class="card-title"><a href="' . $item->link . '" target="_blank">' . $item->title . '</a></h5>
                        <p class="card-text text-light mb-0">' . $item->description . '</p>
                        <p class="card-text"><small class="text-secondary">' . $date . '</small></p>
                    </div>
                </div>
            </div>
        </div>
     </div>
    </div>
        ';
    }

    return $rss_feed;
}

// images pour $console
$playstation = "https://w0.peakpx.com/wallpaper/342/1021/HD-wallpaper-sony-logo-playstation.jpg"; 
$xbox = "https://wallpapercave.com/wp/wp10502006.jpg";
$switch = "http://i.imgur.com/61EZYqD.png";
$pc = "https://img.lovepik.com/background/20211030/medium/lovepik-computer-circuit-background-mobile-phone-wallpaper-image_400482049.jpg";
$mobile = "https://w0.peakpx.com/wallpaper/456/555/HD-wallpaper-cool-color-design-designs-flat-material-mobile.jpg";


var_dump(rss_reader('https://www.jeuxactu.com/rss/ps4.rss', $playstation));

