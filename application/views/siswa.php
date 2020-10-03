<!-- tabel progres -->
<!-- Progress Table start -->
<div class="col-12 mt-5">
    <div class="card">
        <div class="card-body">
            <!-- tombol tambah data -->
            <?php echo anchor('Admin/tambah_siswa', 'Tambah Data Siswa', array('class' => "btn btn-primary mb-3 fa fa-database")); ?>

            <div class="single-table">
                <div class="table-responsive">
                    <table class="table table-hover progress-table text-center" id="siswa">
                        <thead class="text-uppercase">
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">Tahun Pelajaran</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Foto</th>
                                <th scope="col">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- terkoneksi dan modivikasi dan copy di guru -->
                            <?php


                            $no = 1;
                            foreach ($sis->result_object() as $r) {
                                # code...




                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $r->tahun_pelajaran; ?></td>
                                    <td><?= $r->nama_siswa; ?></td>
                                    <td>
                                        <?php
                                        if ($r->jk_siswa == 'L') {
                                            #   jika emang benar laki2
                                            $jk = "laki-laki";
                                        } else {
                                            # jika bukan laki2 maka perempuan
                                            $jk = "perempuan";
                                        }
                                        echo $jk;
                                        ?>
                                    </td>
                                    <td>
                                        <!-- pemanggilan foto harus sama dgn nama yg didatabase -->

                                        <?php
                                        if (!$r->foto) {
                                            #   jika emang gru tdk ada maka tampil gak ada
                                        ?>
                                            <img src="<?= base_url('assets/images/siswa/fotokosong.gif'); ?>" alt="" srcset="">
                                        <?php
                                        } else {
                                            # jika ada maka akan muncul dr database
                                        ?>
                                            <img src="<?= base_url('assets/images/siswa/' . $r->foto); ?>" alt="" srcset="">
                                        <?php
                                        }

                                        ?>

                                    </td>

                                    <td>
                                        <ul class="d-flex justify-content-center">
                                            <li class="mr-3"><a href="<?= base_url('Admin/formedit_siswa/' . $r->id_siswa); ?>" class="btn btn-success mb-3"><i class="fa fa-edit"></i></a></li>
                                            <!-- pesan konfirmasi -->
                                            <li><a href="<?= base_url('Admin/hapus_siswa/' . $r->id_siswa); ?>" class="btn btn-danger mb-3" onclick="return confirm(' apakah data siswa mau dihapus?')"><i class="ti-trash"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                            <?php
                                $no++;
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