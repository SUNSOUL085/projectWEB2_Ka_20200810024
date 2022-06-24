    <title>Jadwal Kereta</title>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Jadwal Kereta</h1>
    </div>

    <?php if ($_SESSION['level'] == 'ADMIN') :  ?>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambah-jadwal">Tambah</button>
    <?php endif; ?>
    <!-- Content Row -->
    <div class="row">
        <div class="card shadow col-12">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Jadwal Kereta</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Kereta</th>
                                <th>Nama Kereta</th>
                                <th>Stasiun Awal</th>
                                <th>Stasiun Tujuan</th>
                                <th>Kedatangan</th>
                                <th>Keberangkatan</th>
                                <th>Tanggal</th>
                                <th>Tarif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = "SELECT jadwal.*, kereta.nama_kereta
                                            FROM jadwal join kereta ON jadwal.id_kereta = kereta.id_kereta";

                            $result = mysqli_query($koneksi, $query);
                            foreach ($result as $rs) :
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $rs['id_kereta'] ?></td>
                                    <td><?= $rs['nama_kereta'] ?></td>
                                    <td><?= $rs['stasiun_awal'] ?></td>
                                    <td><?= $rs['stasiun_tujuan'] ?></td>
                                    <td><?= $rs['kedatangan'] ?></td>
                                    <td><?= $rs['keberangkatan'] ?></td>
                                    <td><?= $rs['tgl_berangkat'] ?></td>
                                    <td><?= 'Rp ' . number_format($rs['harga_tiket'], 0, ',', '.') ?></td>
                                    <td class="text-center">
                                        <!-- Jika level yang masuk adalah admin, maka tombol edit dan delete ditampilkan 
                                            tetapi jika akun user yang masuk maka tombol pesan yang akan ditampilkan
                                        -->
                                        <?php if ($_SESSION['level'] == 'ADMIN') { ?>
                                            <a href="admin.php?menu=edit_jadwal&id=<?= $rs['id_jadwal']; ?>" class="btn btn-sm btn-warning mr-2">Edit</a>
                                            <a href="proses_pesan.php?option=hapusjadwal&id=<?= $rs['id_jadwal']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin akan menghapus data ini ?')">Delete</a>
                                        <?php } else { ?>
                                            <a href="index.php?menu=pesan&id_kereta=<?= $rs['id_kereta'] ?>&id_jadwal=<?= $rs['id_jadwal'] ?>" class="btn btn-success">pesan</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Sturktur Tambah Jadwal -->
    <div class="modal fade" id="tambah-jadwal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <Form action="proses_pesan.php?option=tambahjadwal" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Pilih Kereta</label>
                            <select name="id_kereta" id="" class="form-control">
                                <?php
                                $kereta = mysqli_query($koneksi, "SELECT * FROM kereta ORDER BY id_kereta ASC");
                                foreach ($kereta as $data) :
                                ?>
                                    <option value="<?= $data['id_kereta']; ?>"><?= $data['nama_kereta']; ?></option>

                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Stasiun Awal</label>
                            <input type="text" name="stasiun_awal" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Stasiun Tujuan</label>
                            <input type="text" name="stasiun_tujuan" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Keberangkatan</label>
                            <input type="time" name="keberangkatan" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Kedatangan</label>
                            <input type="time" name="kedatangan" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Berangkat</label>
                            <input type="date" name="tgl_berangkat" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Tarif</label>
                            <input type="number" name="tarif" id="" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </Form>
            </div>
        </div>
    </div>