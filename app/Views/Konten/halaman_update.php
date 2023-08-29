<?= $this->extend("layout\layout_utama") ?>

<?= $this->section("konten_utama") ?>
    <h1><?= $title ?></h1>
    <form action="" method="POST">
        <table>
            <tr>
                <td>Judul</td>
                <td><input value="<?php echo $halaman_isi['halaman_judul'] ?>" type="text" style="width: 400px" name="halaman_judul"></td> <!-- Perbaiki tag dan input -->
            </tr>
            <tr>
                <td>Isi</td>
                <td><textarea style="width: 400px" name="halaman_isi">"<?php echo $halaman_isi['halaman_isi']?></textarea></td> <!-- Perbaiki tag dan textarea -->
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="simpan" value="Submit">
                </td>
            </tr>
        </table>
    </form>
<?= $this->endSection() ?>
