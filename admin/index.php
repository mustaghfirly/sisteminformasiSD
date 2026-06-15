<?php
include __DIR__ . '/includes/auth.php';
include __DIR__ . '/../includes/koneksi.php';
include __DIR__ . '/includes/header.php';
?>

<h3 class="mb-4">Dashboard Admin</h3>

<div class="row g-4">

    <div class="col-md-3">
        <div class="card shadow menu-card text-center">
            <div class="card-body">
                <h5>Guru</h5>
                <p class="text-muted">Kelola data guru</p>
                <a href="pages/guru.php" class="btn btn-primary btn-sm">Kelola</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow menu-card text-center">
            <div class="card-body">
                <h5>Program Unggulan</h5>
                <p class="text-muted">Kelola program</p>
                <a href="pages/program_unggulan.php" class="btn btn-primary btn-sm">Kelola</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow menu-card text-center">
            <div class="card-body">
                <h5>Ekstrakurikuler</h5>
                <p class="text-muted">Kelola kegiatan</p>
                <a href="pages/ekstrakurikuler.php" class="btn btn-primary btn-sm">Kelola</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow menu-card text-center">
            <div class="card-body">
                <h5>Galeri</h5>
                <p class="text-muted">Kelola foto</p>
                <a href="pages/galeri.php" class="btn btn-primary btn-sm">Kelola</a>
            </div>
        </div>
    </div>

</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
