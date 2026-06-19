<?php
$islem = @$_GET["islem"];
$id = @$_GET["id"];

if (!is_null($id) && !is_null($islem)) {
    $id = (int)$id;
    $islem = mysqli_real_escape_string($conn, $islem);
    
    $extra_sql = null;
    if ($islem == 'onayla') {
        $sql = "UPDATE talepler SET durum='Onaylandı' WHERE id=$id";
        $extra_sql = "UPDATE araclar SET durum='Kiralandı' WHERE id=(SELECT arac_id FROM talepler WHERE id=$id)";
    } elseif ($islem == 'reddet') {
        $sql = "UPDATE talepler SET durum='Reddedildi' WHERE id=$id";
        $extra_sql = "UPDATE araclar SET durum='Aktif' WHERE id=(SELECT arac_id FROM talepler WHERE id=$id)";
    } elseif ($islem == 'sil') {
        
        $arac_id = 0;
        $res = mysqli_query($conn, "SELECT arac_id FROM talepler WHERE id=$id");
        if ($res && $row = mysqli_fetch_assoc($res)) {
            $arac_id = (int)$row['arac_id'];
        }
        $sql = "DELETE FROM talepler WHERE id=$id";
        if ($arac_id > 0) {
            $extra_sql = "UPDATE araclar SET durum='Aktif' WHERE id=$arac_id";
        }
    }
    
    
    $display_sql = $sql . ($extra_sql ? ";\n" . $extra_sql : "");
    echo "
    <div class='position-fixed top-0 end-0 p-3' style='z-index: 1100;'>
        <div id='sqlDebugToast' class='toast show bg-dark text-white border border-secondary shadow-lg' role='alert'>
            <div class='toast-header bg-black text-warning border-bottom border-secondary d-flex justify-content-between align-items-center'>
                <span class='fw-bold me-auto'><i class='bi bi-terminal-fill me-2 text-warning'></i>SQL Debug Monitor</span>
                <small class='text-muted' id='sqlToastTimer'>3s</small>
                <button type='button' class='btn-close btn-close-white ms-2' data-bs-dismiss='toast' aria-label='Close'></button>
            </div>
            <div class='toast-body bg-dark text-light p-3' style='font-family: var(--bs-font-monospace); font-size: 0.8rem; word-break: break-all; white-space: pre-wrap;'>
                <code>" . htmlspecialchars($display_sql) . "</code>
            </div>
        </div>
    </div>
    <script>
        (function() {
            let count = 3;
            const timer = document.getElementById('sqlToastTimer');
            const interval = setInterval(() => {
                count--;
                if (count > 0) {
                    timer.textContent = count + 's';
                } else {
                    clearInterval(interval);
                    const toastEl = document.getElementById('sqlDebugToast');
                    if (toastEl) {
                        toastEl.classList.remove('show');
                        setTimeout(() => {
                            const parent = toastEl.parentElement;
                            if (parent) parent.remove();
                        }, 500);
                    }
                }
            }, 1000);
        })();
    </script>
    ";
    
    $ornek = mysqli_query($conn, $sql);
    if ($ornek) {
        if ($extra_sql) {
            mysqli_query($conn, $extra_sql);
        }
        echo "<div class='alert alert-success d-flex align-items-center mb-4'><i class='bi bi-check-circle-fill fs-4 me-2'></i> <div><strong>Başarılı!</strong> İşlem başarıyla gerçekleştirildi.</div></div>";
    } else {
        echo "<div class='alert alert-danger d-flex align-items-center mb-4'><i class='bi bi-exclamation-triangle-fill fs-4 me-2'></i> <div><strong>Hata!</strong> Hata oluştu: " . mysqli_error($conn) . "</div></div>";
    }
}
?>
<div class="card p-3 shadow-sm mt-3">
    <div class="card-body py-2">
        Kiralama talepleri sayfasına dönmek için <a href="?sayfa=talepler" class="btn btn-outline-primary btn-sm ms-2"><i class="bi bi-arrow-left me-1"></i> Tıklayınız</a>
    </div>
</div>


