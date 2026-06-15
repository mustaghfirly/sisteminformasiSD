<?php include 'includes/header.php'; ?>
<?php include 'includes/koneksi.php'; ?>

<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Program Unggulan SD 2 Demaan Kudus</h2>

        <div class="row g-4">
            <?php
            $data = mysqli_query($conn, "SELECT * FROM program_unggulan ORDER BY id DESC");
            while ($p = mysqli_fetch_assoc($data)) {
            ?>
            <div class="col-md-4 col-sm-6">
                <div class="card h-100 shadow text-center">
                    <img src="uploads/program_unggulan/<?= $p['foto'] ?>" 
                         class="card-img-top"
                         style="height:220px; object-fit:cover;">

                    <div class="card-body">
                        <h6 class="card-title"><?= $p['nama'] ?></h6>
                        <p class="card-text text-muted">
                            <?= $p['deskripsi'] ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

    </div>
</section>

<?php include 'includes/footer.php'; ?>
