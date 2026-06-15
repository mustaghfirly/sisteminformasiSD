<?php
// ================= AUTH & INCLUDE (SAMA DENGAN guru.php) =================
include __DIR__ . '/../includes/auth.php';
include __DIR__ . '/../../includes/koneksi.php';
include __DIR__ . '/../includes/header.php';

// ================= TAMBAH / UPDATE =================
if (isset($_POST['simpan'])) {
    $nama      = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];

    $folder = "../../uploads/program_unggulan/";
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    // JIKA UPLOAD FOTO BARU
    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        $tmp  = $_FILES['foto']['tmp_name'];

        move_uploaded_file($tmp, $folder . $foto);

        mysqli_query($conn, "
            UPDATE program_unggulan SET
                nama='$nama',
                deskripsi='$deskripsi',
                foto='$foto'
            WHERE id='$_POST[id]'
        ");
    } else {
        mysqli_query($conn, "
            UPDATE program_unggulan SET
                nama='$nama',
                deskripsi='$deskripsi'
            WHERE id='$_POST[id]'
        ");
    }

    echo "<script>location='program_unggulan.php';</script>";
}

// ================= TAMBAH BARU =================
if (isset($_POST['tambah'])) {
    $nama      = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];

    $folder = "../../uploads/program_unggulan/";
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        $tmp  = $_FILES['foto']['tmp_name'];
        move_uploaded_file($tmp, $folder . $foto);
    } else {
        $foto = 'default.jpg'; // pastikan file ini ada
    }

    mysqli_query($conn, "
        INSERT INTO program_unggulan (nama, deskripsi, foto)
        VALUES ('$nama', '$deskripsi', '$foto')
    ");

    echo "<script>location='program_unggulan.php';</script>";
}

// ================= HAPUS =================
if (isset($_GET['hapus'])) {
    mysqli_query($conn, "DELETE FROM program_unggulan WHERE id='$_GET[hapus]'");
    echo "<script>location='program_unggulan.php';</script>";
}

// ================= EDIT =================
$edit = false;
if (isset($_GET['edit'])) {
    $edit = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT * FROM program_unggulan WHERE id='$_GET[edit]'")
    );
}
?>

<a href="../index.php" class="btn btn-secondary mb-3">
    ← Kembali ke Dashboard
</a>

<h3>Program Unggulan</h3>

<!-- ================= FORM ================= -->
<form method="POST" enctype="multipart/form-data" class="mb-4">
    <input type="hidden" name="id" value="<?= $edit['id'] ?? '' ?>">

    <input type="text"
           name="nama"
           class="form-control mb-2"
           placeholder="Nama Program"
           value="<?= $edit['nama'] ?? '' ?>"
           required>

    <textarea name="deskripsi"
              class="form-control mb-2"
              placeholder="Deskripsi Program"
              rows="3"
              required><?= $edit['deskripsi'] ?? '' ?></textarea>

    <input type="file" name="foto" class="form-control mb-2">

    <?php if ($edit) { ?>
        <button name="simpan" class="btn btn-warning">Update</button>
        <a href="program_unggulan.php" class="btn btn-secondary">Batal</a>
    <?php } else { ?>
        <button name="tambah" class="btn btn-primary">Tambah</button>
    <?php } ?>
</form>

<!-- ================= TABEL ================= -->
<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Foto</th>
        <th>Nama Program</th>
        <th>Deskripsi</th>
        <th>Aksi</th>
    </tr>

<?php
$no = 1;
$data = mysqli_query($conn, "SELECT * FROM program_unggulan ORDER BY id DESC");
while ($p = mysqli_fetch_assoc($data)) {
?>
<tr>
    <td><?= $no++ ?></td>
    <td>
        <img src="../../uploads/program_unggulan/<?= $p['foto'] ?>" width="80">
    </td>
    <td><?= $p['nama'] ?></td>
    <td><?= $p['deskripsi'] ?></td>
    <td>
        <a href="?edit=<?= $p['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="?hapus=<?= $p['id'] ?>"
           class="btn btn-danger btn-sm"
           onclick="return confirm('Hapus data?')">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>

<?php include __DIR__ . '/../includes/footer.php'; ?>
