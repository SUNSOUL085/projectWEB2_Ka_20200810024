<title>Pemesanan Kereta</title>
<?php
extract($_GET);
$query = "SELECT jadwal.*, kereta.nama_kereta FROM jadwal join kereta ON jadwal.id_kereta = kereta.id_kereta WHERE id_jadwal = '$id_jadwal'";
$result = mysqli_query($koneksi, $query);
$rs = mysqli_fetch_array($result);

$gerbong = mysqli_query($koneksi, "SELECT * FROM gerbong ORDER BY kelas_gerbong ASC");

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

function id_otomatis()
{
    $id_rsv = "RSV" . randomString();
    return $id_rsv;
}

function id_penumpang_otomatis()
{
    $id_penumpang = 'USER' . randomString();
    return $id_penumpang;
}
?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pesan Kereta</h1>

</div>

<!-- Content Row -->
<div class="row">

    <div class="card shadow col-12">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Jadwal Kereta</h6>
        </div>
        <div class="card-body">
            <form action="proses_pesan.php?option=simpanpesanan" method="post">
                <input type="hidden" name="id_user" id="" value="<?= $_SESSION['id_user']; ?>">
                <div class="row">
                    <div class="col-6">
                        <input type="hidden" name="id_jadwal" id="id_jadwal" value="<?= $id_jadwal ?>">
                        <div class="form-group ">
                            <label for="id_reservasi">id_reservasi</label>
                            <input type="text" class="form-control" id="id_reservasi" name="id_reservasi" autocomplete="off" value="<?= id_otomatis(); ?>" required readonly>
                        </div>
                        <div class="form-group ">
                            <label for="id_kereta">No kereta</label>
                            <input type="text" class="form-control" id="id_kereta" name="id_kereta" autocomplete="off" value="<?= $id_kereta ?>" readonly>
                        </div>

                        <div class="form-group ">
                            <label for="id_gerbong">kelas</label>
                            <select class="form-control" id="id_gerbong" name="id_gerbong">
                                <?php foreach ($gerbong as $g) : ?>
                                    <option value="<?= $g['id_gerbong']; ?>"><?= $g['kelas_gerbong']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group ">
                            <label for="tgl_berangkat">tgl_berangkat</label>
                            <input type="date" class="form-control" id="tgl_berangkat" name="tgl_berangkat" autocomplete="off" value="<?= $rs['tgl_berangkat']; ?>" required readonly>
                        </div>
                        <div class="form-group ">
                            <label for="tgl_pesan">tgl_pesan</label>
                            <input type="date" class="form-control" id="tgl_pesan" name="tgl_pesan" autocomplete="off" value="" required>
                        </div>
                        <div class="form-group ">
                            <label for="Keberangkatan">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" autocomplete="off" value="">
                        </div>
                        <div class="form-group ">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group ">
                            <label for="id_penumpang">id penumpang</label>
                            <input type="text" class="form-control" id="id_penumpang" name="id_penumpang" autocomplete="off" value="<?= id_penumpang_otomatis(); ?>" readonly>
                        </div>
                        <div class="form-group ">
                            <label for="nama_kereta">nama kereta</label>
                            <input type="text" class="form-control" id="nama_kereta" name="nama_kereta" autocomplete="off" value="<?= $rs['nama_kereta'] ?>" readonly>
                        </div>
                        <div class="form-group ">
                            <label for="nama_penumpang">nama penumpang</label>
                            <input type="text" class="form-control" id="nama_penumpang" name="nama_penumpang" autocomplete="off" value="<?= $_SESSION['username']; ?>">
                        </div>
                        <div class="form-group ">
                            <label for="jurusan">jurusan</label>
                            <input type="text" class="form-control" id="jurusan" name="jurusan" autocomplete="off" value="<?= $rs['stasiun_awal'] . ' - ' . $rs['stasiun_tujuan'] ?>" readonly>
                        </div>
                        <div class="form-group ">
                            <label for="Keberangkatan">Keberangkatan</label>
                            <input type="text" class="form-control" id="Keberangkatan" name="Keberangkatan" autocomplete="off" value="<?= $rs['keberangkatan'] . ' - ' . $rs['kedatangan'] ?>" readonly>
                        </div>
                        <div class="form-group ">
                            <label for="Keberangkatan">No HP</label>
                            <input type="text" class="form-control" id="tarif" name="nohp" autocomplete="off" value="">
                        </div>
                        <div class="form-group ">
                            <label for="Keberangkatan">Tarif</label>
                            <input type="text" class="form-control" id="tarif" name="Keberangkatan" autocomplete="off" value="<?= 'Rp ' . number_format($rs['harga_tiket'], 0, ',', '.') ?>" readonly>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <!-- <input type="button" name="cek" class="btn btn-secondary" data-dismiss="modal" value="cek" onClick="cek()"> -->
                    <button type="submit" class="btn btn-primary">PESAN</button>
            </form>
        </div>
    </div>
</div>
</div>

<!-- Content Row -->