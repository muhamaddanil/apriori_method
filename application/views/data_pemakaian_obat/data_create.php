<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Pemakaian Obat</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Pemakaian Obat</li>
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
                    <h3 class="card-title">Tambah Data Pemakaian Obat</h3>

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
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="exampleSelectBorderWidth2">Nama Obat</label>
                                <select multiple class="form-control select2" name="id_obat[]" required>
                                    <?php
                                    foreach ($obat as $row) {
                                        echo '<option value="' . $row->id_obat . '">' . $row->nama_obat . '</option>';
                                    }
                                    ?>
                                </select>
                                <span style="color:red"><?php echo form_error('id_obat'); ?></span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="form-group">
                                <label for="exampleSelectBorderWidth2">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" placeholder="Tanggal">
                                <span style="color:red"><?php echo form_error('tanggal'); ?></span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="form-group">
                                <label for="exampleSelectBorderWidth2">Bulan</label>
                                <select class="form-control" name="bulan">
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                                <span style="color:red"><?php echo form_error('bulan'); ?></span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="form-group">
                                <label for="exampleSelectBorderWidth2">Tahun</label>
                                <input type="number" class="form-control" name="tahun" placeholder="Tahun" value="<?php echo date("Y"); ?>">
                                <span style="color:red"><?php echo form_error('tahun'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleSelectBorderWidth2">Kode Transaksi</label>
                                <input type="number" class="form-control" name="kode_transaksi" placeholder="Kode Transaksi" value="<?php echo set_value('kode_transaksi'); ?>">
                                <span style="color:red"><?php echo form_error('kode_transaksi'); ?></span>
                            </div>
                        </div>
                        <!-- <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Sisa Stok</label>
                                <input type="number" min="0" class="form-control" name="sisa_stok" placeholder="Sisa Stok" value="<?php echo set_value('sisa_stok'); ?>">
                                <span style="color:red"><?php echo form_error('sisa_stok'); ?></span>
                            </div>
                        </div> -->
                    </div>

                    <!-- <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Pemakaian</label>
                                <input type="number" min="0" class="form-control" name="pemakaian" placeholder="Pemakaian" value="<?php echo set_value('pemakaian'); ?>">
                                <span style="color:red"><?php echo form_error('pemakaian'); ?></span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="exampleSelectBorderWidth2">Penerimaan</label>
                                <input type="number" class="form-control" name="penerimaan" placeholder="Penerimaan" value="<?php echo set_value('penerimaan'); ?>">
                                <span style="color:red"><?php echo form_error('penerimaan'); ?></span>
                            </div>
                        </div>
                    </div> -->

                    <!-- /input states -->
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
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