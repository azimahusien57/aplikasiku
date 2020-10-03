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
            <?php echo anchor('Admin/tambah_guru', 'Tambah Data Guru', array('class' => "btn btn-primary mb-3 fa fa-database")); ?>

            <div class="single-table">
                <div class="table-responsive">
                    <!-- jgn lupa id,setelah itu ke templet/footer -->
                    <table class="table table-hover progress-table text-center" id="guru">
                        <thead class="text-uppercase">
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">NIP</th>
                                <th scope="col">Nama Guru</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Foto</th>
                                <th scope="col">action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <!-- biar terkoneksi dgn table guru -->
                            <?php
                            $no = 1;
                            foreach ($gr->result_object() as $r) {
                                # code...


                            ?>
                                <tr>
                                    <th scope="row"><?= $no; ?></th>
                                    <td><?= $r->nip; ?></td>
                                    <td><?= $r->nama_guru; ?></td>


                                    <!-- fild jk -->
                                    <td>
                                        <?php
                                        if ($r->jk_guru == 'L') {
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
                                        <!-- pemanggilan foto -->

                                        <?php
                                        if (!$r->foto_guru) {
                                            #   jika emang gru tdk ada maka tampil gak ada
                                        ?>
                                            <img src="<?= base_url('assets/images/guru/fotokosong.gif'); ?>" alt="" srcset="">
                                        <?php
                                        } else {
                                            # jika ada maka akan muncul dr database
                                        ?>
                                            <img src="<?= base_url('assets/images/guru/' . $r->foto_guru); ?>" alt="" srcset="">
                                        <?php
                                        }

                                        ?>

                                    </td>
                                    <td>
                                        <ul class="d-flex justify-content-center">
                                            <!-- halaman dibuat diview -->
                                            <li class="mr-3"><a href="<?= base_url('Admin/formedit_guru/' . $r->id_guru); ?>" class="btn btn-success mb-3"><i class="fa fa-edit"></i></a></li>
                                            <!-- pesan konfirmasi -->
                                            <li><a href="<?= base_url('Admin/hapus_guru/' . $r->id_guru); ?>" class="btn btn-danger mb-3" onclick="return confirm(' apakah data guru mau dihapus?')"><i class="ti-trash"></i></a></li>
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