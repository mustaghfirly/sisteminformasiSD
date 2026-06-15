<?php
include __DIR__ . '/../includes/auth.php';
include __DIR__ . '/../../includes/koneksi.php';
include __DIR__ . '/../includes/header.php';

/* ================= TAMBAH / UPDATE ================= */
if (isset($_POST['simpan'])) {
    $nama    = $_POST['nama'];
    $jabatan = $_POST['jabatan'];

    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        $tmp  = $_FILES['foto']['tmp_name'];
        move_uploaded_file($tmp, "../../assets/img/guru/" . $foto);

        mysqli_query($conn, "
            UPDATE guru SET 
            nama='$nama',
            jabatan='$jabatan',
            foto='$foto'
            WHERE id='$_POST[id]'
        ");
    } else {
        mysqli_query($conn, "
            UPDATE guru SET 
            nama='$nama',
            jabatan='$jabatan'
            WHERE id='$_POST[id]'
        ");
    }

    echo "<script>location='guru.php';</script>";
}

/* ================= TAMBAH BARU ================= */
if (isset($_POST['tambah'])) {
    $nama    = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $foto    = $_FILES['foto']['name'];
    $tmp     = $_FILES['foto']['tmp_name'];

    move_uploaded_file($tmp, "../../assets/img/guru/" . $foto);

    mysqli_query($conn, "
        INSERT INTO guru (nama, jabatan, foto)
        VALUES ('$nama', '$jabatan', '$foto')
    ");

    echo "<script>location='guru.php';</script>";
}

/* ================= HAPUS ================= */
if (isset($_GET['hapus'])) {
    mysqli_query($conn, "DELETE FROM guru WHERE id='$_GET[hapus]'");
    echo "<script>location='guru.php';</script>";
}

/* ================= EDIT ================= */
$edit = false;
if (isset($_GET['edit'])) {
    $edit = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT * FROM guru WHERE id='$_GET[edit]'")
    );
}
?>

<a href="../index.php" class="btn btn-secondary mb-3">
    ← Kembali ke Dashboard
</a>

<h3>Data Guru</h3>

<form method="POST" enctype="multipart/form-data" class="mb-4">
    <input type="hidden" name="id" value="<?= $edit['id'] ?? '' ?>">

    <input type="text" name="nama" class="form-control mb-2"
        placeholder="Nama Guru"
        value="<?= $edit['nama'] ?? '' ?>" required>

    <input type="text" name="jabatan" class="form-control mb-2"
        placeholder="Jabatan"
        value="<?= $edit['jabatan'] ?? '' ?>" required>

    <input type="file" name="foto" class="form-control mb-2">

    <?php if ($edit) { ?>
        <button name="simpan" class="btn btn-warning">Update</button>
        <a href="guru.php" class="btn btn-secondary">Batal</a>
    <?php } else { ?>
        <button name="tambah" class="btn btn-primary">Tambah</button>
    <?php } ?>
</form>

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Foto</th>
        <th>Nama</th>
        <th>Jabatan</th>
        <th>Aksi</th>
    </tr>

<?php
$no = 1;
$data = mysqli_query($conn, "SELECT * FROM guru");
while ($g = mysqli_fetch_assoc($data)) {
?>
<tr>
    <td><?= $no++ ?></td>
    <td><img src="../../assets/img/guru/<?= $g['foto'] ?>" width="60"></td>
    <td><?= $g['nama'] ?></td>
    <td><?= $g['jabatan'] ?></td>
    <td>
        <a href="?edit=<?= $g['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="?hapus=<?= $g['id'] ?>" class="btn btn-danger btn-sm"
           onclick="return confirm('Hapus data?')">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>

<?php include __DIR__ . '/../includes/footer.php'; ?>
