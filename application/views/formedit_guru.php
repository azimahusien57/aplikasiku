<!-- basic form start -->
<div class="col-12 mt-6">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">form edit guru</h4>
            <?php echo form_open_multipart('Admin/edit_guru'); ?>
            <?php echo form_hidden("id_guru", $fg->id_guru); ?>
            <?php echo form_hidden("foto", $fg->foto_guru); ?>
            <div class="form-group">
                <label for="nip">NIP</label>

                <!-- tampilan  fg adalah label dr form edit-->
                <?php echo form_input("nip", $fg->nip, array(
                    'class' => 'form-control', 'id' => 'ke',
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
                    $fg->nama_guru,
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
                <?php
                if ($fg->jk_guru == "L") {
                    $l = true;
                    $p = false;
                } else {
                    $l = false;
                    $p = true;
                } ?>




                <!-- tampilan -->
                <?php echo form_radio('jk', 'L', $l) ?>laki-laki
                <?php echo form_radio('jk', 'P', $p) ?>Perempuan
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
                    set_value('telp_guru', $fg->tlp_guru, array(
                        'class' => 'form-control', 'id' => 'tlp',
                        'placeholder' => 'isi telpon guru'
                    ))
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
                <label for="ng">Alamat guru </label>

                <!-- tampilan -->
                <?php echo form_textarea('alamat_guru', $fg->alamat_guru, array('class' => 'form-control', 'placeholder' => 'Isi Alamat')) ?>
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
            <div>
                <!-- coba -->
                <?php
                if (!$fg->foto_guru) {
                    #   jika emang gru tdk ada maka tampil gak ada
                ?>
                    <img src="<?= base_url('assets/images/guru/fotokosong.gif'); ?>" alt="" width="50">
                <?php
                } else {
                    # jika ada maka akan muncul dr database
                ?>
                    <img src="<?= base_url('assets/images/guru/' . $fg->foto_guru); ?>" alt="" width="100">
                <?php
                }

                ?>

            </div>
            <!-- informasi foto  -->
            <div>
                <label>*) kosongi jika tdk mau di ubah</label>


            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <!-- tombol  besar itu namA DI BUTTON-->
            <?php echo form_submit('save', 'Edit', array('class' => "btn btn-primary mb-4 ")); ?>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!-- basic form end -->

</div>














</div>