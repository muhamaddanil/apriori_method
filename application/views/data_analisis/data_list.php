        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Analisis Pemakaian Obat</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Analisis Pemakaian Obat</li>
                            </ol>
                        </div>
                    </div>
            </section>

            <?php if ($this->session->flashdata('alert')) {
                echo $this->session->flashdata("alert");
            } ?>

            <?php
            $execution_time2 = microtime(true);
            ?>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Pilih data obat yang akan dianalisis <a onclick="location.reload();" class="btn btn-sm btn-success float-right">Refresh</a></h5>
                                </div>

                                <?php echo form_open_multipart('data_analisis/method') ?>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Piih Obat</label>
                                                <select class="form-control select2" name="input_id_obat" id="" required>
                                                    <!-- <option value="" readonly>--Pilih Obat--</option> -->
                                                    <?php
                                                    foreach ($data_obat as $key => $value) { ?>
                                                        <?php if (isset($input_id_obat)) {
                                                            if ($value->id_obat == $input_id_obat) { ?>
                                                                <option value="<?php echo $value->id_obat; ?>" selected><?php echo $value->nama_obat; ?></option>
                                                            <?php } else { ?>
                                                                <option value="<?php echo $value->id_obat; ?>"><?php echo $value->nama_obat; ?></option>
                                                            <?php }
                                                        } else { ?>
                                                            <option value="<?php echo $value->id_obat; ?>"><?php echo $value->nama_obat; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-2">
                                            <div class="form-group">
                                                <label>Tanggal Mulai</label>
                                                <input type="date" class="form-control" name="tgl_mulai" required value="<?php if (isset($input_tgl_mulai)) echo $input_tgl_mulai ?>">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-2">
                                            <div class="form-group">
                                                <label>Tanggal Selesai</label>
                                                <input type="date" class="form-control" name="tgl_selesai" required value="<?php if (isset($input_tgl_selesai)) echo $input_tgl_selesai ?>">

                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-3">
                                            <div class="form-group">
                                                <label>Jumlah Kombinasi Maksimal</label>
                                                <input type="number" class="form-control" name="jml_kombinasi" placeholder="Kombinasi Maksimal" min="1" max="5" value="<?php if (isset($input_jml_kombinasi)) echo $input_jml_kombinasi ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-2">
                                            <div class="form-group">
                                                <label>Minimum Support (%)</label>
                                                <input type="number" class="form-control" name="min_support" placeholder="Minimum Support" min="1" max="100" value="<?php if (isset($input_min_support)) echo $input_min_support ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-3">
                                            <div class="form-group">
                                                <label>Minimum Confidence (%)</label>
                                                <input type="number" class="form-control" name="minimum_confidence" placeholder="Minimum Confidence" min="1" max="100" value="<?php if (isset($input_minimum_confidence)) echo $input_minimum_confidence ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Analisis</button>
                                </div>
                                <?php echo form_close() ?>
                            </div>


                            <div class="card">

                                <div class="card-header">
                                    <div class="row" id="kombinasi-bar">
                                        <style>

                                        </style>
                                        <?php
                                        if (isset($kombinasi)) {
                                            for ($i = 1; $i <= $input_jml_kombinasi; $i++) {
                                                $show = '#acddb7';
                                                if ($i == 1) {
                                                    $show = '#28a745';
                                                } ?>
                                                <btn href="#" class="col btn p-3 mx-3 btn-kombinasi" style="background-color:<?php echo $show ?>">
                                                    <?php echo $i ?> Kombinasi
                                                </btn>
                                        <?php }
                                        } ?>
                                    </div>
                                </div>

                                <div class="card-body">

                                    <?php
                                    if (isset($data_kosong)) {
                                        '<h2 class="text-secondary">' . $data_kosong . '</h2>';
                                    }
                                    ?>


                                    <?php
                                    if (isset($kombinasi)) {
                                        for ($i = 0; $i <= $input_jml_kombinasi; $i++) {
                                            $show = 'none';
                                            if ($i == 0) {
                                                $show = 'block';
                                            } ?>
                                            <div class="kombinasi-table" style="display:<?php echo $show ?>">
                                                <table id="tabel_analisis_<?php echo $i ?>" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <!-- <th>Jumlah Kombinasi</th> -->
                                                            <th>Kombinasi Obat</th>
                                                            <th>Itemset</th>
                                                            <th>Support</th>
                                                            <th>Nilai Confidence</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $nomor = 0;
                                                        // $kombinasi[$i] = array_unique((array)$kombinasi[$i], SORT_REGULAR);
                                                        foreach ($kombinasi[$i] as $key => $value) {
                                                            if ($value->support > 0) {
                                                                // if ($value['support_percent'] >= $input_min_support and $value['confidence'] >= $input_minimum_confidence) {

                                                                $nomor++;
                                                                $color_support = 'text-success';
                                                                if ($value->support < $input_min_support)
                                                                    $color_support = 'text-danger';

                                                                $color_confidence = 'text-success';
                                                                if ($value->confidence < $input_minimum_confidence)
                                                                    $color_confidence = 'text-danger'; ?>

                                                                <!-- HTML -->
                                                                <tr>
                                                                    <td><?php echo $nomor ?></td>
                                                                    <td>
                                                                        <ul>
                                                                            <?php
                                                                            $exp_arr = explode(',', $value->id_obat);
                                                                            foreach ($exp_arr as $value2) {
                                                                                if (!empty($this->m_data_obat->read($value2))) {
                                                                                    echo '<li>' . $this->m_data_obat->read($value2)[0]->nama_obat . '</li>';
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </ul>
                                                                    </td>
                                                                    <td><?php echo $value->jlm_item ?></td>
                                                                    <td class="<?php echo $color_support ?>"><b><?php echo number_format($value->support, 2, ',', '.') . '%' ?></b></td>
                                                                    <td class="<?php echo $color_confidence ?>"><b><?php echo  number_format($value->confidence, 2, ',', '.') . '%' ?></b></td>
                                                                </tr>
                                                                <!-- END HTML -->
                                                        <?php
                                                            }
                                                        }

                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                    <?php }
                                    } ?>
                                </div>
                                <?php
                                $execution_time2 = number_format(microtime(true) - $execution_time2, 10, '.', ',');
                                ?>
                                <div class="card-footer">
                                    <small class="text-secondary">
                                        executed in
                                        <?php if (isset($execution_time)) echo $execution_time + $execution_time2;
                                        else echo 0 ?>
                                        seconds.
                                    </small>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

        </div>