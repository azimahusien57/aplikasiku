<!-- basic form start -->
<div class="col-12 mt-5">
    <div class="card">
        <!-- validasi dr tambah thun  ajran dgn pesan error -->
        <?php
        if (validation_errors()) {
        ?>
            <!-- dismiss alert area start -->
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo validation_errors(); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- dismiss alert area end -->
        <?php

        }
        ?>




        <div class="card-body">
            <h4 class="header-title">Tambah Tahun Ajaran</h4>
            <?php echo form_open('Admin/simpan_th'); ?>
            <div class="form-group">
                <label for="th">Tahun Pelajaran</label>

                <!-- tampilan -->
                <?php echo form_input("th", "", array('class' => 'form-control', 'id' => 'th', 'placeholder' => 'isi tahun pelajaran')); ?>


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