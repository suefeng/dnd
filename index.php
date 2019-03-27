<!DOCTYPE html>
<html>
<head>
    <title>DnD</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Aleo|Source+Sans+Pro" rel="stylesheet"> 
    <style>
        * { box-sizing: border-box; }
        body { background: url('img/old-map2x.png'); background-size: 256px 256px; padding: 0; margin: 0; }
        body * { font-family: 'Source Sans Pro'; line-height: 1.56; }
        header, footer { background: #dd1100; margin: 0; padding: 1rem 0; box-shadow: 0 0 50px #888; text-align: center; }
        .inner { margin: 0 auto; max-width: 700px; }
        pre { max-width: 800px; margin: 2rem auto; white-space: pre-wrap; color: #333; background: rgba(255,255,255,.5); padding: 100px 50px; clip-path: polygon(3% 0, 7% 1%, 11% 0%, 16% 2%, 20% 0, 23% 2%, 28% 2%, 32% 1%, 35% 1%, 39% 3%, 41% 1%, 45% 0%, 47% 2%, 50% 2%, 53% 0, 58% 2%, 60% 2%, 63% 1%, 65% 0%, 67% 2%, 69% 2%, 73% 1%, 76% 1%, 79% 0, 82% 1%, 85% 0, 87% 1%, 89% 0, 92% 1%, 96% 0, 98% 3%, 99% 3%, 99% 6%, 100% 11%, 98% 15%, 100% 21%, 99% 28%, 100% 32%, 99% 35%, 99% 40%, 100% 43%, 99% 48%, 100% 53%, 100% 57%, 99% 60%, 100% 64%, 100% 68%, 99% 72%, 100% 75%, 100% 79%, 99% 83%, 100% 86%, 100% 90%, 99% 94%, 99% 98%, 95% 99%, 92% 99%, 89% 100%, 86% 99%, 83% 100%, 77% 99%, 72% 100%, 66% 98%, 62% 100%, 59% 99%, 54% 99%, 49% 100%, 46% 98%, 43% 100%, 40% 98%, 38% 100%, 35% 99%, 31% 100%, 28% 99%, 25% 99%, 22% 100%, 19% 99%, 16% 100%, 13% 99%, 10% 99%, 7% 100%, 4% 99%, 2% 97%, 1% 97%, 0% 94%, 1% 89%, 0% 84%, 1% 81%, 0 76%, 0 71%, 1% 66%, 0% 64%, 0% 61%, 0% 59%, 1% 54%, 0% 49%, 1% 45%, 0% 40%, 1% 37%, 0% 34%, 1% 29%, 0% 23%, 2% 20%, 1% 17%, 1% 13%, 0 10%, 1% 6%, 1% 3%); }
        a { color: #ffbf00; text-decoration: none; }
        a:hover { color: #fff; }
        a.selected { font-weight: bold; color: #fff; }
        section { padding: 1rem; background: #f5f5f5; margin: 1rem 0; }
        p { margin: 0; color: #333; }
        strong { color: #f77700; display: inline-block; width: 25%; text-align: right; margin: 0 .5rem 0 0; font-weight: 600; vertical-align: top; }
        strong + div { display: inline-block; width: 70%; vertical-align: top; }
        main { display: block; margin: 0 auto; font-family: 'Source Sans Pro', sans-serif; }
        .main-section { margin: 1rem 0; padding: 0 0 1.5rem; border-bottom: 1px solid #ddd; }
        .main-section:last-of-type { margin: 1rem 0 0; padding: 0; border-bottom: 0; }
        blockquote { margin: 1rem; background: #f1f1f1; padding: 1rem; }
        blockquote > blockquote { background: #e1e1e1; }
        blockquote > blockquote > blockquote { background: #d1d1d1; }
        blockquote > blockquote > blockquote > blockquote { background: #c1c1c1; }
        h1, h2, h3, h4, h5 { margin: 0 0 1rem; color: #fff; font-family: 'Aleo', serif; text-shadow: 2px 2px #333; }
        h1 { font-size: 2.5rem; }
        img { max-width: 400px; margin: 0 auto; vertical-align: middle; }
        .sessions { font-family: 'Aleo', serif; text-shadow: 1px 1px #333; border-bottom: 1px solid #FFD700; border-top: 1px solid #FFD700; padding: .5rem 0; margin: 1rem 0; color: #FFD700; }
        .sessions a { display: inline-block; padding: 0 .2rem; }
    </style>
</head>
<body>
<main>
<header>
<div class="inner">
<h1>Dungeons <img src="img/dragon.svg" alt="" width="50"> Dragons</h1>
<?php
$server             = $_SERVER['SERVER_NAME'];
$path               = $_SERVER['REQUEST_URI'];
$base               = basename(explode('?', $_SERVER['REQUEST_URI'])[0]);
$pages = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);

if ($base == 'dnd') {
    header('Location: 1');
}
else if (in_array($base, $pages)) {
    function links($pages, $base) {
        $links = '<div class="sessions">Sessions: ';
        foreach($pages as $p) {
            if ($p == $base) {
                $links .= '{<a href="'.$p.'" class="selected">'.$p.'</a>} ';
            }
            else {
                $links .= '<a href="'.$p.'">'.$p.'</a> ';
            }
        }
        $links .= '</div>';
        return $links;
    }
    echo links($pages, $base);
    echo '<h2>Hoard of the Dragon Queen Session '.$base.'</h2>';
    $page = 'hoard-of-the-dragon-queen/'.$base.'.txt';
    echo '</div></header>';
    echo '<pre>'.file_get_contents($page).'</pre>';
    echo '<footer><div class="inner">';
    echo links($pages, $base);
    echo '</div></footer>';
}
else if($base == 'thia') {
    $json = json_decode(file_get_contents('thia.json'), true);
    $main = '';
    $other = '';
    foreach($json as $row => $val)
    {
        if(!is_array($val)) {
            $main .= '<div><strong>'. $row . ': </strong><div>'. $val.'</div></div>';
        }
        else if($row !== 'meta') {
            $other .= '<div class="main-section">';
            if(!is_numeric($row)) {
                $other .=  '<h2>'.$row.'</h2>';
            }
            foreach($val as $nested => $val2) {
                if(!is_array($val2)) {
                    $other .=  '<div><strong>'.$nested . ': </strong><div>'.$val2.'</div></div>';
                }
                else {
                    $other .= '<blockquote>';
                    if(!is_numeric($nested)) {
                        $other .=  '<h3>'.$nested.'</h3>';
                    }
                    foreach($val2 as $nestnest => $val3) {
                        if(!is_array($val3)) {
                            $other .=  '<div><strong>'.$nestnest . ': </strong><div>'.$val3.'</div></div>';
                        }
                        else {
                            $other .= '<blockquote>';
                            if(!is_numeric($nestnest)) {
                                $other .=  '<h4>'.$nestnest.'</h4>';
                            }
                            foreach($val3 as $nest3 => $val4) {
                                if(!is_array($val4)) {
                                    $other .=  '<div><strong>'.$nest3 . ': </strong><div>'.$val4.'</div></div>';
                                }
                                else {
                                    $other .= '<blockquote>';
                                    if(!is_numeric($nest3)) {
                                        $other .=  '<h5>'.$nest3.'</h5>';
                                    }
                                    foreach($val4 as $nest4 => $val5) {
                                        $other .=  '<div><strong>'.$nest4 . ': </strong><div>'.$val5.'</div></div>';
                                    }
                                    $other .=  '</blockquote>';
                                } 
                            }
                            $other .=  '</blockquote>';
                        }
                    }
                    $other .=  '</blockquote>';
                } 
            }
            $other .=  '</div>';
        } 
    }
    echo '<img src="thia.png" alt=""><section>'.$main.'</section>';
    echo '<section>'.$other.'</section></main>';
}
/*
else {
    echo '<p>Select a character to begin.</p>';
    echo '<ul><li><a href="?char=Thia">Thia</a></li></ul></main>';
    echo '<iframe id="spells" width="100%" height="8650" frameborder="0" scrolling="no" onload="setIframeHeight(this.id)" src="https://onedrive.live.com/embed?cid=416B01E7E57FF5F5&resid=416B01E7E57FF5F5%21552914&authkey=AP3k4UX0HnRRT34&em=2&Item=Table1&wdHideGridlines=True"></iframe>';
}*/
?>
<script>
var elements = document.querySelectorAll('strong, h2, h3, h4, h5');
Array.prototype.forEach.call(elements, function(el, i){
    var text = el.textContent;
    var result = text.replace( /([A-Z])/g, " $1" );
    var finalResult = result.charAt(0).toUpperCase() + result.slice(1);
    el.textContent = finalResult;
    if(el.textContent == 'Dexterty: ') {
        el.nextElementSibling.textContent += ' +1';
    }
    if(el.textContent == 'Constitution: ') {
        el.nextElementSibling.textContent += ' +1';
    }
    if(el.textContent == 'Charisma: ') {
        el.nextElementSibling.textContent += ' +2';
    }
});
</script>
</body>
</html>