<?php
    include "config/sessionUser.php";
	include "config/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include "head.php"; ?>
</head>
<body>

<?php include "header.php"; ?>
    <script>
        
      function onSignIn(googleUser) {
        var idGoogle;
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile(); 
        idGoogle = profile.getEmail(); 
        //console.log('Full Name: ' + profile.getName()); 
        //console.log('Given Name: ' + profile.getGivenName()); 
        //console.log('Family Name: ' + profile.getFamilyName()); 
        //console.log("Image URL: " + profile.getImageUrl()); 
        //console.log("Email: " + profile.getEmail());
        var picture = profile.getImageUrl();
        document.getElementById("signInGoogle").style.display = "none";
        document.getElementById("profilePicture").src = picture;

        // The ID token you need to pass to your backend: 
        sendBack(idGoogle, picture);
        //console.log(idGoogle);
      };
      function sendBack(idGoogle, picture){
            var input = "idGoogle=" + idGoogle + "&picture=" + picture;
            var request =  ajax(request);
            request.onreadystatechange = function() {
                if (request.status == 200 && request.readyState == 4) {
                    var respon = request.responseText;
                    console.log(respon);
                    
                    var json = JSON.parse(respon);
                    if(json.status == 1){
                        window.location = "https://stromzivota.web.id/admin/index.php";
                    }
                    else{
                        console.log(json.message);
                    }
                }
            };
            request.open("POST", "config/checkGoogle.php", true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(input);
        }
        
    
    </script>

<div style="margin: 40px -20px 20px 55px;">
<?php
	$sql = "SELECT product.idProduct, 
			product.sellingPrice, 
			dataproduct.name,
			dataproduct.picture
			FROM product
			INNER JOIN dataproduct
			ON product.idProduct = dataproduct.idProduct";
	if ($query = $mysqli->query($sql)) {
		while ($row = $query->fetch_assoc()) {
			?>
			<a href="detailProduct.php?idProduct=<?php echo $row['idProduct']; ?>">
                <div class="produkHome">
                    <img src="productPicture/<?php echo $row['picture']; ?>" alt="Norway" class="produk">
                    <div style="padding: 10px 20px;">
                        <div style="margin: 0 0 20px; height: 50px"><b><?php $name = (strlen($row['name']) > 40) ? substr($row['name'],0, 40)."..." : substr($row['name'],0, 40); echo $name; ?></b></div><br>
                        <p style="margin-top: -20px;"><?php echo $row['sellingPrice']; ?></p>
                    </div>
                </div>
            </a>
			<?php
		}
	}
?>
</div>
</body>
</html>
<?php
	$mysqli->close();
?>