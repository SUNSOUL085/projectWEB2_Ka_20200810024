<?php
include 'koneksi.php';
extract($_POST);

// Jalur untuk memanggil function (hanya alternatif / solusi saat ini)
if (isset($_GET['option'])) {
    $option = $_GET['option'];
    if ($option == 'simpanpesanan') {
        simpan_reservasi();
    } else if ($option == 'pembayaran') {
        pembayaran();
    } else if ($option == 'tambahkereta') {
        tambah_kereta();
    } else if ($option == 'hapuskereta') {
        hapus_kereta();
    } else if ($option == 'editkereta') {
        edit_kereta();
    } else if ($option == 'hapusjadwal') {
        hapus_jadwal();
    } else if ($option == 'tambahjadwal') {
        tambah_jadwal();
    } else if ($option == 'editjadwal') {
        edit_jadwal();
    }
}


function cari_gerbong($id, $kelas)
{
    global $koneksi;
    $query = "SELECT gerbong.id_gerbong FROM gerbong WHERE id_kereta = '$id' AND kelas_gerbong = '$kelas'";
    $result = mysqli_query($koneksi, $query);
    $rs = mysqli_fetch_array($result);
    return $rs['id_gerbong'];
}
// cari_gerbong($id_kereta,$kelas);


function simpan_reservasi()
{
    global $koneksi;
    extract($_POST);
    // simpan data ke table penumpang
    $queryPenumpang = "INSERT INTO penumpang (id_penumpang, id_user, nama_penumpang, alamat, gender, no_tlp) VALUES ('$id_penumpang','$id_user','$nama_penumpang','$alamat','$gender','$nohp')";
    $simpanPenumpang = mysqli_query($koneksi, $queryPenumpang);
    if ($simpanPenumpang) {
        //  simpan data ke table reservasi    
        $queryReservasi = "INSERT INTO reservasi2 (id_reservasi, id_penumpang,id_user, id_jadwal, id_gerbong, tgl_berangkat, tgl_pesan, status_bayar) VALUES ('$id_reservasi','$id_penumpang','$id_user','$id_jadwal','$id_gerbong','$tgl_berangkat','$tgl_pesan', 'belum')";
        $simpanReservasi = mysqli_query($koneksi, $queryReservasi);
        if ($simpanReservasi) {
            echo "<script>alert('bisa');</script>";
            header("location: index.php?menu=bayar&id_reservasi=$id_reservasi");
        } else {
            echo "<script>alert('gagal');</script>";
            header("location: index.php?menu=pesan&id_kereta=$id_kereta&id_jadwal=$id_jadwal");
        }
    }
}

function pembayaran()
{
    global $koneksi;
    extract($_POST);
    $simpanTransaksi = mysqli_query($koneksi, "INSERT INTO transaksi (id_transaksi, tgl_bayar, jumlah, total_bayar, id_reservasi) VALUES ('$id_transaksi','$tgl_bayar','1','$total','$id_reservasi')");
    // jika simpan transaksi berhasil, maka update status yang tadinya belum bayar menjadi sudah
    if ($simpanTransaksi) {
        $updateStatus = mysqli_query($koneksi, "UPDATE reservasi2 SET status_bayar='sudah' WHERE id_reservasi='$id_reservasi'");
        if ($updateStatus) {
            echo "<script>alert('bisa');</script>";
            header("location: index.php?menu=riwayat");
        } else {
            echo "<script>alert('gagal');</script>";
            header("location: index.php?menu=bayar&id_reservasi=$id_reservasi");
        }
    }
}



// ==================== CRUD data kereta ======================
function tambah_kereta()
{
    global $koneksi;
    extract($_POST);
    $query = "INSERT INTO kereta (id_kereta, nama_kereta, gerbong) VALUES ('$id_kereta', '$nama_kereta','$gerbong')";
    $simpan = mysqli_query($koneksi, $query);
    // jika berhasil disimpan
    if ($simpan) {
        echo '<script>alert("data kereta berhasil disimpan");   document.location.href="admin.php?menu=kereta" </script>';
    } else {
        echo '<script>alert("data kereta gagal disimpan");   document.location.href="admin.php?menu=kereta" </script>';
    }
}

function hapus_kereta()
{
    global $koneksi;
    $id = $_GET['id'];
    $query = "DELETE FROM kereta WHERE id_kereta='$id' ";
    $hapus = mysqli_query($koneksi, $query);
    // jika berhasil dihapus
    if ($hapus) {
        echo '<script>alert("data kereta berhasil dihapus");   document.location.href="admin.php?menu=kereta" </script>';
    } else {
        echo '<script>alert("data kereta gagal dihapus");   document.location.href="admin.php?menu=kereta" </script>';
    }
}

function edit_kereta()
{
    global $koneksi;
    extract($_POST);
    $query = "UPDATE kereta set id_kereta='$id_kereta_baru', nama_kereta='$nama_kereta', gerbong='$gerbong' WHERE id_kereta='$id_kereta_lama' ";
    $update = mysqli_query($koneksi, $query);
    // jika berhasil diupdate
    if ($update) {
        echo '<script>alert("data kereta berhasil diupdate");   document.location.href="admin.php?menu=kereta"; </script>';
    } else {
        echo '<script>alert("data kereta gagal diupdate"); </script>';
    }
}


// ================ CRUD Jadwal Kereta ==================
function hapus_jadwal()
{
    global $koneksi;
    $id = $_GET['id'];
    $query = "DELETE FROM jadwal WHERE id_jadwal='$id' ";
    $hapus = mysqli_query($koneksi, $query);
    // jika berhasil dihapus
    if ($hapus) {
        echo '<script>alert("data jadwal kereta berhasil dihapus");   document.location.href="admin.php?menu=jadwal" </script>';
    } else {
        echo '<script>alert("data jadwal kereta gagal dihapus");   document.location.href="admin.php?menu=jadwal" </script>';
    }
}

function tambah_jadwal()
{
    global $koneksi;
    extract($_POST);
    $query = "INSERT INTO jadwal (id_kereta, stasiun_awal, stasiun_tujuan,keberangkatan, kedatangan, harga_tiket,tgl_berangkat) VALUES ('$id_kereta', '$stasiun_awal','$stasiun_tujuan','$keberangkatan','$kedatangan','$tarif','$tgl_berangkat')";
    $simpan = mysqli_query($koneksi, $query);
    // jika berhasil disimpan
    if ($simpan) {
        echo '<script>alert("data jadwal kereta berhasil disimpan");   document.location.href="admin.php?menu=jadwal" </script>';
    } else {
        echo '<script>alert("data jadwal kereta gagal disimpan");   document.location.href="admin.php?menu=jadwal" </script>';
    }
}

function edit_jadwal()
{
    global $koneksi;
    extract($_POST);
    $query = "UPDATE jadwal SET id_kereta='$id_kereta', stasiun_awal='$stasiun_awal', stasiun_tujuan='$stasiun_tujuan',keberangkatan='$keberangkatan', kedatangan='$kedatangan',tgl_berangkat='$tgl_berangkat', harga_tiket='$tarif' WHERE id_jadwal='$id_jadwal'";
    $update = mysqli_query($koneksi, $query);
    // jika berhasil diupdate
    if ($update) {
        echo '<script>alert("data jadwal kereta berhasil diupdate");   document.location.href="admin.php?menu=jadwal"; </script>';
    } else {
        echo '<script>alert("data jadwal kereta gagal diupdate"); </script>';
    }
}
