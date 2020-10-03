<!-- basic form start -->
<div class="col-12 mt-6">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">form kelas</h4>
            <?php echo form_open('Admin/simpan_kelas'); ?>
            <div class="form-group">
                <label for="kk">Kode Kelas</label>

                <!-- tampilan -->
                <?php echo form_input("kode_kelas", set_value('kode_kelas'), array(
                    'class' => 'form-control', 'id' => 'ke',
                    'placeholder' => 'isi kode kelas'
                )); ?>
                <!-- validasi cek  menggunakn botton jg bisa-->
                <small class="text-danger">

                    <!-- dismiss alert area start -->
                    <!-- <div class="row">
                        <div class="col-md-6">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"> -->
                    <?php echo form_error('kode_kelas', ''); ?>
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>
                                </button> -->



                </small>

            </div>
            <!-- yg kedua nama kelas -->
            <div class="form-group">
                <label for="nk">Nama Kelas</label>

                <!-- tampilan -->
                <?php echo form_input(
                    "nama_kelas",
                    set_value('nama_kelas'),
                    array(
                        'class' => 'form-control', 'id' => 'nk',
                        'placeholder' => 'isi nama kelas'
                    )
                ); ?>
                <!-- validasi cek -->
                <small class="text-danger">
                    <!-- dismiss alert area start -->
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"> -->
                    <?php echo form_error('nama_kelas', ''); ?>
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