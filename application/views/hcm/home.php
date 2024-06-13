<style>
    .header-title {
        margin-top: 20px;
        margin-bottom: 20px;
        margin-left: 20px;
    }

    h6 {
        color: #fff;
        font-size: 16px !important;
        margin-bottom: 3px;
        margin-left: 15px;
    }

    .footer-title {
        margin-bottom: 20px;
    }

    .sbg3 {
        border-radius: 10px;
    }

    .card-body .row .col-md-6 {
        word-wrap: break-word;
        white-space: normal;
    }
</style>
<div class="col-lg-12 col-ml-12 mx-auto">
    <div class="col-12 mt-2">
        <div class="card mt-3 mb-2">
            <div class="row mt-4 mb-5">
                <div class="card-body col-4">
                    <div class="row" style="margin-left:40px;">
                        <div class="col-12 mt-3 mb-3">
                            <div>
                                <h5 class="mt-0">Total Surat (PD-DN)</h5>
                                <p class="text-muted">Jumlah surat pengajuan dinas dalam negri</p>
                                <h2 class="text-primary"><?php echo $total_pd_dn; ?></h2>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div>
                                <h5 class="mt-0">Total Surat (PD-DL)</h5>
                                <p class="text-muted">Jumlah surat pengajuan dinas luar negri</p>
                                <h2 class="text-primary"><?php echo $total_pd_dl; ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body col-8">
                    <div id="salesanalytic" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil data dari variabel PHP
        var chartData = <?php echo json_encode($chart_data); ?>;

        // Periksa apakah data diterima dengan benar
        console.log(chartData);

        // Mengelompokkan data berdasarkan tahun
        var dataByYear = {};
        chartData.forEach(function (item) {
            var year = item.tahun; // Tahun sudah dalam format yyyy
            if (!dataByYear[year]) {
                dataByYear[year] = [];
            }
            dataByYear[year].push(item);
        });

        // Menyusun data untuk setiap tahun
        var chartDataByYear = [];
        for (var year in dataByYear) {
            if (dataByYear.hasOwnProperty(year)) {
                var yearData = dataByYear[year];
                var totalDLN = 0;
                var totalDDN = 0;
                yearData.forEach(function (data) {
                    totalDLN += data.dln;
                    totalDDN += data.ddn;
                });
                chartDataByYear.push({
                    "tahun": year,
                    "dln": totalDLN,
                    "ddn": totalDDN
                });
            }
        }

        // Inisialisasi grafik menggunakan data yang diterima dari controller
        var chart = AmCharts.makeChart("salesanalytic", {
            "type": "serial",
            "theme": "light",
            "valueAxes": [{
                "id": "v1",
                "title": "Sales",
                "position": "left",
                "autoGridCount": false,
                "labelFunction": function (value) {
                    return Math.round(value); // Display as integer
                }
            }, {
                "id": "v2",
                "gridAlpha": 0,
                "position": "right",
                "autoGridCount": false
            }],
            "graphs": [{
                "id": "g1",
                "valueAxis": "v2",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "hideBulletsCount": 50,
                "lineThickness": 2,
                "lineColor": "#815FF6",
                "type": "smoothedLine",
                "title": "Dinas Luar Negri",
                "useLineColorForBulletBorder": true,
                "valueField": "dln", // Sesuaikan dengan nama kolom pada data
                "balloonText": "[[title]]<br /><small style='font-size: 130%'>[[value]]</small>" // Display as integer
            }, {
                "id": "g2",
                "valueAxis": "v2",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "hideBulletsCount": 50,
                "lineThickness": 2,
                "lineColor": "#ffe598",
                "type": "smoothedLine",
                "dashLength": 5,
                "title": "Dinas Dalam Negri",
                "useLineColorForBulletBorder": true,
                "valueField": "ddn", // Sesuaikan dengan nama kolom pada data
                "balloonText": "[[title]]<br /><small style='font-size: 130%'>[[value]]</small>" // Display as integer
            }],
            "categoryField": "tahun", // Sesuaikan dengan nama kolom pada data
            "categoryAxis": {
                "gridPosition": "start",
                "gridAlpha": 0,
                "tickPosition": "start",
                "tickLength": 20
            },
            "dataProvider": chartDataByYear, // Gunakan data yang telah dikelompokkan berdasarkan tahun
            "legend": {
                "useGraphSettings": true,
                "position": "top"
            },
            "balloon": {
                "borderThickness": 1,
                "shadowAlpha": 0
            },
            "export": {
                "enabled": false
            }
        });
    });
</script>