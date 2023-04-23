        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Data Laporan Pemakaian Obat</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Data Laporan</li>
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
                                    <!-- <a href="<?php echo site_url('data_pemakaian_obat/create') ?>" class="btn-sm btn-primary">Tambah Data</a> -->
                                    <!-- <a href="" class="btn-sm btn-success">Import Data</a> -->
                                    <a onclick="location.reload();" class="btn btn-sm btn-success">Refresh</a>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="tabel_1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="30px">No</th>
                                                <th>Bulan</th>
                                                <th>Tahun</th>
                                                <th width="30%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $arrayMonth = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

                                            $no = 1;
                                            foreach (array_reverse($files) as $file) :
                                            ?>


                                                <tr>
                                                    <td> <?php echo $no ?> </td>
                                                    <td>
                                                        <?php
                                                        $num = 0;
                                                        foreach ($arrayMonth as $arr) {
                                                            if ($file->bulan == $num) {
                                                                echo $arrayMonth[$num];
                                                            }
                                                            $num++;
                                                        }
                                                        ?>
                                                    </td>
                                                    <td> <?php echo $file->tahun ?> </td>
                                                    <td>
                                                        <a href="<?php echo site_url('data_laporan/to_pdf/') . $file->tahun . '/' . $file->bulan; ?>" class="btn-sm btn-danger">Download</a>
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