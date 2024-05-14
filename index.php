<?php
require 'head.php';
?>
<table id="表格" border="1" class="mdui-table-col-numeric mdui-table">
  <thead>
    <tr>
      <th>Filename</th>
      <th>Action</th>
    </tr>
  </thead>
<?php
$i=0;
$datadir=opendir('Video/');
while (($dataname = readdir($datadir)) !== false) {
  if ($dataname !=='.' && $dataname !=='..'  && $dataname !=='.htaccess'){
    echo <<<EOF
    <tbody >
    <tr>
      <td>$dataname</td>
      <td><a  href="play.php?name=$dataname" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-indigo">Open</a></td>
    </tr>
EOF
     ;
  }
}
?>
</tbody>
</table>
<script>
</script>
<?php
tail();
?>
