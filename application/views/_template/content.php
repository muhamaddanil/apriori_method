        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Beranda</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active"><b><?php echo $this->session->userdata('nama_grup') ?></b></li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <!-- alert  -->
                        <?php //if ($this->session->flashdata('alert')) echo $this->session->flashdata("alert")
                        ?>

                        <!-- ./col -->
                        <div class="col-lg-12 col-12">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <p style="font-size: 20px;">Selamat datanng Kembali</p>
                                    <p style="font-size: 40px; font-family: Verdana, Geneva, Tahoma, sans-serif;"><b><?php echo $this->session->userdata('nama_lengkap') ?></b></p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <a href="data_pengguna" class="small-box-footer"> Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <p style="font-size: 20px;">Jumlah Obat</p>
                                    <p style="font-size: 40px; font-family: Verdana, Geneva, Tahoma, sans-serif;"><b><?php echo $jumlah_obat ?></b></p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-pills"></i>
                                </div>
                                <a href="data_obat" class="small-box-footer"> Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <!-- ./col -->
                        <div class="col-lg-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <p style="font-size: 20px;">Hari</p>
                                    <p style="font-size: 40px; font-family: Verdana, Geneva, Tahoma, sans-serif;"><b id="day">Hari</b></p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                            </div>
                        </div>

                        <!-- ./col -->
                        <div class="col-lg-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <p style="font-size: 20px;">Pukul</p>
                                    <p style="font-size: 40px; font-family: Verdana, Geneva, Tahoma, sans-serif;"><b id="time">00.00</b></p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                        </div>

                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- ./wrapper -->

        <script>
            function startTime() {
                var today = new Date();
                var h = today.getHours();
                var m = today.getMinutes();
                var s = today.getSeconds();
                m = checkTime(m);
                s = checkTime(s);
                document.getElementById('time').innerHTML =
                    h + ":" + m + ":" + s;
                var t = setTimeout(startTime, 1000);
            }

            function checkTime(i) {
                if (i < 10) {
                    i = "0" + i
                }; // add zero in front of numbers < 10
                return i;
            }
            startTime();

            var fullDate = new Date();
            var day = fullDate.getDay();
            var date = fullDate.getDate();
            var month = fullDate.getMonth();
            var year = fullDate.getFullYear();
            var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            document.getElementById("day").innerHTML = days[day] + ', ' + date + ' ' + months[month] + ' ' + year;
        </script>