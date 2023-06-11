<?php 
header('Content-Type: application/json');

$koneksi = mysqli_connect("localhost", "root", "", "assessment3");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM inputdetails";
    $query = mysqli_query($koneksi, $sql);
    $array_data = array();
    while ($data = mysqli_fetch_assoc($query)) {
        $array_data[] = $data;
    }
    echo json_encode($array_data);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_details = $_POST['nama_details'];
    $deskripsi_details= $_POST['deskripsi_details'];
    $sql = "INSERT INTO inputdetails (nama_details, deskripsi_details) VALUES('$nama_details', '$deskripsi_details')";
    $cek = mysqli_query($koneksi, $sql);

    if ($cek) {
        $data = [
            'status' => "berhasil"
        ];
        echo json_encode($data);
    } else {
        $data = [
            'status' => "gagal"
        ];
        echo json_encode($data);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id_details = $_GET['id_details'];
    $sql = "DELETE FROM inputdetails WHERE id_details='$id_details'";
    $cek = mysqli_query($koneksi, $sql);

    if ($cek) {
        $data = [
            'status' => "berhasil"
        ];
        echo json_encode($data);
    } else {
        $data = [
            'status' => "gagal"
        ];
        echo json_encode($data);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents("php://input"), $data);
    $id_details = $data['id_details'];
    $nama_details = $data['nama_details'];
    $deskripsi_details = $data['deskripsi_details'];

    $sql = "UPDATE inputdetails SET nama_details='$nama_details', deskripsi_details='$deskripsi_details' WHERE id_details='$id_details'";
    $cek = mysqli_query($koneksi, $sql);

    if ($cek) {
        $data = [
            'status' => 'berhasil'
        ];
        echo json_encode($data);
    } else {
        $data = [
            'status' => 'gagal'
        ];
        echo json_encode($data);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
    parse_str(file_get_contents("php://input"), $data);
    $id_details = $data['id_details'];
    $nama_details = $data['nama_details'];
    $deskripsi_details = $data['deskripsi_details'];

    $sql = "UPDATE inputdetails SET ";
    $fields = array();

    if (!empty($nama_details)) {
        $fields[] = "nama_details='$nama_details'";
    }

    if (!empty($deskripsi_details)) {
        $fields[] = "deskripsi_details='$deskripsi_details'";
    }

    $sql .= implode(', ', $fields);
    $sql .= " WHERE id_details='$id_details'";
    $cek = mysqli_query($koneksi, $sql);

    if ($cek) {
        $data = [
            'status' => 'berhasil'
        ];
        echo json_encode($data);
    } else {
        $data = [
            'status' => 'gagal'
        ];
        echo json_encode($data);
    }
}
?>