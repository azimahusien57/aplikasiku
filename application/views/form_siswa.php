<!-- basic form start -->
<div class="col-12 mt-6">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">form siswa</h4>
            <?php echo form_open_multipart('Admin/simpan_siswa'); ?>
            <div class="form-group">
                <label for="th">Tahun pelajaran</label>

                <!-- tampilan -->
                <?php echo form_dropdown("th", $combo, set_value('th'), array(
                    'class' => 'form-control', 'id' => 'th',
                    'placeholder' => 'isi tahun pelajaran'
                )); ?>
                <!-- validasi cek  menggunakn botton jg bisa-->
                <small class="text-danger">

                    <!-- dismiss alert area start -->
                    <!-- <div class="row">
                        <div class="col-md-6">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"> -->
                    <?php echo form_error('th', ''); ?>
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>
                                </button> -->
                </small>
            </div>
            <!-- yg kedua nama kelas -->
            <div class="form-group">
                <label for="nisn">Nisn</label>

                <!-- tampilan -->
                <?php echo form_input(
                    "nisn",
                    set_value('nisn'),
                    array(
                        'class' => 'form-control', 'id' => 'nisn',
                        'placeholder' => 'isi nis'
                    )
                ); ?>
                <!-- validasi cek -->
                <small class="text-danger">
                    <!-- dismiss alert area start -->
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"> -->
                    <?php echo form_error('nisn', ''); ?>
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>
                                </button> -->
                </small>
            </div>
            <!-- yg kedua nama kelas -->
            <div class="form-group">
                <label for="ns">Nama Siswa</label>

                <!-- tampilan -->
                <?php echo form_input(
                    "nama_siswa",
                    set_value('nama_siswa'),
                    array(
                        'class' => 'form-control', 'id' => 'ns',
                        'placeholder' => 'isi nama siswa'
                    )
                ); ?>
                <!-- validasi cek -->
                <small class="text-danger">
                    <!-- dismiss alert area start -->
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"> -->
                    <?php echo form_error('nama_siswa', ''); ?>
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>
                                </button> -->
                </small>
            </div>


            <!-- jenis kelamin -->
            <div class="form-group">
                <label for="ng">Jenis Kelamin :</label>

                <!-- tampilan -->
                <?php echo form_radio('jk', 'L', set_value('jk')) ?>laki-laki
                <?php echo form_radio('jk', 'P', set_value('jk')) ?>Perempuan
                </br>
                <!-- validasi cek -->
                <small class="text-danger">
                    <!-- dismiss alert area start -->
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"> -->
                    <?php echo form_error('jk', ''); ?>
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>
                                </button> -->
                </small>


            </div>



            <!-- alamat -->
            <div class="form-group">
                <label for="ng">Alamat siswa </label>

                <!-- tampilan -->
                <?php echo form_textarea('alamat_siswa', set_value('alamat_siswa'), array('class' => 'form-control', 'placeholder' => 'Isi Alamat')) ?>
                <!-- validasi cek -->
                <small class="text-danger">
                    <!-- dismiss alert area start -->
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"> -->
                    <?php echo form_error('alamat_siswa', ''); ?>
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>
                                </button> -->
                </small>
            </div>
            <!-- foto guru -->
            <div class="form-group">
                <label for="fs">foto siswa</label>
                <!-- tampilan  1-->
                <?php echo form_upload('foto', '', array('class' => 'form-control')) ?>


                <!-- tampilan 2 -->

                <!-- <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile02" name="foto" />
                    <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                </div> -->


                <!-- validasi cek -->
                <small class="text-danger">
                    <!-- dismiss alert area start -->
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"> -->
                    <?php echo $error; ?>
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>
                                </button> -->

                </small>
            </div>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <!-- tombol -->
            <?php echo form_submit('save', 'Simpan', array('class' => "btn btn-primary mb-4 ")); ?>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!-- basic form end -->

</div>














</div>