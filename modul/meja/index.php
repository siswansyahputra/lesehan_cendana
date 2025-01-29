<div class="row justify-content-center mt-3">
    <div class="col-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Nomor Meja</h5>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Meja</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Jumlah data per halaman
                            $per_halaman = 10;

                            // Hitung jumlah total data
                            $sql_total = "SELECT COUNT(*) FROM meja";
                            $result_total = mysqli_query($koneksi, $sql_total);
                            $total_data = mysqli_fetch_row($result_total)[0];

                            // Hitung jumlah halaman
                            $total_halaman = ceil($total_data / $per_halaman);

                            // Ambil halaman saat ini
                            $halaman = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            $halaman = max($halaman, 1); // Pastikan halaman tidak kurang dari 1

                            // Hitung offset (data mulai dari mana)
                            $offset = ($halaman - 1) * $per_halaman;

                            // Query untuk menampilkan data sesuai halaman
                            $sql = "SELECT * FROM meja LIMIT $offset, $per_halaman";
                            $query = mysqli_query($koneksi, $sql);

                            $no = $offset + 1; // Nomor urut berdasarkan halaman
                            while ($data = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data['nama_meja']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editMeja<?= $data['id']; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                            </svg>
                                        </button>
                                        <?php
                                        // cek meja tidak ada di penjualan
                                        $cek_meja = $koneksi->query("SELECT * FROM penjualan WHERE id_meja = '$data[id]'")->num_rows;
                                        if ($cek_meja == 0) {
                                        ?>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusMeja<?= $data['id']; ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                                </svg>
                                            </button>
                                        <?php
                                        }
                                        ?>
                                        <div class="modal fade" id="editMeja<?= $data['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Nomor Meja</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="modul/meja/aksi.php?aksi=edit&id=<?= $data['id']; ?>" method="post">
                                                            <div class="mb-3">
                                                                <label for="nama_meja" class="form-label">Nama Meja</label>
                                                                <input type="text" class="form-control" id="nama_meja" name="nama_meja" value="<?= $data['nama_meja']; ?>" required>
                                                            </div>
                                                            <div class="mb-3 text-end">
                                                                <button type="submit" name="edit" class="btn btn-primary">
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
                                        <div class="modal fade" id="hapusMeja<?= $data['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Nomor Meja</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin ingin menghapus nomor meja <?= $data['nama_meja']; ?>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <a href="modul/meja/aksi.php?aksi=hapus&id=<?= $data['id']; ?>" class="btn btn-danger">Hapus</a>
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
                        <!-- Prev Button -->
                        <li class="page-item <?= $halaman <= 1 ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?module=meja&page=<?= max(1, $halaman - 1); ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        <!-- Page Numbers -->
                        <?php
                        $start = max(1, $halaman - 2);
                        $end = min($total_halaman, $halaman + 2);

                        if ($start > 1) {
                            echo '<li class="page-item"><a class="page-link" href="?module=meja&page=1">1</a></li>';
                            if ($start > 2) {
                                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                            }
                        }

                        for ($i = $start; $i <= $end; $i++) :
                        ?>
                            <li class="page-item <?= $i == $halaman ? 'active' : ''; ?>">
                                <a class="page-link" href="?module=meja&page=<?= $i; ?>"><?= $i; ?></a>
                            </li>
                        <?php endfor;

                        if ($end < $total_halaman) {
                            if ($end < $total_halaman - 1) {
                                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                            }
                            echo '<li class="page-item"><a class="page-link" href="?module=meja&page=' . $total_halaman . '">' . $total_halaman . '</a></li>';
                        }
                        ?>

                        <!-- Next Button -->
                        <li class="page-item <?= $halaman >= $total_halaman ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?module=meja&page=<?= min($total_halaman, $halaman + 1); ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Tambah Nomor Meja</h5>
                <hr>
                <form action="modul/meja/aksi.php?aksi=tambah" method="post">
                    <div class="mb-3">
                        <label for="nama_meja" class="form-label">Nama Meja</label>
                        <input type="text" class="form-control" id="nama_meja" name="nama_meja" required>
                    </div>
                    <div class="mb-3 text-end">
                        <button type="submit" name="tambah" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                            </svg>
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>