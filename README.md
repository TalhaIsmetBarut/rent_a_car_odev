# Barut Car Rent - Araç Kiralama Portalı

Web Uygulamaları Geliştirme dersi kapsamında PHP, MySQL ve Bootstrap 5.3 kullanılarak hazırlanan, responsive tasarıma sahip yönetilebilir dinamik araç kiralama portalı.

*   **Kullanıcı Arayüzü:** [https://t1b.store](https://t1b.store)
*   **Yönetici Paneli:** [https://t1b.store/yonetim](https://t1b.store/yonetim)

## Proje Özellikleri

*   **Kullanıcı Arayüzü:**
    *   Carousel (Slayt) karşılama alanı.
    *   Özelleştirilebilir çoklu sütun sıralama ve durum filtrelemeli araç listesi.
    *   Dinamik kiralama fiyatı hesaplayıcı ve telefon girişi maskeli talep formu.
    *   Kullanıcıların kiralama taleplerinin onay durumlarını takip edebileceği **Taleplerim** modülü.
*   **Yönetici Arayüzü (Yönetim Paneli):**
    *   Araç Ekleme/Güncelleme/Silme (Yerel dosya yükleme desteğiyle görsel kaydı).
    *   Kategori Yönetimi.
    *   Kullanıcı rollerini (admin/user) yönetme paneli.
    *   Kiralama talepleri listesi ve onaylama/reddetme motoru.
    *   Sorguların canlı izlenebildiği şık **SQL Debug Monitor** ekranı.

## Kurulum ve Çalıştırma

1.  Proje dosyalarını yerel sunucunuza (örneğin XAMPP `htdocs` klasörüne) kopyalayın.
2.  `db/rentacar.sql` dosyasını veritabanı yönetim arayüzünüzden (phpMyAdmin) içe aktarın.
3.  Veritabanı bağlantı bilgilerini `code/baglan.php` ve `yonetim/code/baglan.php` dosyalarından sunucu ayarlarınıza göre güncelleyin.
4.  Tarayıcınızdan `http://localhost/rent-a-car` adresine giderek siteyi çalıştırın.
