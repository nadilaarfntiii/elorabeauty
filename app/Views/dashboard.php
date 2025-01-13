<?php
/**
 * @var CodeIgniter\View\View $this
 */
?>

<?php $this->extend('layouts/admin') ?>

<?php $this->section('content') ?>

                        <div class="container-fluid">
                            <!-- Page Heading -->
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Dashboard Admin Elora's</h1>
                            </div>

                            <!-- Content Row -->
                            <div class="row">
                                <!-- Card Pesanan -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <a href="/kelola_pesanan" class="text-decoration-none">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                            Pesanan
                                                        </div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahPesanan; ?></div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <!-- Card Pelanggan -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <a href="/kelola_pelanggan" class="text-decoration-none">
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                            Pelanggan
                                                        </div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahPelanggan; ?></div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-users fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <!-- Card Produk -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <a href="/produk" class="text-decoration-none">
                                        <div class="card border-left-info shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                            Produk
                                                        </div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahProduk; ?></div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-box-open fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <!-- Card Pendapatan -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-warning shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                        Pendapatan
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($totalPendapatan, 0, ',', '.') ?></div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-2"> <!-- Tambahkan gap untuk mengurangi jarak antar kolom -->

                        <!-- Area Chart -->
                        <div class="col-xl-7 col-lg-8" style="margin-left: 55px;"> <!-- Margin kiri untuk grafik pendapatan -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Grafik Pendapatan</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5" style="margin-right: 16px;">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Penjualan Produk</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> MakeUp
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Skincare
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Hair & Body Care
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        // Ambil data pendapatan dari PHP
                        const pendapatanBulanan = <?= json_encode($pendapatanBulanan); ?>;

                        // Proses data untuk Chart.js
                        const labels = [];
                        const pendapatan = [];

                        pendapatanBulanan.forEach(item => {
                            labels.push(new Date(2000, item.bulan - 1, 1).toLocaleString('default', { month: 'short' }));
                            pendapatan.push(item.pendapatan);
                        });

                        // Buat chart
                        var ctx = document.getElementById("myAreaChart");
                        var myLineChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: "Pendapatan",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(255, 182, 193, 0.1)", // Pink transparan untuk background area
                                    borderColor: "rgba(255, 105, 180, 1)", // Pink untuk garis
                                    pointRadius: 3,
                                    pointBackgroundColor: "rgba(255, 105, 180, 1)", // Pink untuk titik
                                    pointBorderColor: "rgba(255, 105, 180, 1)", // Pink untuk border titik
                                    pointHoverRadius: 3,
                                    pointHoverBackgroundColor: "rgba(255, 105, 180, 1)", // Pink saat hover
                                    pointHoverBorderColor: "rgba(255, 105, 180, 1)", // Pink untuk border hover
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,
                                    data: pendapatan,
                                }],
                            },
                            options: {
                                maintainAspectRatio: false,
                                layout: {
                                    padding: {
                                        left: 10,
                                        right: 25,
                                        top: 25,
                                        bottom: 0
                                    }
                                },
                                scales: {
                                    xAxes: [{
                                        time: {
                                            unit: 'date'
                                        },
                                        gridLines: {
                                            display: false,
                                            drawBorder: false
                                        },
                                        ticks: {
                                            maxTicksLimit: 12
                                        }
                                    }],
                                    yAxes: [{
                                        ticks: {
                                            maxTicksLimit: 5,
                                            padding: 10,
                                            callback: function(value, index, values) {
                                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                                            }
                                        },
                                        gridLines: {
                                            color: "rgb(234, 236, 244)",
                                            zeroLineColor: "rgb(234, 236, 244)",
                                            drawBorder: false,
                                            borderDash: [2],
                                            zeroLineBorderDash: [2]
                                        }
                                    }],
                                },
                                legend: {
                                    display: false
                                },
                                tooltips: {
                                    backgroundColor: "rgb(255,255,255)",
                                    bodyFontColor: "#858796",
                                    titleMarginBottom: 10,
                                    titleFontColor: '#6e707e',
                                    titleFontSize: 14,
                                    borderColor: '#dddfeb',
                                    borderWidth: 1,
                                    xPadding: 15,
                                    yPadding: 15,
                                    displayColors: false,
                                    intersect: false,
                                    mode: 'index',
                                    caretPadding: 10,
                                    callbacks: {
                                        label: function(tooltipItem, chart) {
                                            const datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                            return datasetLabel + ': Rp ' + new Intl.NumberFormat('id-ID').format(tooltipItem.yLabel);
                                        }
                                    }
                                }
                            }
                        });
                    });
                    </script>

                    <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        // Ambil data dari PHP
                        const produkPerKategori = <?= json_encode($produkPerKategori); ?>;

                        // Proses data untuk Chart.js
                        const labels = produkPerKategori.map(item => item.nm_kategori);
                        const data = produkPerKategori.map(item => item.jumlah_produk);

                        // Buat chart
                        var ctx = document.getElementById("myPieChart");
                        var myPieChart = new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: labels,
                                datasets: [{
                                    data: data,
                                    backgroundColor: [
                                        '#4e73df', // Biru Gelap untuk Makeup (Primary)
                                        '#e83e8c', // Hijau Gelap untuk Skincare (Success)
                                        '#36b9cc'  // Biru Tosca Gelap untuk Hair & Body Care (Info)
                                    ],
                                    hoverBackgroundColor: [
                                        '#2e59d9', // Hover Biru Gelap
                                        '#b90056', // Hover Hijau Gelap
                                        '#2c9faf'  // Hover Biru Tosca Gelap
                                    ],
                                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                                }],
                            },
                            options: {
                                maintainAspectRatio: false,
                                tooltips: {
                                    backgroundColor: "rgb(255,255,255)",
                                    bodyFontColor: "#858796",
                                    borderColor: '#dddfeb',
                                    borderWidth: 1,
                                    xPadding: 15,
                                    yPadding: 15,
                                    displayColors: false,
                                    caretPadding: 10,
                                },
                                legend: {
                                    display: false
                                },
                                cutoutPercentage: 80,
                            },
                        });
                    });
                    </script>

<?php $this->endSection() ?>
