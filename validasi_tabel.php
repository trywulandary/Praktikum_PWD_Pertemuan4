<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .error {
            color: #ff0000;
        }
    </style>
    <title>Praktikum 4</title>
</head>

<body>
    <?php
    $namaErr = $emailErr = $genderErr = $websiteErr = "";
    $nama = $email = $gender = $comment = $website = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["nama"])) {
            $namaErr = "Nama harus diisi";
        } else {
            $nama = test_input($_POST["nama"]);
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email harus diisi";
        } else {
            $email = test_input($_POST["email"]);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Email tidak sesuai format";
            }
        }

        if (empty($_POST["website"])) {
            $website = "";
        } else {
            $website = test_input($_POST["website"]);
        }

        if (empty($_POST["comment"])) {
            $comment = "";
        } else {
            $comment = test_input($_POST["comment"]);
        }

        if (empty($_POST["gender"])) {
            $genderErr = "Gender harus diisi";
        } else {
            $gender = test_input($_POST["gender"]);
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

    <h2>Posting Komentar</h2>

    <p><span class="error">* Harus diisi</span></p>

    <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <table>
            <tr>
                <td>Nama : </td>
                <td>
                    <input type="text" name="nama">
                    <span class="error"> * <?= $namaErr; ?></span>
                </td>
            </tr>
            <tr>
                <td>Email : </td>
                <td>
                    <input type="text" name="email">
                    <span class="error"> * <?= $emailErr; ?></span>
                </td>
            </tr>
            <tr>
                <td>Website : </td>
                <td>
                    <input type="text" name="website">
                    <span class="error"><?= $websiteErr; ?></span>
                </td>
            </tr>
            <tr>
                <td>Komentar : </td>
                <td><textarea name="comment" rows="5" cols="40"></textarea></td>
            </tr>
            <tr>
                <td>Gender : </td>
                <td>
                    <input type="radio" name="gender" value="Laki-laki">Laki-laki
                    <input type="radio" name="gender" value="Perempuan">Perempuan
                    <span class="error"> * <?= $genderErr; ?></span>
                </td>
            </tr>

            <td>
                <input type="submit" name="submit" value="Submit">
            </td>
        </table>
    </form>

    <table class="table" border="1">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Website</th>
                <th>Comment</th>
                <th>Gender</th>
            </tr>
        </thead>
        <tbody>
            <?php
            echo "<h2>Data yang anda isi:</h2>";
            echo "<td>$nama</td>";
            echo "<td>$email</td>";
            echo "<td>$website</td>";
            echo "<td>$comment</td>";
            echo "<td>$gender</td>";
            ?>
        </tbody>
    </table>
</body>

</html>