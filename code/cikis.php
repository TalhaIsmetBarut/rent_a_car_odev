<?php
session_unset();
session_destroy();
echo "Oturumunuz başarıyla kapatıldı. Yönlendiriliyorsunuz...";
echo '<meta http-equiv="refresh" content="2;url=index.php?sayfa=main">';
?>
