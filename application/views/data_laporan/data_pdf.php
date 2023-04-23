<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>to_pdf</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            padding: 40px;
            font-size: 8px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        #data th,
        #data td {
            text-align: left;
            border: 1px solid black;
            padding: 5px 10px;
        }
    </style>
</head>

<body>
    <div id="container">

        <?php $arrayMonth = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']; ?>

        <h3 style="font-size: 11px;">Laporan Pemakaian Obat <?php echo $arrayMonth[$laporan[0]->bulan] . ' ' . $laporan[0]->tahun; ?></h3>
        <br>
        <table border="0">
            <tr>
                <td width="100px">Kode Puskesmas</td>
                <td>: <?php echo $setting[0]->kode_puskesmas ?></td>
            </tr>
            <tr>
                <td>Puskesmas</td>
                <td>: <?php echo $setting[0]->nama_puskesmas ?></td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>: <?php echo $setting[0]->kecamatan ?></td>
            </tr>
            <tr>
                <td>Kabupaten / Kota</td>
                <td>: <?php echo $setting[0]->kabupaten ?></td>
            </tr>
            <tr>
                <td>Provinsi</td>
                <td>: <?php echo $setting[0]->provinsi ?></td>
            </tr>
        </table>
        <br>

        <div id="body">
            <table id="data">
                <thead>
                    <tr style="background-color: #7eec98;">
                        <th>
                            <center>No</center>
                        </th>
                        <th>Nama Obat</th>
                        <th>Satuan</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Stok Awal</th>
                        <th>Penerimaan</th>
                        <th>Persediaan</th>
                        <th>Sisa Stok</th>
                        <th>Pemakaian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php


                    $no = 1;
                    $total_stok_awal = 0;
                    $total_penerimaan = 0;
                    $total_persediaan = 0;
                    $total_sisa_stok = 0;
                    $total_pemakaian = 0;
                    foreach ($laporan as $file) :
                    ?>
                        <tr>
                            <td>
                                <center><?php echo $no . '.' ?></center>
                            </td>
                            <td> <?php echo $file->nama_obat ?> </td>
                            <td> <?php echo $file->satuan ?> </td>
                            <td>
                                <?php $num = 0;
                                foreach ($arrayMonth as $arr) {
                                    if ($file->bulan == $num) {
                                        echo $arrayMonth[$num];
                                    }
                                    $num++;
                                }
                                ?>
                            </td>
                            <td> <?php echo $file->tahun ?> </td>
                            <td> <?php echo $file->stok_awal ?> </td>
                            <td> <?php echo $file->penerimaan ?> </td>
                            <td> <?php echo $file->persediaan ?> </td>
                            <td> <?php echo $file->sisa_stok ?> </td>
                            <td> <?php echo $file->persediaan - $file->sisa_stok ?> </td>
                        </tr>
                    <?php
                        $no++;
                        $total_stok_awal += $file->stok_awal;
                        $total_penerimaan += $file->penerimaan;
                        $total_persediaan += $file->persediaan;
                        $total_sisa_stok += $file->sisa_stok;
                        $total_pemakaian += ($file->persediaan - $file->sisa_stok);
                    endforeach;
                    ?>
                <tfoot>
                    <tr>
                        <th colspan="5">Total </th>
                        <th> <?php echo $total_stok_awal ?> </th>
                        <th> <?php echo $total_penerimaan ?> </th>
                        <th> <?php echo $total_persediaan ?> </th>
                        <th> <?php echo $total_sisa_stok ?> </th>
                        <th> <?php echo $total_pemakaian ?> </th>
                    </tr>
                </tfoot>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>