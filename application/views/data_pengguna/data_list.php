        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>DataTables</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">DataTables</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- alert  -->

            <!-- alert  -->


            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- alert  -->
                            <?php if ($this->session->flashdata('alert')) {
                                echo $this->session->flashdata("alert");
                            } ?>
                            <div class="card">
                                <div class="card-header">
                                    <a href="<?php echo site_url('data_pengguna/create') ?>" class="btn btn-sm btn-primary">Tambah Data</a>
                                    <a onclick="location.reload();" class="btn btn-sm btn-success">Refresh</a>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="tabel_1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Username</th>
                                                <th>Nama Pengguna</th>
                                                <th>Kategori</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($files as $file) :
                                            ?>
                                                <tr>
                                                    <td> <?php echo $no ?> </td>
                                                    <td> <?php echo $file->username ?> </td>
                                                    <td> <?php echo $file->nama_lengkap ?> </td>
                                                    <td> <?php echo $file->nama_grup ?> </td>
                                                    <td><a href="<?php echo site_url('data_pengguna/edit/') . $file->id_pengguna; ?>" class="btn-sm btn-primary">Edit</a>
                                                        <a href="<?php echo site_url('data_pengguna/delete/') . $file->id_pengguna; ?>" class="btn-sm btn-danger">Hapus</a>
                                                    </td>
                                                </tr>
                                            <?php
                                                $no++;
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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