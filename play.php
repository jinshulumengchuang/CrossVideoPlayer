<?php
require 'head.php';
?>
<video id='play' style="height: auto;width: 100%" controls class='mdui-center' autoplay></video>
<h3 id='h3'></h3>
<a onclick="previous()" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-indigo">Previous</a>
<a onclick="next()" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-indigo">Next</a>
<a id="xunhuan" onclick="xunhuan()" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-indigo">Loop</a>
<div class="mdui-textfield">
  <label class="mdui-textfield-label">定时停止（分钟）</label>
  <input id="input" class="mdui-textfield-input" type="text"/>
  <a onclick="timestop()" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-indigo">Confirm</a>
</div>
<table id="表格" border="1" class="mdui-table-col-numeric mdui-table">
  <thead>
    <tr>
      <th>Folder</th>
    </tr>
  </thead>
<?php
$i=1;
exec('./video.sh'.' Video/'."'".$_GET['name']."'", $datadir);
$countfiles = count($datadir);
for($i=0;$i<$countfiles;$i++){
    $o = $i + 1;
    echo <<<EOF
    <tbody >
    <tr>

      <td onclick="play('$datadir[$i]', $o)" id="$o" ><a><p class="mdui-float-left mdui-valign">$datadir[$i]</p></a></td>

    </tr>
EOF
     ;
     //$i=$i + 1;

}
echo <<<EOF
<p id=count style='display: none'><p>
EOF
;
echo <<<EOF
<p id=name style='display: none'>$_GET[name]<p>
EOF
;
?>
</tbody>
</table>
<script>
var cid
mode = 'shunxu';
function xunhuan() {
  if (mode == 'shunxu') {
    mode = 'xunhuan'
    document.getElementById('xunhuan').innerHTML = 'Sequential'
  }
  else {
    mode = 'shunxu'
    document.getElementById('xunhuan').innerHTML = 'Loop'
  }
}
function play(name, id) {
  getname = document.getElementById('name').innerHTML ;
  document.getElementById('play').src = 'Video/' + getname + '/' + name;
  document.getElementById('h3').innerHTML = 'Playing：' + name
  document.getElementById('count').innerHTML = id;
  cid = id
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
function save() {
   if (document.getElementById('play').paused != true) {
   getname = document.getElementById('name').innerHTML ;
   id = document.getElementById('count').innerHTML;
   xhr = new XMLHttpRequest();
   url = 'upload.php?name=' + getname + '&id=' +id +  '&current=' + document.getElementById("play").currentTime + '&mode=' + mode
   xhr.open('GET', url, true);
   xhr.send();
   console.log('记录已保存');
   setTimeout(save, 30 *1000);
   }

}

 
 document.getElementById('play').addEventListener("playing", e => {
  save();
  });
function next() {
  newid = document.getElementById('count').innerHTML;
  newid = parseInt(newid)
  newid = newid + 1 ;
  playnext = document.getElementById(newid).onclick;
  playnext();
}
function previous() {
  newid = document.getElementById('count').innerHTML;
  newid = parseInt(newid)
  newid = newid - 1 ;
  playnext = document.getElementById(newid).onclick;
  playnext();
}
function timestop() {
  value = document.getElementById("input").value  ;
  value = parseInt(value);
  value = value * 1000 * 60
  console.log(value)
  setTimeout(mystop, value);
  mdui.snackbar({
  message: 'Done'
  });
}
function mystop() {
   play = document.getElementById('play');
   play.pause();
}
document.getElementById("play").addEventListener('ended', function () {
       if(mode=='shunxu') {
       id = cid + 1;
       playnext = document.getElementById(id).onclick;
       playnext();
       }
       if(mode=='xunhuan') {
       playnext = document.getElementById(cid).onclick
       playnext();
       }
}, false);
</script>
<?php
if($_GET['id'])
{
echo <<<EOF
<script>
playnext = document.getElementById('$_GET[id]').onclick;
playnext();
</script>
EOF
;
}
if($_GET['current'])
{
echo <<<EOF
<script>
document.getElementById("play").currentTime = $_GET[current]
</script>
EOF
;
}
if($_GET['mode'] == 'xunhuan')
{
echo <<<EOF
<script>
xunhuan();
</script>
EOF
;
}
tail();
?>
