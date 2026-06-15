<?php include 'includes/header.php'; ?>
<?php include 'includes/koneksi.php'; ?>

<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Ekstrakurikuler SD 2 Demaan Kudus</h2>

        <div class="row g-4">
            <?php
            $data = mysqli_query($conn, "SELECT * FROM ekstrakurikuler ORDER BY id DESC");
            while ($e = mysqli_fetch_assoc($data)) {
            ?>
            <div class="col-md-3 col-sm-6">
                <div class="card h-100 shadow text-center">
                    <img src="assets/img/ekstrakurikuler/<?= $e['gambar'] ?>"
                         class="card-img-top"
                         style="height:220px; object-fit:cover;">

                    <div class="card-body">
                        <h6 class="card-title"><?= $e['nama'] ?></h6>
                        <p class="card-text text-muted">
                            <?= $e['deskripsi'] ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

    </div>
</section>

<?php include 'includes/footer.php'; ?>
