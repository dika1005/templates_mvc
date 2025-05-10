<link rel="stylesheet" href=" <?= BASEURL; ?> /css/update.css">
<div class="container large">
    <h2>Update Data User Posyandu</h2>
    <form id="updateForm">
      <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" id="nama">
      </div>
      <div class="form-group">
        <label>NIK</label>
        <input type="text" id="nik">
      </div>
      <div class="form-group">
        <label>Alamat</label>
        <input type="text" id="alamat">
      </div>
      <div class="form-group">
        <label>Jenis Kelamin</label>
        <div class="radio-group">
          <label><input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan</label>
          <label><input type="radio" name="jenis_kelamin" value="Laki-laki"> Laki-laki</label>
        </div>
      </div>
      <div class="form-group">
        <label>Umur</label>
        <input type="number" id="umur">
      </div>
      <div class="form-group">
        <label>Tinggi Badan (cm)</label>
        <input type="number" id="tinggi">
      </div>
      <div class="form-group">
        <label>Berat Badan (kg)</label>
        <input type="number" id="berat">
      </div>
      <div class="form-group">
        <button type="button" onclick="saveData()">Selesai</button>
      </div>
    </form>
  </div>