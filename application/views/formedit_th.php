<!-- basic form start -->
<div class="col-12 mt-5">
    <div class="card">


        <div class="card-body">
            <h4 class="header-title">Edit Tahun Ajaran</h4>
            <?php echo form_open('Admin/edit_th'); ?>
            <!-- penyembunyian data id -->
            <?php echo form_hidden('id', $tp->id_tahun_pelajaran); ?>
            <div class="form-group">
                <label for="th">Tahun Pelajaran</label>

                <!-- tampilan -->
                <?php echo form_input("th", $tp->tahun_pelajaran, array('class' => 'form-control', 'id' => 'th', 'placeholder' => 'isi tahun pelajaran')); ?>


            </div>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <!-- tombol -->
            <?php echo form_submit('edit', 'Edit', array('class' => "btn btn-primary mb-4 ")); ?>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!-- basic form end -->
















</div>