<?php
$i=1;
?>
<div class="container part1">
	<div class="tableHeader">
		<h2>Daftar Mahasiswa</h2>

		<div class="controls" style="display:flex; gap:10px;">
			<div class="searchBox" id="searchBox">
				<form action="" method="GET">
					<?php if(empty($data["filter"])):?>
						<input type="text" name="search" placeholder="Cari mahasiswa..." autofocus>
					<?php else:?>
						<input type="text" name="search" placeholder="Cari mahasiswa..." value="<?=$data["filter"];?>" autofocus>
					<?php endif;?>
					<button type="submit">Cari!</button>
				</form>
			</div>
			<button class="btn" id="tambahModalBtn">+ Tambah Mahasiswa</button>
		</div>
	</div>
	<div id="tableContainer">
		<table id="tableMahasiswa">
			<thead>
				<tr>
					<th>No</th>
					<th>Aksi</th>
					<th>Gambar</th>
					<th>Nama</th>
					<th>NRP</th>
					<th>Email</th>
					<th>Jurusan</th>
				</tr>
			</thead>
			<tbody>
				<?php $nom = 1; ?>
				<?php if(isset($data["mahasiswa"])):;?>
					<?php foreach($data["mahasiswa"] as $mhs): ?>
						<tr>
							<th><?= $nom ?></th>
							<td>
								<a href="hapus.php?id=<?= $mhs['id'] ?>">Hapus</a> |
								<!-- <a class="ubahLink" data-id="<?= $mhs['id'] ?>" href="">Ubah</a> -->
								<button class="ubahLink" data-id="<?= $mhs['id'] ?>" >Ubah</button>
							</td>
							<td>
								<?php if (!empty($mhs['gambar'])): ?>
									<img src="img/<?= $mhs['gambar'] ?>" alt="Foto Mahasiswa" height="70">
								<?php else: ?>
									<img src="img/nofoto.png" height="70">
								<?php endif; ?>
							</td>
							<td><?= $mhs['nama'] ?></td>
							<td><?= $mhs['nrp'] ?></td>
							<td><?= $mhs['email'] ?></td>
							<td><?= $mhs['jurusan'] ?></td>
						</tr>
						<?php $nom++ ?>
					<?php endforeach; ?>
				<?php else:?>
					<h1>Data mahasiswa is missing</h1>
				<?php endif;?>
			</tbody>
		</table>

		<!-- Pagination -->
		<div class="pagination">
			<?php if($data["currentPage"] != 1):?>
				<a href="#">&laquo;</a>
			<?php endif;?>
			
			<?php while($i<=$data["pageCount"]):?>
				<?php if(empty($data["filter"])):?>
					<a href="<?=BASEURL.'/mahasiswa/index/'.$i;?>"><?=$i;?></a>
				<?php else:?>
					<a href="<?=BASEURL.'/mahasiswa/index/'.$i."/".$data["filter"];?>"><?=$i;?></a>
				<?php endif;?>
				<?php $i++;?>
			<?php endwhile;?>
			<?php if($data["currentPage"] != $data["pageCount"]):?>
				<a href="#">&raquo;</a>
			<?php endif;?>
		</div>
	</div>

</div>

<!-- === Modal === -->
<div class="modalOverlay" id="modalOverlay">
	<div class="modal" id="modalBox">
		<div class="modal-header">
			<h3>Tambah Mahasiswa</h3>
			<span id="closeModalBtn" style="cursor:pointer; font-size:20px;">&times;</span>
		</div>
		<form id="mahasiswaForm" method="post" enctype="multipart/form-data">
			<input type="text" placeholder="Nama" name="nama" required>
			<input type="text" placeholder="NRP" name="nrp" required>
			<input type="text" placeholder="Email" name="email" required>
			<input type="text" placeholder="Jurusan" name="jurusan" required>
			<input type="file" name="gambar" accept="image/*">
			<div class="modal-actions">
				<button type="button" class="btn btn-cancel" id="cancelModalBtn">Batal</button>
				<button type="submit" class="btn">Simpan</button>
			</div>
		</form>
	</div>
</div>

<script>
let checkSearchSubmit = true;
const tambahModalBtn = document.getElementById('tambahModalBtn');
const modalOverlay = document.getElementById('modalOverlay');
const modalBox = document.getElementById('modalBox');
const closeModalBtn = document.getElementById('closeModalBtn');
const cancelModalBtn = document.getElementById('cancelModalBtn');
const mahasiswaForm = document.getElementById('mahasiswaForm');
// const ubahLink = document.getElementsByClassName('ubahLink');
const tableMahasiswa = document.getElementById('tableMahasiswa');
const namaInput = document.querySelector("input[name='nama']");
const searchInput = document.querySelector("input[name='search']");
const searchBoxForm = document.querySelector("#searchBox form");
const tableContainer = document.getElementById('tableContainer');
// function openModal() {
// 	modalOverlay.style.display = 'flex';
// 	setTimeout(() => modalBox.classList.add('active'), 10);
// }
// function falsecheckSearchSubmit(){
// 	checkSearchSubmit = false;
// }
searchBoxForm.addEventListener('submit', function(e) {
  e.preventDefault();
  console.log("success");
  document.location.href = "<?= BASEURL . '/mahasiswa/index/1/'; ?>" + searchInput.value;
  // const xhr = new XMLHttpRequest();
  // xhr.onreadystatechange = ()=>{
  // 	if(xhr.readyState == 4 && xhr.status == 200){
// 		tableContainer.innerHTML = "berhasil";
  // 	}
  // }
  // xhr.open("GET", "<?= BASEURL . '/mahasiswa/index/1/'; ?>" + searchInput.value, true);
  // xhr.send();
});

function closeModal() {
	modalBox.classList.remove('active');
	// setTimeout(() => modalOverlay.style.display = 'none', 200);
	if (namaInput) namaInput.removeAttribute('autofocus');
	// hide overlay after animation; then set focus to search input
	setTimeout(() => {
		modalOverlay.style.display = 'none';
		if (searchInput) {
			// ensure attribute removal / addition isn't needed for runtime focus
			searchInput.removeAttribute('autofocus');
			// focus now that overlay is gone
			searchInput.focus();
		}
	}, 200); // matches your animation duration	
}

tambahModalBtn.addEventListener('click', function(e){
	e.preventDefault();
	modalOverlay.style.display = 'flex';
	setTimeout(() => {
		modalBox.classList.add('active');

		// focus after modal is visible (give it a tiny delay to ensure styles applied)
		if (namaInput) {
			// remove autofocus attribute (not needed) and focus programmatically
			namaInput.removeAttribute('autofocus');
			// small delay so element is actually visible and focusable
			setTimeout(() => namaInput.focus(), 20);
		}
	}, 10);
	setTimeout(() => modalBox.classList.add('active'), 10);
	modalOverlay.querySelector("h3").innerHTML = "Tambah Data Mahasiswa";
	mahasiswaForm.setAttribute("action", "<?= BASEURL ?>/mahasiswa/tambah");
	document.querySelector("input[name='nama']").value = "";
  	document.querySelector("input[name='nrp']").value = "";
  	document.querySelector("input[name='email']").value = "";
  	document.querySelector("input[name='jurusan']").value = "";
	modalOverlay.querySelector('button[type="submit"]').innerHTML = "Tambah Mahasiswa";
});
tableMahasiswa.addEventListener('click', function(e){
	if (e.target.classList.contains('ubahLink')) {
	    e.preventDefault();
	    const id = e.target.dataset.id;
	    // alert('ID Mahasiswa: ' + id);
	    const xhr = new XMLHttpRequest();
	    xhr.onreadystatechange = () => {
	    	if (xhr.readyState === 4) {
			    if (xhr.status === 200) {
			    	modalOverlay.style.display = 'flex';
					setTimeout(() => {
						modalBox.classList.add('active');

						// focus after modal is visible (give it a tiny delay to ensure styles applied)
						if (namaInput) {
							// remove autofocus attribute (not needed) and focus programmatically
							namaInput.removeAttribute('autofocus');
							// small delay so element is actually visible and focusable
							setTimeout(() => namaInput.focus(), 20);
						}
					}, 10);
			      	setTimeout(() => modalBox.classList.add('active'), 10);
			      	modalOverlay.querySelector("h3").innerHTML = "Ubah Data Mahasiswa";
			      	mahasiswaForm.setAttribute("action", "<?= BASEURL ?>/mahasiswa/ubah");
			      	const jsonData = JSON.parse(xhr.responseText);
			      	document.querySelector("input[name='nama']").value = jsonData.nama;
			      	document.querySelector("input[name='nrp']").value = jsonData.nrp;
			      	document.querySelector("input[name='email']").value = jsonData.email;
			      	document.querySelector("input[name='jurusan']").value = jsonData.jurusan;
			      	modalOverlay.querySelector('button[type="submit"]').innerHTML = "Ubah Mahasiswa";
			      // alert(jsonData.nama);
			    } else {
			      console.error('Error fetching data:', xhr.status, xhr.statusText);
			    }
			  }
	    }
	    xhr.open('POST', "<?=BASEURL.'/mahasiswa/getDataMahasiswa';?>", true);
	    const formData = new FormData();
		formData.append('id', id); // example data
	    xhr.send(formData);
	}
});
closeModalBtn.addEventListener('click', closeModal);
cancelModalBtn.addEventListener('click', closeModal);
modalOverlay.addEventListener('click', (e) => {
	if (e.target === modalOverlay) closeModal();
});

// Just demo form submission
// document.getElementById('mahasiswaForm').addEventListener('submit', function(e) {
// 	e.preventDefault();
// 	alert('Data Mahasiswa akan disimpan (belum terhubu		tableContainer.innerHTML = xhr.responseText;ng ke backend).');
// 	closeModal();
// });
</script>