<div class="row mt-3">
    <div class="col-8">
        <div class="card" style="height: 70%;">
            <div class="card-body">
                <h5 class="card-title">Detail Pesanan</h5>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Menu</th>
                                <th>Harga (Rp.)</th>
                                <th>Diskon (Rp.)</th>
                                <th>Qty</th>
                                <th>Total (Rp.)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Proses Pesanan</h5>
                <hr>
                <div class="row">
                    <div class="col">
                        <label for="total_diskon" class="form-label">Total Diskon (Rp.)</label>
                        <input type="text" class="form-control bg-light" id="total_diskon" name="total_diskon" readonly>
                    </div>
                    <div class="col">
                        <label for="total_pembayaran" class="form-label">Total Pembayaran (Rp.)</label>
                        <input type="text" class="form-control bg-light" id="total_pembayaran" name="total_pembayaran" readonly>
                    </div>
                    <div class="col">
                        <label for="pilih_meja" class="form-label">Pilih Meja</label>
                        <select name="pilih_meja" id="pilih_meja" class="form-select" onchange="pilihMeja()" disabled required>
                            <option value="">-- Pilih Meja --</option>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT * FROM meja");
                            while ($data = mysqli_fetch_array($query)) {
                            ?>
                                <option
                                    value="<?= $data['id']; ?>"
                                    data-id="<?= $data['id']; ?>"
                                    data-nama="<?= $data['nama_meja']; ?>">
                                    <?= $data['nama_meja']; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col align-self-end">
                        <button type="reset" class="btn btn-secondary w-100 mb-1" onclick="resetAll()">Reset</button>
                        <button type="submit" name="simpan" id="simpan" class="btn btn-primary w-100" onclick="simpanPesanan()">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Atur Pesanan</h5>
                <hr>
                <div class="mb-3">
                    <label for="item" class="form-label">Item</label>
                    <select name="item" id="item" class="form-select" required onchange="pilihItem()">
                        <option value="">-- Pilih Item --</option>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM menu WHERE status = 1 order by kategori asc");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                            <option
                                value="<?= $data['id']; ?>"
                                data-id="<?= $data['id']; ?>"
                                data-harga="<?= $data['harga']; ?>"
                                data-diskon="<?= $data['diskon']; ?>">
                                <?= $data['kategori']; ?> - <?= $data['nama_menu']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="text" class="form-control" id="harga" name="harga" readonly>
                </div>
                <div class="mb-3">
                    <label for="diskon" class="form-label">Diskon</label>
                    <input type="text" class="form-control" id="diskon" name="diskon" readonly>
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" oninput="hitungTotal()" required>
                </div>
                <div class="mb-3">
                    <label for="total" class="form-label">Total</label>
                    <input type="text" class="form-control" id="total" name="total" readonly>
                </div>
                <div class="d-flex gap-2">
                    <button type="reset" class="btn btn-secondary w-100" onclick="resetItem()">Reset</button>
                    <button type="button" id="tambah" class="btn btn-primary w-100" disabled onclick="tambahPesanan()">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        updateTable();
        totalPesanan();
        // jika ada data pesanan di local storage
        if (localStorage.getItem('pesanan')) {
            document.getElementById('pilih_meja').disabled = false;
        }
    })

    function resetItem() {
        const item = document.getElementById('item');
        const hargaInput = document.getElementById('harga');
        const diskonInput = document.getElementById('diskon');
        const jumlahInput = document.getElementById('jumlah');
        const totalInput = document.getElementById('total');
        const buttonTambah = document.getElementById('tambah');
        item.value = '';
        hargaInput.value = '';
        diskonInput.value = '';
        jumlahInput.value = '';
        totalInput.value = '';
        buttonTambah.disabled = true;
    }
    function pilihItem() {
        const item = document.getElementById('item');
        const data_harga = item.options[item.selectedIndex].getAttribute('data-harga');
        const data_diskon = item.options[item.selectedIndex].getAttribute('data-diskon');
        const hargaInput = document.getElementById('harga').value = data_harga;
        const diskonInput = document.getElementById('diskon').value = data_diskon;
        const jumlahInput = document.getElementById('jumlah');
        const totalInput = document.getElementById('total');
        const buttonTambah = document.getElementById('tambah');
        jumlahInput.value = 1;
        jumlahInput.auofocus = true;
        totalInput.value = data_harga - data_diskon;
        buttonTambah.disabled = false;
    }

    function hitungTotal() {
        const harga = document.getElementById('harga').value;
        const diskon = document.getElementById('diskon').value;
        const jumlah = document.getElementById('jumlah').value;
        const total = (harga - diskon) * jumlah;
        document.getElementById('total').value = total;
    }

    function tambahPesanan() {
        const item = document.getElementById('item');
        const id = item.options[item.selectedIndex].getAttribute('data-id');
        const harga = item.options[item.selectedIndex].getAttribute('data-harga');
        const diskon = item.options[item.selectedIndex].getAttribute('data-diskon');
        const jumlah = document.getElementById('jumlah').value;
        const total = (harga - diskon) * jumlah;
        const pesanan = JSON.parse(localStorage.getItem('pesanan')) || [];
        const index = pesanan.findIndex(p => p.id === id);
        if (index !== -1) {
            pesanan[index].jumlah += parseInt(jumlah);
            pesanan[index].total += parseInt(total);
        } else {
            pesanan.push({
                id: id,
                item: item.options[item.selectedIndex].text,
                harga: harga,
                diskon: diskon,
                jumlah: parseInt(jumlah),
                total: parseInt(total)
            });
        }
        localStorage.setItem('pesanan', JSON.stringify(pesanan));
        document.getElementById('pilih_meja').disabled = false;
        updateTable();
        totalPesanan();
        resetForm();
    }

    function updateTable() {
        const pesanan = JSON.parse(localStorage.getItem('pesanan')) || [];
        const table = document.querySelector('tbody');
        table.innerHTML = '';
        pesanan.forEach((item, index) => {
            table.innerHTML += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.item}</td>
                    <td>${item.harga}</td>
                    <td>${item.diskon}</td>
                    <td>${item.jumlah}</td>
                    <td>${item.total}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapusPesanan(${index})">Hapus</button>
                    </td>
                </tr>
            `;
        });
    }

    function resetForm() {
        document.getElementById('item').value = '';
        document.getElementById('harga').value = '';
        document.getElementById('diskon').value = '';
        document.getElementById('jumlah').value = '';
        document.getElementById('total').value = '';
    }

    function hapusPesanan(index) {
        const pesanan = JSON.parse(localStorage.getItem('pesanan')) || [];
        pesanan.splice(index, 1);
        localStorage.setItem('pesanan', JSON.stringify(pesanan));
        updateTable();
        totalPesanan();
    }

    function totalPesanan() {
        const pesanan = JSON.parse(localStorage.getItem('pesanan')) || [];
        let diskon = 0;
        let total = 0;
        pesanan.forEach(item => {
            total += item.total;
            diskon += item.diskon * item.jumlah;
        });
        // simpan ke local storage
        localStorage.setItem('diskon', diskon);
        localStorage.setItem('total', total);
        document.getElementById('total_diskon').value = diskon;
        document.getElementById('total_pembayaran').value = total;
    }

    function pilihMeja() {
        const meja = document.getElementById('pilih_meja');
        const id = meja.options[meja.selectedIndex].getAttribute('data-id');
        const nama = meja.options[meja.selectedIndex].getAttribute('data-nama');
        localStorage.setItem('id_meja', id);
        localStorage.setItem('nama_meja', nama);
    }

    function resetAll() {
        localStorage.clear();
        updateTable();
        document.getElementById('pilih_meja').value = '';
        document.getElementById('pilih_meja').disabled = true;
    }

    function simpanPesanan() {
        // tampilkan pesan konfirmasi terlebih dahulu

        $confirm = confirm("Apakah anda yakin ingin menyimpan pesanan?");
        if ($confirm == false) {
            return false;
        } else {
            const id_meja = localStorage.getItem('id_meja');
            if (!id_meja) {
                alert('Pilih meja terlebih dahulu');
                return false;
            } else {
                const nama_meja = localStorage.getItem('nama_meja');
                const pesanan = JSON.parse(localStorage.getItem('pesanan')) || [];
                const total_diskon = localStorage.getItem('diskon');
                const total_pembayaran = localStorage.getItem('total');
                const data = {
                    id_meja: id_meja,
                    nama_meja: nama_meja,
                    pesanan: pesanan,
                    total_diskon: total_diskon,
                    total_pembayaran: total_pembayaran
                }
                fetch('modul/kasir/aksi.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.status === 'success') {
                            resetAll();
                            updateTable();
                            totalPesanan();
                            alert(result.message);
                        } else {
                            alert(result.message);
                        }
                    })
                    .catch(error => {
                        alert('Error:', error);
                        console.error('Error:', error);
                    });
            }
        }
    }
</script>