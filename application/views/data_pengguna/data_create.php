<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data pengguna</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Pengguna</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Tambah Data</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <?php echo form_open_multipart(); ?>
                <div class="card-body">

                    <!-- input states -->
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="col-form-label"> Nama pengguna</label>
                                <input type="text" class="form-control" name="nama_lengkap" placeholder="Masukkan Nama lengkap ..." value="<?php echo set_value('nama_lengkap'); ?>">
                                <span style="color:red"><?php echo form_error('nama_lengkap'); ?></span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleSelectBorderWidth2">Grup</label>
                                <select class="custom-select form-control-border border-width-2" name="id_grup" required>
                                    <option disabled selected>-- Pilih --</option>
                                    <option value="1">Administrator</option>
                                    <option value="2">Kepala Puskesmas</option>
                                </select>
                            </div>
                        </div>
                        <hr style="width: 100%; border-top: 2px solid gray; border-style: dashed; margin: 20px 10px;">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="col-form-label"> Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Masukkan Username ..." value="<?php echo set_value('username'); ?>">
                                <span style="color:red"><?php echo form_error('username'); ?></span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="col-form-label"> Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Masukkan Password ..." value="<?php echo set_value('password'); ?>">
                                <span style="color:red"><?php echo form_error('password'); ?></span>
                            </div>
                        </div>
                        <!-- /input states -->
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </div>
            <?php echo form_close() ?>

    </section>


    <!-- /.content -->
</div>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->