<?php
if (!isset($_SESSION["kullanici_adi"])) {
    echo '<div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <div class="card shadow-sm border p-5">
                    <i class="bi bi-lock-fill text-warning fs-1 mb-3"></i>
                    <h4>Taleplerinizi Görmek İçin Giriş Yapın</h4>
                    <p class="text-muted">Kiralama taleplerinizin durumunu ve detaylarını takip edebilmek için üye girişi yapmanız gerekmektedir.</p>
                    <a href="?sayfa=giris" class="btn btn-primary px-4 mt-3">Giriş Yap</a>
                </div>
            </div>
        </div>
    </div>';
    return;
}

$session_username = mysqli_real_escape_string($conn, $_SESSION["kullanici_adi"]);

$user_sql = "SELECT eposta FROM kullanicilar WHERE kullanici_adi = '$session_username'";
$user_res = mysqli_query($conn, $user_sql);
$user_email = "";
if ($user_res && $u_row = mysqli_fetch_assoc($user_res)) {
    $user_email = mysqli_real_escape_string($conn, $u_row['eposta']);
}


$sql = "SELECT t.*, a.marka, a.model, a.gorsel 
        FROM talepler t 
        JOIN araclar a ON t.arac_id = a.id 
        WHERE t.eposta = '$user_email' 
        ORDER BY t.id DESC";
$ornek = mysqli_query($conn, $sql);
?>

<div class="container my-5">
    <h3 class="mb-4"><i class="bi bi-clock-history me-2"></i>Kiralama Taleplerim</h3>

    <?php if ($ornek && mysqli_num_rows($ornek) > 0): ?>
        
        <div class="d-none d-md-block table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Tarih</th>
                        <th>Araç</th>
                        <th>Kiralama Süresi</th>
                        <th>Toplam Tutar</th>
                        <th>Alış Tarihi</th>
                        <th>Durum</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_array($ornek, MYSQLI_BOTH)): 
                        $badge = "bg-warning text-dark";
                        if ($row['durum'] == 'Onaylandı') $badge = "bg-success";
                        if ($row['durum'] == 'Reddedildi') $badge = "bg-danger";
                        
                        $toplam_tutar = (int)($row["toplam_tutar"] ?? 0);
                        $toplam_tutar_formatted = number_format($toplam_tutar, 0, ',', '.') . " TL";
                    ?>
                        <tr>
                            <td><?php echo date('d.m.Y H:i', strtotime($row['talep_tarihi'])); ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <?php if (!empty($row['gorsel'])): ?>
                                        <img src="<?php echo h($row['gorsel']); ?>" style="width: 80px; height: 50px; object-fit: cover !important;" class="rounded border" onerror="this.src='https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=500'">
                                    <?php endif; ?>
                                    <span><strong><?php echo h($row['marka'] . ' ' . $row['model']); ?></strong></span>
                                </div>
                            </td>
                            <td><?php echo (int)$row['gun_sayisi']; ?> Gün</td>
                            <td class="fw-bold text-success"><?php echo $toplam_tutar_formatted; ?></td>
                            <td><?php echo date('d.m.Y', strtotime($row['alis_tarihi'])); ?></td>
                            <td><span class="badge <?php echo $badge; ?> px-3 py-2 fs-6"><?php echo h($row['durum']); ?></span></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        
        <div class="d-block d-md-none">
            <div class="row g-3">
                <?php 
                mysqli_data_seek($ornek, 0);
                while ($row = mysqli_fetch_array($ornek, MYSQLI_BOTH)): 
                    $badge = "bg-warning text-dark";
                    if ($row['durum'] == 'Onaylandı') $badge = "bg-success";
                    if ($row['durum'] == 'Reddedildi') $badge = "bg-danger";
                    
                    $toplam_tutar = (int)($row["toplam_tutar"] ?? 0);
                    $toplam_tutar_formatted = number_format($toplam_tutar, 0, ',', '.') . " TL";
                ?>
                    <div class="col-12">
                        <div class="card shadow-sm border">
                            <div class="card-header d-flex justify-content-between align-items-center py-2 bg-light">
                                <span class="text-muted" style="font-size: 0.85rem;"><?php echo date('d.m.Y H:i', strtotime($row['talep_tarihi'])); ?></span>
                                <span class="badge <?php echo $badge; ?>"><?php echo h($row['durum']); ?></span>
                            </div>
                            <div class="card-body p-3">
                                <div class="d-flex gap-3 align-items-center mb-3">
                                    <?php if (!empty($row['gorsel'])): ?>
                                        <img src="<?php echo h($row['gorsel']); ?>" style="width: 90px; height: 60px; object-fit: cover !important;" class="rounded border" onerror="this.src='https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=500'">
                                    <?php endif; ?>
                                    <div>
                                        <h6 class="fw-bold mb-1"><?php echo h($row['marka'] . ' ' . $row['model']); ?></h6>
                                        <span class="text-success fw-bold"><?php echo $toplam_tutar_formatted; ?></span>
                                    </div>
                                </div>
                                <p class="card-text mb-1" style="font-size: 0.85rem;"><strong>Süre:</strong> <?php echo (int)$row['gun_sayisi']; ?> Gün</p>
                                <p class="card-text mb-0" style="font-size: 0.85rem;"><strong>Alış Tarihi:</strong> <?php echo date('d.m.Y', strtotime($row['alis_tarihi'])); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

    <?php else: ?>
        <div class="alert alert-info py-4 text-center">
            <i class="bi bi-info-circle-fill fs-3 d-block mb-2"></i>
            Henüz kiralama talebiniz bulunmamaktadır.
        </div>
    <?php endif; ?>
</div>
