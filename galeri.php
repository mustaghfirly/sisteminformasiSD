<?php include 'includes/header.php'; ?>
<?php include 'includes/koneksi.php'; ?>

<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Galeri Kegiatan SD 2 Demaan Kudus</h2>

        <div class="row g-4">
            <?php
            $data = mysqli_query($conn, "SELECT * FROM galeri ORDER BY id DESC");
            while ($g = mysqli_fetch_assoc($data)) {
            ?>
            <div class="col-md-3 col-sm-6">
                <div class="card h-100 shadow text-center">
                    <img src="assets/img/galeri/<?= $g['foto'] ?>"
                         class="card-img-top"
                         style="height:220px; object-fit:cover;"
                         alt="<?= $g['judul'] ?>">

                    <div class="card-body">
                        <h6 class="card-title"><?= $g['judul'] ?></h6>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

    </div>
</section>

<?php include 'includes/footer.php'; ?>
