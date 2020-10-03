<!-- tabel progres -->
<!-- Progress Table start -->
<div class="col-12 mt-5">
    <div class="card">
        <div class="card-body">
            <!-- tombol tambah data -->
            <?php echo anchor('Admin/tambah_users', 'Tambah Data User', array('class' => "btn btn-primary mb-3 fa fa-database")); ?>

            <div class="single-table">
                <div class="table-responsive">
                    <table class="table table-hover progress-table text-center">
                        <thead class="text-uppercase">
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Level</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- data validasi -->
                            <?php
                            if ($us->num_rows() > 0) {
                                $no = 1;
                                // ada 2 cara objec atau array,tapi kalau object lebih dipakai untuk framwork yg bersifat mvc
                                // cara 1 foreach ($th->result_array() as $r) { ,<?= $r['tahun_pelajaran']; 

                                // $r itu default dari  result us
                                foreach ($us->result_object() as $s) {
                                    # data ada
                            ?>
                                    <tr>

                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $s->nama_lengkap; ?></td>
                                        <td><?= $s->username; ?></td>
                                        <td><?= $s->email; ?></td>
                                        <td><?= $s->level; ?></td>
                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                <li class="mr-3"><a href="<?= base_url('Admin/formedit_users/' . $s->id_users) ?>" class="btn btn-success mb-3 "><i class="fa fa-edit"></i></a></li>
                                                <!-- pesan konfirmasi -->
                                                <li><a href="<?= base_url('Admin/hapus_users/' . $s->id_users) ?>" class="btn btn-danger mb-3" onclick="return confirm(' apakah data user mau dihapus?')"><i class="ti-trash"></i></a></li>
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
                                    <td colspan="5" align="centter">data kosong</td>
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