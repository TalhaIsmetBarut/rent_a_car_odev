<?php
$id = @$_GET["id"];
if (!is_null($id)) {
    $id = (int)$id;
    $sql = "DELETE FROM kullanicilar WHERE id=$id";
    
    echo "
    <div class='position-fixed top-0 end-0 p-3' style='z-index: 1100;'>
        <div id='sqlDebugToast' class='toast show bg-dark text-white border border-secondary shadow-lg' role='alert'>
            <div class='toast-header bg-black text-warning border-bottom border-secondary d-flex justify-content-between align-items-center'>
                <span class='fw-bold me-auto'><i class='bi bi-terminal-fill me-2 text-warning'></i>SQL Debug Monitor</span>
                <small class='text-muted' id='sqlToastTimer'>3s</small>
                <button type='button' class='btn-close btn-close-white ms-2' data-bs-dismiss='toast' aria-label='Close'></button>
            </div>
            <div class='toast-body bg-dark text-light p-3' style='font-family: var(--bs-font-monospace); font-size: 0.8rem; word-break: break-all;'>
                <code>" . htmlspecialchars($sql) . "</code>
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
        echo "<div class='alert alert-success d-flex align-items-center mb-4'><i class='bi bi-check-circle-fill fs-4 me-2'></i> <div><strong>Başarılı!</strong> Kullanıcı kaydı başarıyla silindi.</div></div>";
    } else {
        echo "<div class='alert alert-danger d-flex align-items-center mb-4'><i class='bi bi-exclamation-triangle-fill fs-4 me-2'></i> <div><strong>Hata!</strong> Hata oluştu: " . mysqli_error($conn) . "</div></div>";
    }
}
?>
<div class="card p-3 shadow-sm mt-3">
    <div class="card-body py-2">
        Kullanıcı yetkileri sayfasına dönmek için <a href="?sayfa=kullanicilar" class="btn btn-outline-primary btn-sm ms-2"><i class="bi bi-arrow-left me-1"></i> Tıklayınız</a>
    </div>
</div>

