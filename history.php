<?PHP
$a=file_get_contents($_GET['name'].'history');
$a=unserialize($a);
echo <<<EOF
<script>
location.replace("play.php?name=$a[name]&id=$a[id]&current=$a[current]&mode=$a[mode]");
</script>
EOF
;
?>
