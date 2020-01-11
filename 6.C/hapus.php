<?php 
    // koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "arkademy");

    // hapus data
    $id = $_GET["id"];
    $name = $_GET["name"];
    $query_delete = "DELETE FROM product WHERE id = $id";
    mysqli_query($conn, $query_delete);

    if (mysqli_affected_rows($conn) > 0){
    echo "
            <script>
            alert('Data ".$name." ID #".$id." berhasil dihapus!');
            document.location.href = 'index.php';
            </script>
    ";
    } else {
    echo "
            <script>
            alert('Gagal !!!');
            </script>
    ";
    }

?>