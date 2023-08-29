<?= $this->extend("layout\layout_utama") ?>

<?= $this->section("konten_utama") ?>
    <h1><?= $title ?></h1>
    <style>
        table, tr, th, td {
            border-collapse: collapse;
            border: 1px solid #333;
        }
        table{
            width: 100%;
            
        }
    </style>
    <table>
        <tr>
            <th>Judul</th>
            <th>Isi</th>
            <th>Aksi</th>
        </tr>
        <?php
        foreach($halaman_isi as $k => $v) {
        ?>
            <tr>
                <td> <?php echo $v['halaman_judul'] ?> </td>
                <td> <?php echo $v['halaman_isi'] ?> </td>
                <td>
                    <a href="/halaman/halaman_update/<?php echo $v['id_halaman'] ?>">Update</a>
                    <a href="/halaman/halaman_delete/<?php echo $v['id_halaman'] ?>">Delete</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
<?php $this->endSection() ?>
