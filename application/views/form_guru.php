<!-- basic form start -->
<div class="col-12 mt-6">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">form guru</h4>
            <?php echo form_open_multipart('Admin/simpan_guru'); ?>
            <div class="form-group">
                <label for="nip">NIP</label>

                <!-- tampilan -->
                <?php echo form_input("nip", set_value('nip'), array(
                    'class' => 'form-control', 'id' => 'nip',
                    'placeholder' => 'isi nim'
                )); ?>
                <!-- validasi cek  menggunakn botton jg bisa-->
                <small class="text-danger">

                    <!-- dismiss alert area start -->
                    <!-- <div class="row">
                        <div class="col-md-6">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"> -->
                    <?php echo form_error('nip', ''); ?>
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>
                                </button> -->
                </small>
            </div>
            <!-- yg kedua nama kelas -->
            <div class="form-group">
                <label for="ng">Nama Guru</label>

                <!-- tampilan -->
                <?php echo form_input(
                    "nama_guru",
                    set_value('nama_guru'),
                    array(
                        'class' => 'form-control', 'id' => 'ng',
                        'placeholder' => 'isi nama guru'
                    )
                ); ?>
                <!-- validasi cek -->
                <small class="text-danger">
                    <!-- dismiss alert area start -->
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"> -->
                    <?php echo form_error('nama_guru', ''); ?>
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>
                                </button> -->
                </small>
            </div>

            <!-- jenis kelamin -->
            <div class="form-group">
                <label for="jk">Jenis Kelamin :</label>

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
            <!-- yg kedua no telpon guru -->
            <div class="form-group">
                <label for="tlp">Telp Guru</label>

                <!-- tampilan -->
                <?php echo form_input(
                    "telp_guru",
                    set_value('telp_guru'),
                    array(
                        'class' => 'form-control', 'id' => 'tlp',
                        'placeholder' => 'isi telpon guru'
                    )
                ); ?>
                <!-- validasi cek -->
                <small class="text-danger">
                    <!-- dismiss alert area start -->
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"> -->
                    <?php echo form_error('telp_guru', ''); ?>
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>
                                </button> -->
                </small>
            </div>


            <!-- alamat -->
            <div class="form-group">
                <label for="ag">Alamat guru </label>

                <!-- tampilan -->
                <?php echo form_textarea('alamat_guru', set_value('alamat_guru'), array('class' => 'form-control', 'placeholder' => 'Isi Alamat')) ?>
                <!-- validasi cek -->
                <small class="text-danger">
                    <!-- dismiss alert area start -->
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"> -->
                    <?php echo form_error('alamat_guru', ''); ?>
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>
                                </button> -->
                </small>
            </div>
            <!-- foto guru -->
            <div class="form-group">
                <label for="fg">foto Guru</label>
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