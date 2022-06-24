<title>Pembayaran</title>
<?php
extract($_GET);
$query = mysqli_query($koneksi, "SELECT * FROM reservasi2 
        inner join penumpang on reservasi2.id_penumpang=penumpang.id_penumpang 
        inner join jadwal on reservasi2.id_jadwal=jadwal.id_jadwal 
        where id_reservasi='$id_reservasi'");
$trx = mysqli_fetch_array($query);
function randomString()
{
    $characters = '0123456789ab';
    $randomString = '';
    for ($i = 0; $i < 5; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    return $randomString;
}

function id_trx_otomatis()
{
    $id_trx = "TRX" . randomString();
    return $id_trx;
}
?>
<div class="card shadow col-6">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pembayaran</h6>
    </div>
    <form action="proses_pesan.php?option=pembayaran" method="post">
        <input type="hidden" name="id_transaksi" id="" value="<?= id_trx_otomatis(); ?>">
        <div class="card-body">
            <div class="form-group">
                <label for="id_reservasi">No Reservasi</label>
                <input type="text" class="form-control" id="id_reservasi" name="id_reservasi" autocomplete="off" required readonly value="<?= $trx['id_reservasi']; ?>">
            </div>

            <div class="form-group">
                <label for="nama_penumpang">Nama Penumpang</label>
                <input type="text" class="form-control" id="nama_penumpang" name="nama_penumpang" autocomplete="off" value="<?= $trx['nama_penumpang']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="tujuan">Tujuan</label>
                <input type="text" class="form-control" id="tujuan" name="tujuan" autocomplete="off" value="<?= $trx['stasiun_awal'] . ' - ' . $trx['stasiun_tujuan']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="waktu">Waktu </label>
                <input type="text" class="form-control" id="waktu" name="waktu" autocomplete="off" value="<?= $trx['tgl_berangkat'] . ' ' . $trx['keberangkatan']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="tgl_bayar">Tanggal Bayar </label>
                <input type="date" class="form-control" id="tgl_bayar" name="tgl_bayar" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="total">Total Bayar </label>
                <input type="text" class="form-control" id="total" name="total" autocomplete="off" value="<?= $trx['harga_tiket']; ?>" readonly>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
        </div>
    </form>
</div>