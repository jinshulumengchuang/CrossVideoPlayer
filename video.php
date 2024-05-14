<?php
$videopath='Video/'.$_GET['path'].'/'.$_GET['name'];
//$videopath='Photos/'.'1/SAM_0114.MP4';
$command='ffmpeg -i'.' "'.$videopath.'" '.' -ss 00:00:01 -s 360x360   -t 0.01  -n'.' "'.'Small/'.$_GET['path'].$_GET['name'].'.jpeg'.'"';
if($ife !== true)
{
    passthru($command);
}
header('Content-type:image/jpeg');
echo file_get_contents('Small/'.$_GET['path'].$_GET['name'].'.jpeg');
?>
