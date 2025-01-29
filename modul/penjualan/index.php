<div class="row mt-3 justify-content-center">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Penjualan</h5>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Meja</th>
                                <th>Total Diskon</th>
                                <th>Total Pembayaran</th>
                                <th>Status</th>
                                <th>Tunai</th>
                                <th>Kembalian</th>
                                <th>Catatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Jumlah data per halaman
                            $per_halaman = 10;

                            // Hitung total data
                            $sql_total = "SELECT COUNT(*) FROM penjualan";
                            $result_total = mysqli_query($koneksi, $sql_total);
                            $total_data = mysqli_fetch_row($result_total)[0];

                            // Hitung jumlah halaman
                            $total_halaman = ceil($total_data / $per_halaman);

                            // Ambil halaman saat ini
                            $halaman = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            $halaman = max($halaman, 1); // Pastikan halaman tidak kurang dari 1

                            // Hitung offset untuk query
                            $offset = ($halaman - 1) * $per_halaman;

                            // Query untuk menampilkan data penjualan berdasarkan halaman
                            $sql = $koneksi->query("SELECT a.id AS id_penjualan, a.tanggal, a.total_diskon, a.total_pembayaran, a.status, a.tunai, a.kembalian, a.catatan, b.nama_meja 
                                                     FROM penjualan a 
                                                     INNER JOIN meja b ON a.id_meja = b.id 
                                                     ORDER BY a.tanggal DESC LIMIT $offset, $per_halaman");
                            $no = $offset + 1;
                            while ($data = $sql->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data['tanggal']; ?></td>
                                    <td><?= $data['nama_meja']; ?></td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <span>Rp.</span>
                                            <span>
                                                <?= number_format($data['total_diskon'], 0); ?>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between"> <span>Rp.</span> <span><?= number_format($data['total_pembayaran'], 0); ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                        if ($data['status'] == 'Proses') {
                                        ?>
                                            <span class="badge bg-warning">Proses</span>
                                        <?php
                                        } elseif ($data['status'] == 'Selesai') {
                                        ?>
                                            <span class="badge bg-success">Selesai</span>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <span>Rp.</span>
                                            <span>
                                                <?php
                                                if ($data['tunai'] == null) {
                                                    echo "0";
                                                } else {
                                                    number_format($data['tunai'], 0);
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <span>Rp.</span>
                                            <span>
                                                <?php
                                                if ($data['kembalian'] == 0) {
                                                    echo "0";
                                                } else {
                                                    number_format($data['kembalian'], 0);
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    </td>
                                    <td><?= $data['catatan'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailPenjualan<?= $data['id_penjualan']; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                            </svg>
                                        </button>
                                        <?php
                                        if ($data['status'] == 'Proses') {
                                        ?>
                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#bayarPenjualan<?= $data['id_penjualan']; ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0" />
                                                    <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z" />
                                                    <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z" />
                                                    <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567" />
                                                </svg>
                                            </button>
                                        <?php
                                        }
                                        ?>
                                        <button type="button" class="btn btn-warning btn-sm" onclick="cetakStruk(<?= $data['id_penjualan']; ?>)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                                                <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1" />
                                                <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                                            </svg>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="hapusPenjualan(<?= $data['id_penjualan']; ?>)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                            </svg>
                                        </button>
                                        <div class="modal fade" id="detailPenjualan<?= $data['id_penjualan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Detail Penjualan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Tanggal</label>
                                                                    <input type="text" class="form-control bg-light" value="<?= $data['tanggal']; ?>" readonly>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Meja</label>
                                                                    <input type="text" class="form-control bg-light" value="<?= $data['nama_meja']; ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table class="table table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Nama Menu</th>
                                                                        <th>Harga</th>
                                                                        <th>Diskon</th>
                                                                        <th>Qty</th>
                                                                        <th>Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $query = $koneksi->query("SELECT * FROM detail_penjualan a 
                                                                                               INNER JOIN menu b ON a.id_menu = b.id 
                                                                                               WHERE a.id_penjualan = '" . $data['id_penjualan'] . "'");
                                                                    $no = 1;
                                                                    while ($row = $query->fetch_assoc()) {
                                                                    ?>
                                                                        <tr>
                                                                            <td><?= $no++; ?></td>
                                                                            <td><?= $row['nama_menu']; ?></td>
                                                                            <td>
                                                                                <div class="d-flex justify-content-between">
                                                                                    <span>Rp.</span>
                                                                                    <span>
                                                                                        <?= number_format($row['harga'], 0); ?>
                                                                                    </span>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="d-flex justify-content-between">
                                                                                    <span>Rp.</span>
                                                                                    <span>
                                                                                        <?= number_format($row['diskon'], 0); ?>
                                                                                    </span>
                                                                                </div>
                                                                            </td>
                                                                            <td><?= $row['jumlah']; ?></td>
                                                                            <td>
                                                                                <div class="d-flex justify-content-between">
                                                                                    <span>Rp.</span>
                                                                                    <span>
                                                                                        <?= number_format($row['total'], 0); ?>
                                                                                    </span>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    <tr class="fw-bold">
                                                                        <td colspan="5">Total Diskon</td>
                                                                        <td>
                                                                            <div class="d-flex justify-content-between">
                                                                                <span>Rp.</span>
                                                                                <span>
                                                                                    <?= number_format($data['total_diskon'], 0); ?>
                                                                                </span>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="fw-bold">
                                                                        <td colspan="5">Total Pembayaran</td>
                                                                        <td>
                                                                            <div class="d-flex justify-content-between">
                                                                                <span>Rp.</span>
                                                                                <span>
                                                                                    <?= number_format($data['total_pembayaran'], 0); ?>
                                                                                </span>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="bayarPenjualan<?= $data['id_penjualan']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Bayar Penjualan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="modul/penjualan/aksi.php?aksi=bayar&id=<?= $data['id_penjualan']; ?>" method="post">
                                                            <div class="mb-3">
                                                                <label for="total_pembayaran" class="form-label">Total Pembayaran</label>
                                                                <input type="number" class="form-control" id="total_pembayaran" name="total_pembayaran" value="<?= $data['total_pembayaran']; ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="tunai" class="form-label">Tunai</label>
                                                                <input type="number" class="form-control" id="tunai" name="tunai" placeholder="Contoh: 100.000" oninput="hitungKembalian()" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="kembalian" class="form-label">Kembalian</label>
                                                                <input type="number" class="form-control bg-light" id="kembalian" name="kembalian" placeholder="Contoh: 100.000" readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="catatan" class="form-label">Catatan</label>
                                                                <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                                                            </div>
                                                            <div class="text-end">
                                                                <button type="submit" class="btn btn-primary" name="bayar">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                                                        <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0" />
                                                                        <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z" />
                                                                        <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z" />
                                                                        <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567" />
                                                                    </svg>
                                                                    Bayar
                                                                </button>
                                                            </div>
                                                        </form>
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
                            <a class="page-link" href="?module=penjualan&page=<?= max(1, $halaman - 1); ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        <!-- Page Numbers -->
                        <?php
                        $start = max(1, $halaman - 2);
                        $end = min($total_halaman, $halaman + 2);

                        if ($start > 1) {
                            echo '<li class="page-item"><a class="page-link" href="?module=penjualan&page=1">1</a></li>';
                            if ($start > 2) {
                                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                            }
                        }

                        for ($i = $start; $i <= $end; $i++) :
                        ?>
                            <li class="page-item <?= $i == $halaman ? 'active' : ''; ?>">
                                <a class="page-link" href="?module=penjualan&page=<?= $i; ?>"><?= $i; ?></a>
                            </li>
                        <?php endfor;

                        if ($end < $total_halaman) {
                            if ($end < $total_halaman - 1) {
                                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                            }
                            echo '<li class="page-item"><a class="page-link" href="?module=penjualan&page=' . $total_halaman . '">' . $total_halaman . '</a></li>';
                        }
                        ?>

                        <!-- Next Button -->
                        <li class="page-item <?= $halaman >= $total_halaman ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?module=penjualan&page=<?= min($total_halaman, $halaman + 1); ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<script>
    function hapusPenjualan(id) {
        if (confirm("Apakah anda yakin ingin menghapus penjualan ini?")) {
            window.location.href = "modul/penjualan/aksi.php?aksi=hapus&id=" + id;
        }
    }

    function bayarPenjualan(id) {
        if (confirm("Apakah anda yakin ingin membatalkan penjualan ini?")) {
            window.location.href = "modul/penjualan/aksi.php?aksi=bayar&id=" + id;
        }
    }

    function cetakStruk(id) {
        const printWindow = window.open(`modul/penjualan/cetak_struk.php?id=${id}`, '_blank');
        printWindow.focus();
    }

    function hitungKembalian() {
        const total_pembayaran = document.getElementById('total_pembayaran').value;
        const tunai = document.getElementById('tunai').value;
        const kembalian = tunai - total_pembayaran;
        document.getElementById('kembalian').value = kembalian;
    }
</script>