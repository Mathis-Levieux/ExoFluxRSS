<?php




function rss_reader($rss_feed)
{

    $rss = simplexml_load_file($rss_feed);


    foreach ($rss->channel->item as $item) {
        echo '<div class="rss-item">';
        echo '<h3><a href="' . $item->link . '" target="_blank">' . $item->title . '</a></h3>';
        echo '<p>' . $item->description . '</p>';
        echo '</div>';
    }

    return $rss_feed;
}


var_dump(rss_reader('https://www.jeuxactu.com/rss/ps4.rss'));
