<?php
// Tentukan jumlah data per halaman
$jumlah_data_per_halaman = 10;

// Ambil nomor halaman dari URL, jika tidak ada, default ke halaman 1
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
if ($halaman < 1) $halaman = 1;

// Hitung offset untuk query SQL
$offset = ($halaman - 1) * $jumlah_data_per_halaman;

// Hitung total jumlah data
$sql_total_data = "SELECT COUNT(*) AS total FROM menu";
$query_total_data = mysqli_query($koneksi, $sql_total_data);
$total_data = mysqli_fetch_assoc($query_total_data)['total'];

// Hitung total halaman
$total_halaman = ceil($total_data / $jumlah_data_per_halaman);

// Ambil data sesuai halaman
$sql_menu = "SELECT * FROM menu LIMIT $offset, $jumlah_data_per_halaman";
$query_menu = mysqli_query($koneksi, $sql_menu);
?>

<div class="row  justify-content-center mt-3">
    <div class="col-8">
        <div class="card shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title">DAFTAR MENU</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahMenu">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-plus-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5m6.5-11a.5.5 0 0 0-1 0V6H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V7H10a.5.5 0 0 0 0-1H8.5z" />
                        </svg>
                        Tambah Menu
                    </button>
                    <div class="modal fade" id="tambahMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="modul/menu/aksi.php?aksi=tambah" method="POST">
                                        <div class="mb-3">
                                            <label for="nama_menu" class="form-label">Nama Menu</label>
                                            <input type="text" class="form-control" id="nama_menu" name="nama_menu" placeholder="Contoh: Nasi Goreng" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="harga" class="form-label">Harga</label>
                                            <input type="number" class="form-control" id="harga" name="harga" placeholder="Contoh: 10000" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="diskon" class="form-label">Diskon</label>
                                            <input type="number" class="form-control" id="diskon" name="diskon" placeholder="Contoh: 10000" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kategori" class="form-label">Kategori</label>
                                            <select class="form-select" id="kategori" name="kategori" required>
                                                <option value="Makanan">Makanan</option>
                                                <option value="Minuman">Minuman</option>
                                            </select>
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                                                    <path d="M11 2H9v3h2z" />
                                                    <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z" />
                                                </svg>
                                                Simpan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Menu</th>
                                <th>Harga</th>
                                <th>Diskon</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = $offset + 1;
                            while ($data_menu = mysqli_fetch_array($query_menu)) {
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data_menu['nama_menu']; ?></td>
                                    <td>Rp. <?= number_format($data_menu['harga'], 0); ?></td>
                                    <td>Rp. <?= number_format($data_menu['diskon'], 0) ?></td>
                                    <td><?= $data_menu['kategori']; ?></td>
                                    <td>
                                        <?= $data_menu['status'] == 1 ? 'Aktif' : 'Tidak Aktif'; ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editMenu<?= $data_menu['id']; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                            </svg>
                                        </button>
                                        <div class="modal fade" id="editMenu<?= $data_menu['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="modul/menu/aksi.php?aksi=update&id=<?= $data_menu['id']; ?>" method="POST">
                                                            <div class="mb-3">
                                                                <label for="nama_menu" class="form-label">Nama Menu</label>
                                                                <input type="text" class="form-control" id="nama_menu" name="nama_menu" value="<?= $data_menu['nama_menu']; ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="harga" class="form-label">Harga</label>
                                                                <input type="number" class="form-control" id="harga" name="harga" value="<?= $data_menu['harga']; ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="diskon" class="form-label">Diskon</label>
                                                                <input type="number" class="form-control" id="diskon" name="diskon" value="<?= $data_menu['diskon']; ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="kategori" class="form-label">Kategori</label>
                                                                <select class="form-select" id="kategori" name="kategori" required>
                                                                    <option value="Makanan" <?= $data_menu['kategori'] == 'Makanan' ? 'selected' : ''; ?>>Makanan</option>
                                                                    <option value="Snack" <?= $data_menu['kategori'] == 'Snack' ? 'selected' : ''; ?>>Snack</option>
                                                                    <option value="Minuman" <?= $data_menu['kategori'] == 'Minuman' ? 'selected' : ''; ?>>Minuman</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="status" class="form-label">Status</label>
                                                                <select class="form-select" id="status" name="status" required>
                                                                    <option value="1" <?= $data_menu['status'] == 1 ? 'selected' : ''; ?>>Aktif</option>
                                                                    <option value="0" <?= $data_menu['status'] == 0 ? 'selected' : ''; ?>>Tidak Aktif</option>
                                                                </select>
                                                            </div>
                                                            <div class="text-end">
                                                                <input type="hidden" name="id" value="<?= $data_menu['id']; ?>">
                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        // cek menu tidak ada di detail_penjualan
                                        $cek_menu = $koneksi->query("SELECT * FROM detail_penjualan WHERE id_menu = '$data_menu[id]'")->num_rows;
                                        if ($cek_menu == 0) {
                                        ?>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusMenu<?= $data_menu['id']; ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                                </svg>
                                            </button>
                                        <?php
                                        }
                                        ?>
                                        <div class="modal fade" id="hapusMenu<?= $data_menu['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Menu</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin ingin menghapus menu <?= $data_menu['nama_menu']; ?>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <a href="modul/menu/aksi.php?aksi=hapus&id=<?= $data_menu['id']; ?>" class="btn btn-danger">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php if ($halaman > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?module=menu&halaman=<?= $halaman - 1; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_halaman; $i++) : ?>
                            <li class="page-item <?= $i == $halaman ? 'active' : ''; ?>">
                                <a class="page-link" href="?module=menu&halaman=<?= $i; ?>"><?= $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($halaman < $total_halaman) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?module=menu&halaman=<?= $halaman + 1; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>