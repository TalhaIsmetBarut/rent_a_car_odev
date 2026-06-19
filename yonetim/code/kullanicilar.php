<?php if (($_GET['sayfa'] ?? 'main') !== 'main'): ?>
    <h2 class="mb-4">Kullanıcı Yetkileri</h2>
<?php endif; ?>

<?php
$sql = "SELECT * FROM kullanicilar ORDER BY id DESC";
$ornek = mysqli_query($conn, $sql);
echo "<div class=\"d-none d-md-block table-responsive\">
<table class=\"table table-bordered table-striped align-middle\">
    <thead>
        <tr>
            <th>ID</th>
            <th>Kullanıcı Adı</th>
            <th>E-Posta</th>
            <th>Yetki (Rol)</th>
            <th>Yetki Düzenle</th>
            <th>Üyeliği Sil</th>
        </tr>
    </thead>
    <tbody>";
while ($row = mysqli_fetch_array($ornek, MYSQLI_BOTH)) {
    $id = $row["id"];
    $kadi = $row["kullanici_adi"];
    $eposta = $row["eposta"];
    $rol = $row["rol"];

    echo "<tr>";
    echo "<td>$id</td>";
    echo "<td>$kadi</td>";
    echo "<td>$eposta</td>";
    echo "<td>$rol</td>";
    echo "<td><a href=\"?sayfa=kullanici_duzenle&id=$id\"><i class=\"bi bi-pencil-fill\"></i></a></td>";
    echo "<td><a href=\"?sayfa=kullanici_sil&id=$id\" onclick=\"return confirm('Bu kullanıcıyı silmek istediğinize emin misiniz?')\"><i class=\"bi bi-trash\"></i></a></td>";
    echo "</tr>";
}
echo "</tbody></table></div>";


echo '<div class="d-block d-md-none">';
echo '<div class="row g-3">';
mysqli_data_seek($ornek, 0); 
while ($row = mysqli_fetch_array($ornek, MYSQLI_BOTH)) {
    $id = $row["id"];
    $kadi = $row["kullanici_adi"];
    $eposta = $row["eposta"];
    $rol = $row["rol"];
    
    $badge = "bg-secondary";
    if ($rol == 'admin') $badge = "bg-danger";
    if ($rol == 'editor') $badge = "bg-primary";
    $rol_display = "<span class=\"badge $badge\">$rol</span>";

    echo '<div class="col-12">
        <div class="card shadow-sm border">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div>
                        <span class="text-muted" style="font-size: 0.8rem;">ID: #' . (int)$id . '</span>
                        <h6 class="card-title mb-0 fw-bold mt-1">' . h($kadi) . '</h6>
                    </div>
                    ' . $rol_display . '
                </div>
                <p class="card-text text-muted mb-3" style="font-size: 0.85rem;"><i class="bi bi-envelope me-1"></i> ' . h($eposta) . '</p>
                <div class="d-flex gap-2">
                    <a href="?sayfa=kullanici_duzenle&id=' . $id . '" class="btn btn-outline-primary btn-sm flex-fill fw-bold"><i class="bi bi-pencil-fill me-1"></i> Yetki Düzenle</a>
                    <a href="?sayfa=kullanici_sil&id=' . $id . '" class="btn btn-outline-danger btn-sm flex-fill fw-bold" onclick="return confirm(\'Bu kullanıcıyı silmek istediğinize emin misiniz?\')"><i class="bi bi-trash me-1"></i> Sil</a>
                </div>
            </div>
        </div>
    </div>';
}
echo '</div></div>';
?>

