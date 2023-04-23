        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Data Obat</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Data Obat</li>
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
                            <div class="card">

                                <div class="card-header">
                                    <a href="<?php echo site_url('data_obat/create') ?>" class="btn btn-sm btn-primary">Tambah Data</a>
                                    <a onclick="location.reload();" class="btn btn-sm btn-success">Refresh</a>
                                    <!-- <a href="<?php echo site_url('data_obat/to_pdf') ?>" class="btn-sm btn-success">Import Data</a> -->
                                    <button type="submit" class="btn btn-sm btn-primary" title="Import Data Obat" data-toggle="modal" data-target="#modalImport"> Import Data Obat</button>
                                </div>

                                <!-- Modal Import-->
                                <div class="modal fade" id="modalImport" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                    <div class="modal-dialog" role="daily_pcr">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Import Data Obat</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <i aria-hidden="true" class="ki ki-close"></i>
                                                </button>
                                            </div>
                                            <?php echo form_open_multipart("home_page/import_obat") ?>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input type="file" class="form-control" placeholder="" name="guest_import_file" required="required" accept=".xls, .xlsx">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary font-weight-bold">Import</button>
                                                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Batal</button>
                                                <?php echo form_close(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="tabel_1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Obat</th>
                                                <th>Satuan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // var_dump($files); die;
                                            $no = 1;
                                            if (!empty($files)) :
                                                foreach ($files as $file) :
                                            ?>

                                                    <tr>
                                                        <td> <?php echo $no ?> </td>
                                                        <td> <?php echo $file->nama_obat ?> </td>
                                                        <td> <?php echo $file->satuan ?> </td>
                                                        <td>
                                                            <a href="<?php echo site_url('data_obat/edit/') . $file->id_obat; ?>" class="btn btn-sm btn-primary">Edit</a>
                                                            <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalDelete<?php echo $file->id_obat ?>">Hapus</a>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal Delete-->
                                                    <div class="modal fade" id="modalDelete<?php echo $file->id_obat ?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <i aria-hidden="true" class="ki ki-close"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah anda yakin akan menghapus obat <?php echo $file->nama_obat; ?> ?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="<?php echo site_url('data_obat/delete/') . $file->id_obat; ?>" class="btn btn-danger font-weight-bold">Hapus</a>
                                                                    <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Batal</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                            <?php

                                                    $no++;
                                                endforeach;
                                            endif;
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