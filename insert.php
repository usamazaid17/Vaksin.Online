<?php
    $nama = $_POST ['nama'];
    $alamat = $_POST ['alamat'];
    $gender = $_POST ['gender'];
    $nomortelepon = $_POST ['nomortelepon'];
    $email = $_POST ['email'];
    $saran = $_POST ['saran'];
    if (!empty($nama) || !empty($alamat) || !empty($gender) || !empty($nomortelepon) ||
    !empty($email) || !empty($saran)) {
        //deklarasi database
        $host = "localhost";
        $dbUser = "root";
        $dbPassword = "";
        $dbName = "vaksin_online";
        //mengecek variabel koneksi
        $conn = new mysqli($host, $dbUser,$dbPassword, $dbName);
        //mengecek eror koneksi
        if(mysqli_connect_error()){
            die ('Connect eror ('. mysqli_connect_errorno=().')'. mysqli_connect_error()); 
        } else {
            $SELECT = "SELECT nama FROM tabel WHERE nama = ? Limit 1";
            $INSERT = "INSERT INTO tabel (nama, alamat, gender, nomortelepon, email, saran)
            VALUES (?, ?, ?, ?, ?, ?)";


            //STATMENT
            $stmt = $conn -> prepare ($SELECT);
            $stmt -> bind_param("s", $nama);
            $stmt -> execute();
            $stmt -> bind_result ($nama);
            $stmt -> store_result();
            $rnun = $stmt -> num_rows;

            if ($rnum==0){
                $stmt -> close();
                $stmt = $conn ->prepare ($INSERT);
                $stmt -> bind_param("ssssss",$nama, $alamat, $gender, $nomortelepon, $email, $saran);
                $stmt -> execute();
                echo "Data Anda Berhasil Kami Simpan";
            }else {
                echo "data anda telah pernah melakukan registrasi";
            }
            $stmt -> close();
            $conn -> close();
        }
    } else {
        echo "Terimakasih, data Anda Telah Kami Simpan :)";
        die();
    }
?>