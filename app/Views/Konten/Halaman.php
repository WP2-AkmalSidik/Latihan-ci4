<?= $this->extend("layout\layout_utama") ?>

<?= $this->section("konten_utama") ?>
    <h1><?= $judul_halaman ?></h1>
    <?= view_cell("\App\Libraries\lib_halaman::info", ['kategori' => 'Kesehatan', 'Penulis' => 'Raden']) ?>
    <div><?= $isi_Halaman ?></div>
    <div>
        <ul>
            <?php foreach ($manfaat as $k => $v): ?>
                <li><?= $v ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?= $this->include("komponen\sidebar") ?>
<?= $this->endSection() ?>
