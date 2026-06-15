<?php
include __DIR__ . '/../includes/auth.php';
include __DIR__ . '/../../includes/koneksi.php';
include __DIR__ . '/../includes/header.php';

/* ================= TAMBAH ================= */
if (isset($_POST['tambah'])) {
    $nama       = $_POST['nama'];
    $deskripsi  = $_POST['deskripsi'];
    $gambar     = $_FILES['gambar']['name'];
    $tmp        = $_FILES['gambar']['tmp_name'];

    // pastikan folder ada
    $path = "../../assets/img/ekstrakurikuler/";
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }

    move_uploaded_file($tmp, $path . $gambar);

    mysqli_query($conn, "
        INSERT INTO ekstrakurikuler (nama, deskripsi, gambar)
        VALUES ('$nama', '$deskripsi', '$gambar')
    ");

    echo "<script>location='ekstrakurikuler.php';</script>";
}

/* ================= UPDATE ================= */
if (isset($_POST['simpan'])) {
    $id         = $_POST['id'];
    $nama       = $_POST['nama'];
    $deskripsi  = $_POST['deskripsi'];

    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $tmp    = $_FILES['gambar']['tmp_name'];

        $path = "../../assets/img/ekstrakurikuler/";
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        move_uploaded_file($tmp, $path . $gambar);

        mysqli_query($conn, "
            UPDATE ekstrakurikuler SET
            nama='$nama',
            deskripsi='$deskripsi',
            gambar='$gambar'
            WHERE id='$id'
        ");
    } else {
        mysqli_query($conn, "
            UPDATE ekstrakurikuler SET
            nama='$nama',
            deskripsi='$deskripsi'
            WHERE id='$id'
        ");
    }

    echo "<script>location='ekstrakurikuler.php';</script>";
}

/* ================= HAPUS ================= */
if (isset($_GET['hapus'])) {
    mysqli_query($conn, "DELETE FROM ekstrakurikuler WHERE id='$_GET[hapus]'");
    echo "<script>location='ekstrakurikuler.php';</script>";
}

/* ================= EDIT ================= */
$edit = false;
if (isset($_GET['edit'])) {
    $edit = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT * FROM ekstrakurikuler WHERE id='$_GET[edit]'")
    );
}
?>

<a href="../index.php" class="btn btn-secondary mb-3">
    ← Kembali ke Dashboard
</a>

<h3>Data Ekstrakurikuler</h3>

<form method="POST" enctype="multipart/form-data" class="mb-4">
    <input type="hidden" name="id" value="<?= $edit['id'] ?? '' ?>">

    <input type="text" name="nama" class="form-control mb-2"
        placeholder="Nama Ekstrakurikuler"
        value="<?= $edit['nama'] ?? '' ?>" required>

    <textarea name="deskripsi" class="form-control mb-2"
        placeholder="Deskripsi"
        rows="3"><?= $edit['deskripsi'] ?? '' ?></textarea>

    <input type="file" name="gambar" class="form-control mb-2">

    <?php if ($edit) { ?>
        <button name="simpan" class="btn btn-warning">Update</button>
        <a href="ekstrakurikuler.php" class="btn btn-secondary">Batal</a>
    <?php } else { ?>
        <button name="tambah" class="btn btn-primary">Tambah</button>
    <?php } ?>
</form>

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Gambar</th>
        <th>Nama</th>
        <th>Deskripsi</th>
        <th>Aksi</th>
    </tr>

<?php
$no = 1;
$data = mysqli_query($conn, "SELECT * FROM ekstrakurikuler ORDER BY id DESC");
while ($e = mysqli_fetch_assoc($data)) {
?>
<tr>
    <td><?= $no++ ?></td>
    <td>
        <img src="../../assets/img/ekstrakurikuler/<?= $e['gambar'] ?>" width="70">
    </td>
    <td><?= $e['nama'] ?></td>
    <td><?= $e['deskripsi'] ?></td>
    <td>
        <a href="?edit=<?= $e['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="?hapus=<?= $e['id'] ?>"
           onclick="return confirm('Hapus data?')"
           class="btn btn-danger btn-sm">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>

<?php include __DIR__ . '/../includes/footer.php'; ?>
