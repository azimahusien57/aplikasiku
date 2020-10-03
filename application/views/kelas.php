<!-- tabel progres -->
<!-- Progress Table start -->
<div class="col-12 mt-5">
    <div class="card">
        <div class="card-body">
            <!-- tombol tambah data -->
            <?php echo anchor('Admin/tambah_kelas', 'Tambah Data Kelas', array('class' => "btn btn-primary mb-3 fa fa-database")); ?>

            <div class="single-table">
                <div class="table-responsive">
                    <table class="table table-hover progress-table text-center">
                        <thead class="text-uppercase">
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">Kode Kelas</th>
                                <th scope="col">Nama Kelas</th>
                                <th scope="col">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- data validasi -->
                            <?php
                            if ($k->num_rows() > 0) {
                                $no = 1;
                                // ada 2 cara objec atau array,tapi kalau object lebih dipakai untuk framwork yg bersifat mvc
                                // cara 1 foreach ($th->result_array() as $r) { ,<?= $r['tahun_pelajaran']; 


                                foreach ($k->result_object() as $r) {
                                    # data ada
                            ?>
                                    <tr>

                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $r->kode_kelas; ?></td>
                                        <td><?= $r->nama_kelas; ?></td>
                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                <li class="mr-3"><a href="<?= base_url('Admin/formedit_kelas/' . $r->id_kelas) ?>" class="btn btn-success mb-3 "><i class="fa fa-edit"></i></a></li>
                                                <!-- pesan konfirmasi -->
                                                <li><a href="<?= base_url('Admin/hapus_kelas/' . $r->id_kelas) ?>" class="btn btn-danger mb-3" onclick="return confirm(' apakah data kelas mau dihapus?')"><i class="ti-trash"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                            } else {
                                // jk tdk ada
                                ?>
                                <tr>
                                    <td colspan="4" align="centter">data kosong</td>
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