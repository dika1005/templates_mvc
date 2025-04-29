<div class="container mt-5">
    <div class="row">
        <div class="col-6">
            <h3>daftar mahasiswa</h3>

           
                <?php foreach ($data['dta'] as $dta) : ?>

                    <ul>
                        <li><?= $dta['id']; ?></li>
                        <li><?= $dta['nama']; ?></li>
                        <li><?= $dta['nrp']; ?></li>
                        <li><?= $dta['email']; ?></li>
                        <li><?= $dta['jurusan']; ?></li>
                    </ul>

                <?php endforeach; ?>
            

        </div>
    </div>
</div>