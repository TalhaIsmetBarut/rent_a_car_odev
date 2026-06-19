<?php
if (!defined('conn') && !isset($conn)) {
    include("code/baglan.php");
}
?>
<style>
@import url('https://fonts.googleapis.com/css2?family=Caveat:wght@500;700&display=swap');
.report-card {
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    margin-bottom: 2rem;
    border: 1px solid #e9ecef;
}
.report-header {
    background: linear-gradient(135deg, #212529 0%, #343a40 100%);
    color: #fff;
    border-radius: 10px 10px 0 0;
    padding: 2rem;
}
.tech-badge {
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
    margin: 0.25rem;
    border-radius: 20px;
}
pre {
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    border-left: 4px solid #198754;
    padding: 1rem;
    border-radius: 5px;
    font-size: 0.85rem;
    max-height: 400px;
    overflow-y: auto;
}
code {
    color: #d63384;
}
@media print {
    nav, footer, .btn-print {
        display: none !important;
    }
    body {
        font-family: 'Caveat', 'Segoe Print', 'Comic Sans MS', cursive !important;
        font-size: 1.35rem !important;
        background-color: #fff !important;
        color: #000 !important;
        line-height: 1.3 !important;
    }
    h1, h2, h3, h4, h5, h6, .fw-bold, .display-6, .display-5 {
        font-family: 'Caveat', 'Segoe Print', 'Comic Sans MS', cursive !important;
        font-weight: 700 !important;
        color: #000 !important;
    }
    .report-card {
        box-shadow: none !important;
        border: none !important;
        margin-bottom: 2rem !important;
    }
    .card-header {
        background: none !important;
        color: #000 !important;
        border: none !important;
        border-bottom: 2px dashed #000 !important;
        padding: 0.5rem 0 !important;
        font-size: 1.6rem !important;
    }
    .card-body {
        padding: 1rem 0 !important;
    }
    .report-header {
        background: none !important;
        color: #000 !important;
        border-bottom: 2px solid #000 !important;
        border-radius: 0 !important;
        padding: 1.5rem 0 !important;
    }
    pre, code {
        font-family: 'Courier New', Courier, monospace !important;
        background: none !important;
        border: 1px dashed #666 !important;
        color: #000 !important;
    }
    .bi, .badge {
        display: none !important;
    }
}
</style>

<div class="row my-5 justify-content-center">
    <div class="col-lg-10">
        <div class="d-flex justify-content-between align-items-center mb-4 btn-print">
            <h2 class="mb-0 text-dark fw-bold"><i class="bi bi-file-earmark-pdf-fill text-danger me-2"></i>Dönem İçi Ödev Raporu</h2>
            <button onclick="window.print();" class="btn btn-primary fw-bold"><i class="bi bi-printer-fill me-2"></i>Yazdır / PDF Olarak Kaydet</button>
        </div>

        
        <div class="card report-card">
            <div class="report-header text-center text-sm-start">
                <h1 class="fw-bold display-6 mb-2">Barut Car Rent</h1>
                <p class="lead mb-0">Web Uygulamaları Geliştirme Ödev Projesi Değerlendirme Raporu</p>
            </div>
            <div class="card-body p-4 bg-light">
                <div class="row">
                    <div class="col-md-6 border-end border-secondary border-opacity-25">
                        <h5 class="fw-bold text-secondary mb-3"><i class="bi bi-person-fill me-2"></i>Öğrenci Bilgileri</h5>
                        <p class="mb-1"><strong>Adı Soyadı:</strong> Talha İsmet Barut</p>
                        <p class="mb-1"><strong>Proje Konusu:</strong> Yönetilebilir Dinamik Araç Kiralama Portalı</p>
                        <p class="mb-0"><strong>Domain :</strong> <a href="http://t1b.store" target="_blank" class="text-dark">t1b.store</a></p>
                    </div>
                    <div class="col-md-6 ps-md-4 mt-4 mt-md-0">
                        <h5 class="fw-bold text-secondary mb-3"><i class="bi bi-link-45deg me-2"></i>Hızlı Bağlantılar</h5>
                        <p class="mb-1"><strong>Kullanıcı Arayüzü:</strong> <a href="http://t1b.store" target="_blank" class="text-primary text-decoration-none">t1b.store</a></p>
                        <p class="mb-1"><strong>Yönetici Arayüzü:</strong> <a href="http://t1b.store/yonetim" target="_blank" class="text-primary text-decoration-none">t1b.store/yonetim</a></p>
                    </div>
                </div>
            </div>
        </div>

        
        <!-- Projenin Amacı ve İçeriği -->
        <div class="card report-card">
            <div class="card-header bg-dark text-white fw-bold py-3"><i class="bi bi-info-circle-fill me-2"></i>1. Projenin Amacı ve İçeriği</div>
            <div class="card-body p-4">
                <h5 class="fw-bold mb-2">Projenin Amacı</h5>
                <p>Bu projenin temel amacı; kullanıcıların internet üzerinden kolaylıkla kiralık araçları inceleyebileceği, filtreleme ve sıralama yapabileceği, kiralama talebi oluşturup durumunu takip edebileceği, yöneticilerin ise araç, kategori, kiralama talepleri ve kullanıcı yetkilerini dinamik olarak kontrol edebileceği, güvenli ve modern bir araç kiralama portalı geliştirmektir. Proje, ders kapsamında öğrenilen PHP, MySQL, HTML5, CSS3, JavaScript ve Bootstrap mimarilerinin entegrasyonu ile web programlama prensiplerini uygulamalı olarak göstermeyi hedefler.</p>
                
                <h5 class="fw-bold mt-4 mb-2">Projenin İçeriği</h5>
                <p>Barut Car Rent platformu iki ana arayüzden oluşmaktadır:</p>
                <ul>
                    <li><strong>Kullanıcı Arayüzü:</strong> Ana sayfada yerel slayt görsellerinden oluşan bir slider, öne çıkan araçlar listesi, detaylı sıralanabilir/filtrelenebilir araç kataloğu, dinamik fiyat hesaplama ve telefon numarası maskesi destekli kiralama talep formu ve kullanıcıların kendi taleplerini/onay durumlarını izleyebilecekleri "Taleplerim" takip modülü.</li>
                    <li><strong>Yönetici Arayüzü (Yönetim Paneli):</strong> Araç ekleme, güncelleme (dosya yükleme desteğiyle yerel resim kaydetme), araç silme; kategorilerin yönetimi; kullanıcıların listelenmesi ve rollerinin (admin/user) güncellenmesi; tüm kiralama taleplerinin listelenip onaylanma/reddedilme işlemlerinin yapılması ve SQL sorgularının izlendiği şık SQL Debug Monitor ekranı.</li>
                </ul>
            </div>
        </div>

        <div class="card report-card">
            <div class="card-header bg-dark text-white fw-bold py-3"><i class="bi bi-cpu me-2"></i>2. Kullanılan Teknolojiler & Araçlar</div>
            <div class="card-body p-4">
                <p>Proje kapsamında aşağıdaki modern teknolojiler ve kütüphaneler entegre edilerek sade, hızlı ve responsive bir sistem oluşturulmuştur:</p>
                <div class="d-flex flex-wrap mb-3">
                    <span class="badge bg-primary tech-badge">HTML5</span>
                    <span class="badge bg-info text-dark tech-badge">CSS3</span>
                    <span class="badge bg-warning text-dark tech-badge">JavaScript (ES6+)</span>
                    <span class="badge bg-dark tech-badge">Bootstrap 5.3 CDN</span>
                    <span class="badge bg-danger tech-badge">PHP 8.2</span>
                    <span class="badge bg-secondary tech-badge">MySQL Database</span>
                </div>
                <ul>
                    <li><strong>Ön Yüz:</strong> Tasarım ve grid yerleşimleri için tamamen Bootstrap 5.3 CDN kullanılmış, ikonlar için Bootstrap Icons kütüphanesi entegre edilmiştir.</li>
                    <li><strong>Arka Plan (Backend):</strong> Dinamik veritabanı işlemleri, oturum yönetimi ve yetki kontrol motorları için PHP scriptleri yazılmıştır.</li>
                    <li><strong>Veritabanı:</strong> Verilerin saklanması ve dinamik yönetimi için PHP `mysqli` kütüphanesi aracılığıyla ilişkisel MySQL veritabanı kurulmuştur.</li>
                </ul>
            </div>
        </div>

        
        <div class="card report-card">
            <div class="card-header bg-dark text-white fw-bold py-3"><i class="bi bi-database-fill-gear me-2"></i>3. Veritabanı Tasarımı ve Mimari Yapı</div>
            <div class="card-body p-4">
                <p>Veritabanında ilişkisel veri tutarlılığını sağlamak için yabancı anahtar kısıtlamaları ve silme işlemlerinde otomatik temizlik (`ON DELETE CASCADE`) kuralları tanımlanmıştır. Veritabanı şeması aşağıdaki tablolardan oluşmaktadır:</p>
                
                <h5 class="fw-bold mt-4 mb-2 text-dark">Tablo Yapıları ve İlişkiler</h5>
                <ol>
                    <li><strong>kategoriler:</strong> Araçların gruplandırılmasını sağlar. (Sedan, SUV, Hatchback, Elektrikli vb.)
                        <ul>
                            <li><code>id</code> (INT, PRIMARY KEY, AUTO_INCREMENT)</li>
                            <li><code>ad</code> (VARCHAR(50), NOT NULL)</li>
                        </ul>
                    </li>
                    <li><strong>araclar:</strong> Galerideki kiralık araçları saklar.
                        <ul>
                            <li><code>kategori_id</code> alanı, <code>kategoriler.id</code> alanına yabancı anahtar (`fk_arac_kategori`) ile bağlıdır. Kategori silindiğinde o kategoriye ait tüm araçlar otomatik silinir (`ON DELETE CASCADE`).</li>
                            <li><code>durum</code> kolonu varsayılan olarak 'Aktif' başlar, 'Pasif' veya 'Kiralandı' durumlarını alabilir.</li>
                        </ul>
                    </li>
                    <li><strong>talepler:</strong> Müşterilerin gönderdiği araç kiralama başvurularını saklar.
                        <ul>
                            <li><code>arac_id</code> alanı, <code>araclar.id</code> alanına yabancı anahtar (`fk_talep_arac`) ile bağlıdır. Araç silindiğinde ilgili tüm talepler de otomatik silinir.</li>
                            <li><code>durum</code> alanı 'Beklemede', 'Onaylandı' veya 'Reddedildi' değerlerini alır.</li>
                        </ul>
                    </li>
                    <li><strong>kullanicilar:</strong> Oturum açma yetkilerini barındıran tablodur.
                        <ul>
                            <li><code>rol</code> alanı 'admin' veya 'user' yetkisini saklar. Kayıt olurken otomatik olarak 'user' yetkisi atanır.</li>
                        </ul>
                    </li>
                </ol>
            </div>
        </div>

        
        <div class="card report-card">
            <div class="card-header bg-dark text-white fw-bold py-3"><i class="bi bi-shield-fill-check me-2"></i>4. Güvenlik Önlemleri ve Sunucu Çözümleri</div>
            <div class="card-body p-4">
                <h5 class="fw-bold text-success mb-3"><i class="bi bi-patch-check-fill me-2"></i>SQL Injection ve Parola Güvenliği</h5>
                <p>Veritabanı güvenliği için tüm GET/POST verileri <code>mysqli_real_escape_string()</code> veya sayısal dönüşümler (tip casting: <code>(int)$id</code>) kullanılarak temizlenir. Parola güvenliği için ise parolanın kendisi değil, PHP'nin güvenli hashleme motoru olan <code>password_hash()</code> fonksiyonundan geçirilmiş hash değerleri saklanır. Doğrulama <code>password_verify()</code> ile gerçekleştirilir.</p>

                <h5 class="fw-bold text-warning mt-4 mb-3"><i class="bi bi-exclamation-triangle-fill me-2"></i>Uzak Sunucu Yönlendirme Çözümü</h5>
                <p>Bazı uzak sunucularda çıktı tamponlamasının kapalı olması durumunda, HTML kodları gönderildikten sonra çağrılan <code>header()</code> fonksiyonları *"Headers already sent"* hatasına yol açmakta ve yönlendirmeleri bozmaktaydı. Bu sorunu çözmek için:</p>
                <ol>
                    <li>Ana giriş noktaları olan <code>index.php</code> ve <code>yonetim/index.php</code> dosyalarının en başına PHP'nin yerleşik çıktı tamponlama motorunu tetikleyen <code>ob_start();</code> komutu yerleştirilmiştir.</li>
                    <li>Giriş ve çıkış işlem motorlarında, veriler yazdırıldıktan sonra yönlendirme yapabilmek amacıyla HTTP başlıkları yerine tarayıcı uyumlu <strong>HTML Meta Refresh</strong> etiketi kullanılmıştır:</li>
                </ol>
                <pre><code>
echo "Giriş başarılı! Yönlendiriliyorsunuz...";
echo '&lt;meta http-equiv="refresh" content="2;url=index.php?sayfa=main"&gt;';</code></pre>
            </div>
        </div>

        
        <div class="card report-card">
            <div class="card-header bg-dark text-white fw-bold py-3"><i class="bi bi-phone-fill me-2"></i>5. Responsive Yapı ve Tasarım Cilası</div>
            <div class="card-body p-4">
                <p>Uygulamanın mobil, tablet ve masaüstü ekranlarda kusursuz çalışması için aşağıdaki hibrit responsive arayüzler tasarlanmıştır:</p>
                <ul>
                    <li><strong>Hibrit Responsive Görünüm:</strong> Araç listeleri ve yönetici tabloları geniş ekranlarda tam sütunlu Bootstrap tabloları halinde gösterilirken, mobil ekranlarda (768px altı) otomatik olarak dikey hizalanan, dokunmatik kullanıma uygun kart listelerine dönüşür.</li>
                </ul>
            </div>
        </div>

        
        <div class="card report-card">
            <div class="card-header bg-dark text-white fw-bold py-3"><i class="bi bi-code-slash me-2"></i>6. Özel Geliştirilen Kod Blokları</div>
            <div class="card-body p-4">
                
                <h5 class="fw-bold mb-2">A. JavaScript Dinamik Toplam Tutar Hesaplama (Kiralama Sayfası)</h5>
                <p>Kullanıcı kiralama gün sayısını değiştirdiği anda, sunucuya istek atmadan anlık olarak tahmini toplam tutarı tarayıcı üzerinde dinamik hesaplayan kod:</p>
                <pre><code>
const gunSayisiInput = document.getElementById('gun_sayisi');
const toplamTutarSpan = document.getElementById('toplam_tutar');
const gunlukFiyat = &lt;?php echo (int)($row['gunluk_fiyat'] ?? 0); ?&gt;;

function updateCalculatedTotal() {
    let gunSayisi = parseInt(gunSayisiInput.value) || 1;
    if (gunSayisi < 1) gunSayisi = 1;
    let toplam = gunSayisi * gunlukFiyat;
    toplamTutarSpan.textContent = new Intl.NumberFormat('tr-TR').format(toplam);
}

if (gunSayisiInput && toplamTutarSpan) {
    gunSayisiInput.addEventListener('input', updateCalculatedTotal);
    gunSayisiInput.addEventListener('change', updateCalculatedTotal);
}</code></pre>

                <h5 class="fw-bold mt-4 mb-2">B. Telefon Numarası Format Maskesi ve Güvenliği</h5>
                <p>Müşterinin geçerli bir formatta telefon girmesini zorunlu kılan, <code>+90 5XX XXX XX XX</code> formatını otomatik uygulayan ve 10 haneden fazla rakam girişini engelleyen JS kod bloğu:</p>
                <pre><code>
phoneInput.addEventListener('input', function() {
    if (!this.value.startsWith('+90 ')) {
        this.value = '+90 ';
    }
    
    let numberPart = this.value.substring(4).replace(/\D/g, '');
    
    if (numberPart.length > 10) {
        numberPart = numberPart.substring(0, 10);
    }
    
    let formatted = '';
    if (numberPart.length > 0) {
        formatted += numberPart.substring(0, 3);
    }
    if (numberPart.length > 3) {
        formatted += ' ' + numberPart.substring(3, 6);
    }
    if (numberPart.length > 6) {
        formatted += ' ' + numberPart.substring(6, 8);
    }
    if (numberPart.length > 8) {
        formatted += ' ' + numberPart.substring(8, 10);
    }
    
    this.value = '+90 ' + formatted;
});</code></pre>
            </div>
        </div>

        
        <div class="card report-card">
            <div class="card-header bg-dark text-white fw-bold py-3"><i class="bi bi-book-half me-2"></i>7. Araştırmalar ve Kaynakça</div>
            <div class="card-body p-4">
                <p>Proje geliştirme sürecinde yararlanılan spesifik kaynaklar, konu başlıkları ve doğrudan bağlantıları:</p>
                <ul>
                    <li><strong>Bootstrap Tables (Tablo Yapıları):</strong> <a href="https://getbootstrap.com/docs/5.3/content/tables/" target="_blank">https://getbootstrap.com/docs/5.3/content/tables/</a></li>
                    <li><strong>Bootstrap Carousel (Slider Bileşeni):</strong> <a href="https://getbootstrap.com/docs/5.3/components/carousel/" target="_blank">https://getbootstrap.com/docs/5.3/components/carousel/</a></li>
                    <li><strong>Bootstrap Offcanvas (Mobil Menü):</strong> <a href="https://getbootstrap.com/docs/5.3/components/offcanvas/" target="_blank">https://getbootstrap.com/docs/5.3/components/offcanvas/</a></li>
                    <li><strong>PHP password_hash() (Şifre Güvenliği):</strong> <a href="https://www.php.net/manual/en/function.password-hash.php" target="_blank">https://www.php.net/manual/en/function.password-hash.php</a></li>
                    <li><strong>PHP session_start() (Oturum Yönetimi):</strong> <a href="https://www.php.net/manual/en/function.session-start.php" target="_blank">https://www.php.net/manual/en/function.session-start.php</a></li>
                    <li><strong>W3Schools HTML Tables (Tablo Temelleri):</strong> <a href="https://www.w3schools.com/html/html_tables.asp" target="_blank">https://www.w3schools.com/html/html_tables.asp</a></li>
                    <li><strong>W3Schools PHP MySQL Database (Veritabanı Bağlantısı):</strong> <a href="https://www.w3schools.com/php/php_mysql_intro.asp" target="_blank">https://www.w3schools.com/php/php_mysql_intro.asp</a></li>
                </ul>
            </div>
        </div>

        
        <div class="text-center mb-5 btn-print">
            <button onclick="window.print();" class="btn btn-lg btn-success fw-bold px-5 py-3 shadow-sm"><i class="bi bi-printer-fill me-2 fs-5"></i>PDF Olarak İndir / Yazdır</button>
        </div>
    </div>
</div>
