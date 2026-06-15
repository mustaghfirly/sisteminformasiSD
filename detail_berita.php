<?php
include 'includes/header.php';
include 'includes/config.php';

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM berita WHERE id='$id'");
$data = mysqli_fetch_assoc($query);
?>

<section class="py-5">
    <div class="container">

        <a href="berita.php" class="btn btn-secondary mb-3">← Kembali ke Berita</a>

        <h1 class="mb-3"><?php echo $data['judul']; ?></h1>

        <p class="text-muted">
            <?php echo date('d M Y', strtotime($data['tanggal'])); ?>
        </p>

        <img src="assets/img/berita/<?php echo $data['gambar']; ?>" 
             class="img-fluid mb-4 rounded shadow" alt="Berita">

        <p>
            <?php echo nl2br($data['isi']); ?>
        </p>

    </div>
</section>

<?php include 'includes/footer.php'; ?>
