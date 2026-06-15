<?php
include __DIR__ . '/../includes/auth.php';
include __DIR__ . '/../../includes/koneksi.php';
include __DIR__ . '/../includes/header.php';

/* ================= TAMBAH ================= */
if (isset($_POST['tambah'])) {
    $judul = $_POST['judul'];
    $foto  = $_FILES['foto']['name'];
    $tmp   = $_FILES['foto']['tmp_name'];

    $path = "../../assets/img/galeri/";
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }

    move_uploaded_file($tmp, $path . $foto);

    mysqli_query($conn, "
        INSERT INTO galeri (judul, foto)
        VALUES ('$judul', '$foto')
    ");

    echo "<script>location='galeri.php';</script>";
}

/* ================= UPDATE ================= */
if (isset($_POST['simpan'])) {
    $id    = $_POST['id'];
    $judul = $_POST['judul'];

    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        $tmp  = $_FILES['foto']['tmp_name'];

        $path = "../../assets/img/galeri/";
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        move_uploaded_file($tmp, $path . $foto);

        mysqli_query($conn, "
            UPDATE galeri SET
            judul='$judul',
            foto='$foto'
            WHERE id='$id'
        ");
    } else {
        mysqli_query($conn, "
            UPDATE galeri SET
            judul='$judul'
            WHERE id='$id'
        ");
    }

    echo "<script>location='galeri.php';</script>";
}

/* ================= HAPUS ================= */
if (isset($_GET['hapus'])) {
    mysqli_query($conn, "DELETE FROM galeri WHERE id='$_GET[hapus]'");
    echo "<script>location='galeri.php';</script>";
}

/* ================= EDIT ================= */
$edit = false;
if (isset($_GET['edit'])) {
    $edit = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT * FROM galeri WHERE id='$_GET[edit]'")
    );
}
?>

<a href="../index.php" class="btn btn-secondary mb-3">
    ← Kembali ke Dashboard
</a>

<h3>Data Galeri</h3>

<form method="POST" enctype="multipart/form-data" class="mb-4">
    <input type="hidden" name="id" value="<?= $edit['id'] ?? '' ?>">

    <input type="text" name="judul" class="form-control mb-2"
        placeholder="Judul Foto"
        value="<?= $edit['judul'] ?? '' ?>" required>

    <input type="file" name="foto" class="form-control mb-2">

    <?php if ($edit) { ?>
        <button name="simpan" class="btn btn-warning">Update</button>
        <a href="galeri.php" class="btn btn-secondary">Batal</a>
    <?php } else { ?>
        <button name="tambah" class="btn btn-primary">Tambah</button>
    <?php } ?>
</form>

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Foto</th>
        <th>Judul</th>
        <th>Aksi</th>
    </tr>

<?php
$no = 1;
$data = mysqli_query($conn, "SELECT * FROM galeri ORDER BY id DESC");
while ($g = mysqli_fetch_assoc($data)) {
?>
<tr>
    <td><?= $no++ ?></td>
    <td>
        <img src="../../assets/img/galeri/<?= $g['foto'] ?>" width="80">
    </td>
    <td><?= $g['judul'] ?></td>
    <td>
        <a href="?edit=<?= $g['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="?hapus=<?= $g['id'] ?>"
           onclick="return confirm('Hapus foto ini?')"
           class="btn btn-danger btn-sm">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>

<?php include __DIR__ . '/../includes/footer.php'; ?>
