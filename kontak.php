<?php
    include "config/config.php";
    include "config/sessionUser.php";
    if (isset($_GET['message'])) {
        ?><script>alert("<?php echo $_GET['message']; ?>")</script><?php
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Link Shop Butik</title>
	<meta name="google-signin-scope" content="profile email"> 
    <meta name="google-signin-client_id" content="571963356124-9nhkogpvo06cmqjnav3qh8cv3848n6na.apps.googleusercontent.com"> 
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <?php include 'head.php'; ?>
</head>
<body>

<?php
  include 'header.php';
?>

    <div class="w3-modal" style="display: none;" id="contactAdd">
        <form action="contactAdd.php" method="post" style="margin: 30px 500px; background-color: white; padding: 30px;">
            <button class="cancel w3-btn w3-deep-orange" onclick="document.getElementById('contactAdd').style.display='none'">X</button>
            <center><textarea type="text" name="addAddress" required class="search" placeholder="Masukkan Alamat" style="margin: 0 0 20px;"></textarea><br>
            <select name="addProvince" id="addProvince" onchange="getCity()" style="margin-bottom: 20px;"></select><br>
            <select name="addCity" id="addCity" style="margin-bottom: 20px;"></select><br>
            <input type="text" name="addPostalCode" required class="search" placeholder="Masukkan Kode Pos" style="margin: 0 0 20px;"><br>
            <input type="submit" value="Submit" name="addSubmit" class="w3-btn w3-deep-orange" style="margin-top: 20px;"></center>
        </form>
    </div>

    <div class="w3-modal" style="display: none;" id="contactEdit">
        <form action="contactEdit.php" method="post" style="margin: 30px 500px; background-color: white; padding: 30px;">
            <button class="cancel w3-btn w3-deep-orange" onclick="document.getElementById('contactEdit').style.display='none'">X</button>
            <center><textarea type="text" name="address" required class="search" placeholder="Masukkan Alamat" style="margin: 0 0 20px;"></textarea><br>
            <input type="text" name="city" required class="search" placeholder="Masukkan Nama Kota" style="margin: 0 0 20px;"><br>
            <input type="text" name="province" required class="search" placeholder="Masukkan Nama Provinsi" style="margin: 0 0 20px;"><br>
            <input type="text" name="postalCode" required class="search" placeholder="Masukkan Kode Pos" style="margin: 0 0 20px;"><br>
            <input type="submit" value="Submit" name="addSubmit" onclick="editContact()" class="w3-btn w3-deep-orange" style="margin-top: 20px;"></center>
        </form>
    </div>

<div class="isi">
<button class="w3-btn w3-deep-orange" style="margin-bottom: 20px" onclick="addContactForm()">Tambah Alamat</button>
<center>
    <table class="w3-table">
        <tr class="w3-deep-orange">
            <td>Alamat</td>
            <td>Kode Pos</td>
            <td colspan="2"><center>Option</center></td>
        </tr>
        <?php
            $sql = "SELECT * FROM contact";
            $query = $mysqli->query($sql);
            while($row = $query->fetch_assoc()){
        ?>
        <tr>
            <td><?php echo $row['Address']; ?></td>
            <td><?php echo $row['postalCode']; ?></td>
            <td><center><a class="option" onclick="document.getElementById('contactEdit').style.display='block'">Edit</a></center></td>
            <td><center><a onclick="contactDelete(<?php echo $row['idContact']; ?>,'<?php echo $row['name']; ?>')" class="option">Hapus</a></center></td>
        </tr>
        <?php
            }
            $mysqli->close();
        ?>
    </table>
</div>

</body>
</html>