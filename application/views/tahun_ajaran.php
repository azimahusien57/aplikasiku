<!-- tabel progres -->
<!-- Progress Table start -->
<div class="col-12 mt-5">
    <div class="card">

        <div class="card-body">
            <!-- validasi pesan tersimpan ditambah data thun pelajaran -->
            <?php

            if ($this->session->flashdata('info')) {
            ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $this->session->flashdata('info'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span class="fa fa-times"></span>
                            </button>
                        </div>
                    </div>
                </div>

            <?php
            }

            ?>

            <!-- tombol tambah data -->
            <?php echo anchor('Admin/tambah_th', 'Tambah Data Tahun ajaran', array('class' => "btn btn-primary mb-3 fa fa-database")); ?>

            <div class="single-table">
                <div class="table-responsive">
                    <table class="table table-hover progress-table text-center">
                        <thead class="text-uppercase">
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">No Pelajaran</th>

                                <th scope="col">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- validasi -->
                            <?php
                            if ($th->num_rows() > 0) {
                                $no = 1;
                                // ada 2 cara objec atau array,tapi kalau object lebih dipakai untuk framwork yg bersifat mvc
                                // cara 1 foreach ($th->result_array() as $r) { ,<?= $r['tahun_pelajaran']; 
                                foreach ($th->result_object() as $r) {
                                    # data ada
                            ?>
                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $r->tahun_pelajaran; ?></td>
                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                <!-- tombol edit dan peasn konfirmasi -->

                                                <li class="mr-3"><a href="<?= base_url('Admin/formedit_th/' . $r->id_tahun_pelajaran) ?>" class="btn btn-success mb-3 "><i class="fa fa-edit"></i></a></li>
                                                <!--  tombol delete pesan konfirmasi -->
                                                <li><a href="<?= base_url('Admin/hapus_th/' . $r->id_tahun_pelajaran) ?>" class="btn btn-danger mb-3 " onclick="return confirm(' apakah data tahun pelajaran mau dihapus?')"><i class="ti-trash"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                            } else {
                                # jk tdk ada
                                ?>
                                <tr>
                                    <td colspan="3" align="center"> data kosong</td>
                                </tr>
                            <?php
                            }

                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Progress Table end -->

</div>