<html>

<head>
    <title>Tambah data mahasiswa</title>
</head>

<body>
    <?php
    // inisialisasi variabel kosong untuk menyimpan data jika kosong
    $nimMhs = $namaMhs = $genderMhs = $alamatMhs = $tglMhs = "";
    $nim = $nama = $gender = $alamat = $tgl = "";

    // Kondisi If => jika ada request berupa POST maka lakukan perintah dibawah
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Jika suatu data nim saat melakukan request POST empty maka lakukan perintah dibawah
        if (empty($_POST["nim"])) {
            // Akan ada info jika NIM harus di isi
            $nimMhs = "NIM harus diisi";
        } else {
            // Jika nim tersebut ada data isi nya
            $nim = test_input($_POST["nim"]);
        }

        if (empty($_POST["nama"])) {
            // Akan ada info jika NIM harus di isi
            $namaMhs = "Nama harus diisi";
        } else {
            // Jika nim tersebut ada data isi nya
            $nama = test_input($_POST["nama"]);
        }

        if (empty($_POST["jkel"])) {
            // Akan ada info jika NIM harus di isi
            $genderMhs = "Gender harus dipilih";
        } else {
            // Jika nim tersebut ada data isi nya
            $gender = test_input($_POST["jkel"]);
        }

        if (empty($_POST["alamat"])) {
            $alamatMhs = "";
        } else {
            $alamat = test_input($_POST["alamat"]);
        }

        if (empty($_POST["tgllhr"])) {
            $tglMhs = "";
        } else {
            $tgl = test_input($_POST["tgllhr"]);
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    <a href="index.php">Go to Home</a>
    <br /><br />
    <form action="tambah.php <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="form1">
        <table width="25%" border="0">
            <tr>
                <td>Nim</td>
                <td><input type="text" name="nim">
                    <!-- panggil variabel nimMhs untuk proses data validasi -->
                    <span class="error">* <?php echo $nimMhs; ?></span>
                </td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama">
                    <!-- panggil variabel namaMhs untuk proses data validasi -->
                    <span class="error">* <?php echo $namaMhs; ?></span>
                </td>
            </tr>
            <tr>
                <td>Gender (L/P)</td>
                <td><input type="text" name="jkel">
                    <!-- panggil variabel genderMhs untuk proses data validasi -->
                    <span class="error">* <?php echo $genderMhs; ?></span>
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat">
                    <!-- panggil variabel alamatMhs untuk proses data validasi -->
                    <span class="error"><?php echo $alamatMhs; ?></span>
                </td>
            </tr>
            <tr>
                <td>Tgl Lahir</td>
                <td><input type="text" name="tgllhr">
                    <!-- panggil variabel tglMhs untuk proses data validasi -->
                    <span class="error"><?php echo $tglMhs; ?></span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="Submit" value="Tambah"></td>
            </tr>
        </table>
    </form>
    <?php
    // $_POST => melakukan pengiriman data
    if (isset($_POST['Submit'])) { // jika form telah di submit atau belum
        $nim = $_POST['nim']; // $nim => mengirimkan data yang telah di inputkan oleh user berupa nim
        $nama = $_POST['nama']; // $nama => mengirimkan data yang telah di inputkan oleh user berupa nama
        $jkel = $_POST['jkel']; // $jkel => mengirimkan data yang telah di inputkan oleh user berupa jkel
        $alamat = $_POST['alamat']; // $alamat => mengirimkan data yang telah di inputkan oleh user berupa alamat
        $tgllhr = $_POST['tgllhr']; // $tgllhr => mengirimkan data yang telah di inputkan oleh user berupa tgllhr
        // panggil koneksi.php untuk mengirimkan data yang telah di inputkan oleh user
        include_once("koneksi.php");
        // Cek kondisi jika data tersebut kosong atau tidak
        if (empty($nim = $_POST['nim'])) {
            // Jika NIM kosong akan ada notif kosong
            echo "NIM Kosong. <a href='index.php'>View Users</a>";
            if (empty($nim = $_POST['nama'])) {
                // Jika Nama kosong akan ada notif kosong
                echo "Nama Kosong. <a href='index.php'>View Users</a>";
                if (empty($nim = $_POST['jkel'])) {
                    // Jika Gender kosong akan ada notif kosong
                    echo "Gender Kosong. <a href='index.php'>View Users</a>";
                }
            }
        } else {
            // Masukkan data yang telah dikirimkan tersebut ke database table
            $result = mysqli_query($con, "INSERT INTO mahasiswa(nim,nama,jkel,alamat,tgllhr) VALUES('$nim','$nama', '$jkel','$alamat','$tgllhr')");
            // Lakukan pesan informasi jika proses pengiriman berhasil
            echo "Data berhasil disimpan. <a href='index.php'>View Users</a>";
        }
    }
    ?>
</body>

</html>