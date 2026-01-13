<?php
//Uudiste lugemise funktsioon
function uudised($url, $kogus)
{
    $feed=simplexml_load_file($url);
    echo "<ul>";
    //echo "Kuupäev: ".date("d.m.Y", strtotime($feed->channel->pubDate));
    $loendur=0;
    foreach($feed->channel->item as $item)
    {
        if($loendur<=$kogus){
            echo "<li><a href='$item->link' target='_blank'>".$item->title."</a>";
            echo "<br>".$item->description."<br>"."Kuupäev:".$item->pubDate;
        echo "<img src= 'channel->url' alt=''>";
        echo "</li>";
        $loendur++;
        }
    }
    echo "</ul>";
}
