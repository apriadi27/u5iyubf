<div class="header w3-deep-orange">
	<a href="index.php"><p class="toko">Link Shop Butik</p></a>
	<div>
		<input type="text" name="search" placeholder="Cari produk" class="search" style="width: 60%; margin: -15px 0 0px 0">
	</div>
	
	<div id="signInGoogle" class="g-signin2" data-onsuccess="onSignIn" data-theme="dark" style="float: right; margin: -30px 0 0 0" onmouseover="menuProfilIn()" onmouseout="menuProfilOut()"></div> 
	<div style="float: right; margin: -40px 40px 0 0; color: white;" class="w3-dropdown-hover">
		<center><i class="fas fa-chart-pie fa-2x"></i>
		</center><p style="margin-top: 0px">Kategori</p>
		<div class="w3-dropdown-content dropdown">
			<?php
				$sql = "SELECT * FROM category";
				$query = $mysqli->query($sql);
				while ($row = $query->fetch_assoc()) {
					if($row['idCategory'] != 1){
			?>		
					<a href="category.php?id=<?php echo $row['idCategory']; ?>" style="width: 100%"><?php echo ucfirst($row['name']); ?></a>
			<?php
					}
				}
			?>
	    </div>
	</div>
	<img id="profilePicture" class="profil">
</div>
		<div class="menuProfil w3-card-4 out" id="menuProfil" onmouseover="menuProfilIn()" onmouseout="menuProfilOut()">
			<a href="keranjang.php"><button>Keranjang</button></a><br>
			<a href="confirmation.php"><button>Konfirmasi Pesanan</button></a><br>
			<a href="user/kontak.php"><button>Pengaturan Kontak</button></a><br>
			<a href="#" onclick="signOut();"><button>Log Out</button></a>
		</div>
