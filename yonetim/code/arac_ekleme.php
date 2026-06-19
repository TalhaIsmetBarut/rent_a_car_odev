<?php
$edit = @$_POST["edit"];
$marka = mysqli_real_escape_string($conn, $_POST["marka"]);
$model = mysqli_real_escape_string($conn, $_POST["model"]);
$yil = (int)$_POST["yil"];
$gunluk_fiyat = (int)$_POST["gunluk_fiyat"];
$yakit = mysqli_real_escape_string($conn, $_POST["yakit"]);
$vites = mysqli_real_escape_string($conn, $_POST["vites"]);
$kategori_id = (int)$_POST["kategori_id"];
$durum = mysqli_real_escape_string($conn, $_POST["durum"]);
$gorsel = trim($_POST["gorsel"] ?? "");

$id = 0;
if ($edit == "True") {
    $id = (int)$_POST["id"];
    
    $check_sql = "SELECT gorsel FROM araclar WHERE id=$id";
    $check_res = mysqli_query($conn, $check_sql);
    if ($check_res && $row = mysqli_fetch_assoc($check_res)) {
        $eski_gorsel = $row['gorsel'];
    }
}

$upload_err = "";


if (isset($_FILES['gorsel_dosya']) && $_FILES['gorsel_dosya']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['gorsel_dosya']['tmp_name'];
    $fileName = $_FILES['gorsel_dosya']['name'];
    $fileSize = $_FILES['gorsel_dosya']['size'];
    $fileType = $_FILES['gorsel_dosya']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    
    $newFileName = time() . '_' . md5(uniqid()) . '.' . $fileExtension;

    
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif', 'webp');
    if (in_array($fileExtension, $allowedExtensions)) {
        
        $uploadFileDir = '../uploads/kiralik_araclar/';
        
        
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }

        $dest_path = $uploadFileDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $gorsel = 'uploads/kiralik_araclar/' . $newFileName;
        } else {
            $upload_err = "Dosya sunucuya kaydedilirken bir hata oluştu.";
        }
    } else {
        $upload_err = "Geçersiz dosya uzantısı. İzin verilen uzantılar: " . implode(', ', $allowedExtensions);
    }
}


if (empty($gorsel)) {
    if (isset($eski_gorsel)) {
        $gorsel = $eski_gorsel;
    }
}


if (empty($gorsel) && empty($upload_err)) {
    $upload_err = "Lütfen bir görsel dosyası seçin veya geçerli bir görsel URL'si girin.";
}

if (!empty($upload_err)) {
    echo "<div class='alert alert-danger mb-4'><i class='bi bi-exclamation-triangle-fill me-2'></i><strong>Hata:</strong> " . h($upload_err) . "</div>";
} else {
    $gorsel_escaped = mysqli_real_escape_string($conn, $gorsel);
    if ($edit == "True") {
        $sql = "UPDATE araclar SET 
                    marka = '$marka', 
                    model = '$model', 
                    yil = $yil, 
                    gunluk_fiyat = $gunluk_fiyat, 
                    yakit = '$yakit', 
                    vites = '$vites', 
                    kategori_id = $kategori_id, 
                    durum = '$durum', 
                    gorsel = '$gorsel_escaped' 
                WHERE id = $id";
    } else {
        $sql = "INSERT INTO araclar (marka, model, yil, gunluk_fiyat, yakit, vites, kategori_id, durum, gorsel) 
                VALUES ('$marka', '$model', $yil, $gunluk_fiyat, '$yakit', '$vites', $kategori_id, '$durum', '$gorsel_escaped')";
    }

    
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
        echo "<div class='alert alert-success d-flex align-items-center mb-4'><i class='bi bi-check-circle-fill fs-4 me-2'></i> <div><strong>Başarılı!</strong> Araç başarıyla kaydedildi.</div></div>";
    } else {
        echo "<div class='alert alert-danger d-flex align-items-center mb-4'><i class='bi bi-exclamation-triangle-fill fs-4 me-2'></i> <div><strong>Hata!</strong> Hata oluştu: " . mysqli_error($conn) . "</div></div>";
    }
}
?>
<div class="card p-3 shadow-sm mt-3">
    <div class="card-body py-2">
        Araçlar sayfasına dönmek için <a href="?sayfa=araclar" class="btn btn-outline-primary btn-sm ms-2"><i class="bi bi-arrow-left me-1"></i> Tıklayınız</a>
    </div>
</div>


