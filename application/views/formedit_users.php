<!-- basic form start -->
<div class="col-12 mt-6">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">Isi Users</h4>
            <?php echo form_open('Admin/edit_users'); ?>
            <?php echo form_hidden("id", $us->id_users); ?>
            <div class="form-group">
                <!-- nama lengkap -->
                <label for="nl">Nama Lengkap</label>

                <!-- tampilan -->
                <?php echo form_input("nama_lengkap", $us->nama_lengkap, array(
                    'class' => 'form-control', 'id' => 'nama_lengkap',
                    'placeholder' => 'isi nama lengkap'
                )); ?>
                <!-- validasi cek  menggunakn botton jg bisa-->
                <small class="text-danger">

                    <!-- dismiss alert area start -->
                    <!-- <div class="row">
        <div class="col-md-6">
            <div class="alert alert-danger alert-dismissible fade show" role="alert"> -->
                    <?php echo form_error('nama_lengkap', ''); ?>
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>
                </button> -->



                </small>

            </div>


            <label for="kk">Username</label>

            <!-- tampilan -->
            <?php echo form_input("username", $us->username, array(
                'class' => 'form-control', 'id' => 'username',
                'placeholder' => 'isi username'
            )); ?>
            <!-- validasi cek  menggunakn botton jg bisa-->
            <small class="text-danger">

                <!-- dismiss alert area start -->
                <!-- <div class="row">
                        <div class="col-md-6">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"> -->
                <?php echo form_error('username', ''); ?>
                <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>
                                </button> -->



            </small>

        </div>
        <!-- yg kedua password -->
        <div class="form-group">
            <label for="nk">Password*)</label>

            <!-- tampilan -->
            <?php echo form_password(
                "password",
                set_value('password'),
                array(
                    'class' => 'form-control', 'id' => 'password',
                    'placeholder' => 'isi password'
                )
            ); ?>
            <!-- validasi cek -->
            <small class="text-danger">
                <!-- dismiss alert area start -->
                <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"> -->
                <?php echo form_error('password', ''); ?>
                <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>
                                </button> -->

            </small>
        </div>
        <!-- yg kedua confirmasi -->
        <div class="form-group">
            <label for="nk">Confirmasi Password*)</label>

            <!-- tampilan -->
            <?php echo form_password(
                "compassword",
                set_value('compassword'),
                array(
                    'class' => 'form-control', 'id' => 'compassword',
                    'placeholder' => 'isi  confirmasi password'
                )
            ); ?>
            <!-- validasi cek -->
            <small class="text-danger">
                <!-- dismiss alert area start -->
                <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"> -->
                <?php echo form_error('compassword', ''); ?>
                <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>
                                </button> -->

            </small>
        </div>

        <label for="email">Email</label>

        <!-- tampilan -->
        <?php echo form_input("email", $us->email, array(
            'class' => 'form-control', 'id' => 'email',
            'placeholder' => 'isi email'
        )); ?>
        <!-- validasi cek  menggunakn botton jg bisa-->
        <small class="text-danger">

            <!-- dismiss alert area start -->
            <!-- <div class="row">
        <div class="col-md-6">
            <div class="alert alert-danger alert-dismissible fade show" role="alert"> -->
            <?php echo form_error('email', ''); ?>
            <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>
                </button> -->



        </small>
    </div>
    <!-- jenis kelamin -->
    <div class="form-group">
        <label for="level"> Level:</label>

        <?php
        if ($us->level == "admin") {
            $a = true;
            $u = false;
        } else {
            $a = false;
            $u = true;
        } ?>
        <!-- tampilan -->
        <?php echo form_radio('level', 'admin', $a) ?>Admin
        <?php echo form_radio('level', 'users', $u) ?>Users
        </br>
        <small class="text-danger">
            <!-- dismiss alert area start -->
            <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"> -->
            <?php echo form_error('lv', ''); ?>
            <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>
                                </button> -->
        </small>


    </div>
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














</div>