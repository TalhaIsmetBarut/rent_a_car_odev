<?php if (($_GET['sayfa'] ?? 'main') !== 'main'): ?>
    <h2 class="mb-4">Kategori Yönetimi</h2>
<?php endif; ?>

<a href="?sayfa=kategori_ekle" class="btn btn-primary mb-3"><i class="bi bi-plus-circle me-1"></i> Yeni Kategori Ekle</a>

<?php
$sql = "SELECT * FROM kategoriler ORDER BY id DESC";
$ornek = mysqli_query($conn, $sql);
echo "<div class=\"d-none d-md-block table-responsive\">
<table class=\"table table-bordered table-striped align-middle\">
    <thead>
        <tr>
            <th>ID</th>
            <th>Kategori Adı</th>
            <th>Sil</th>
        </tr>
    </thead>
    <tbody>";
while ($row = mysqli_fetch_array($ornek, MYSQLI_BOTH)) {
    $id = $row["id"];
    $ad = $row["ad"];

    echo "<tr>";
    echo "<td>$id</td>";
    echo "<td>$ad</td>";
    echo "<td><a href=\"?sayfa=kategori_sil&id=$id\"><i class=\"bi bi-trash\"></i></a></td>";
    echo "</tr>";
}
echo "</tbody></table></div>";


echo '<div class="d-block d-md-none">';
echo '<div class="list-group shadow-sm">';
mysqli_data_seek($ornek, 0); 
while ($row = mysqli_fetch_array($ornek, MYSQLI_BOTH)) {
    $id = $row["id"];
    $ad = $row["ad"];
    echo '<div class="list-group-item d-flex justify-content-between align-items-center py-3">
        <div>
            <span class="text-muted" style="font-size: 0.8rem;">ID: #' . (int)$id . '</span>
            <h6 class="mb-0 fw-bold mt-1">' . h($ad) . '</h6>
        </div>
        <div>
            <a href="?sayfa=kategori_sil&id=' . $id . '" class="btn btn-outline-danger btn-sm" onclick="return confirm(\'Bu kategoriyi silmek istediğinize emin misiniz?\')">
                <i class="bi bi-trash"></i>
            </a>
        </div>
    </div>';
}
echo '</div></div>';
?>

