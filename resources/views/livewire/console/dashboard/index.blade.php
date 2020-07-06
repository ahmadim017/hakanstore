
    <script>
        $(function () {
            $('#order-masuk').highcharts({
                chart: { 
                    type: 'column',
                    margin: 75,
                    options3d: {
                        enabled: false,
                        alpha: 10,
                        beta: 25,
                        depth: 70
                    }
                },
                title: {
                    text: 'STATISTIK ORDER MASUK TAHUN {{ date("Y") }}', 
                    style: {
                        fontSize: '18px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                },
                subtitle: {
                    text: "HAKAN-STORE",
                    style: {
                        fontSize: '15px',
                        fontFamily: 'Quicksand, sans-serif'
                    }
                },
                plotOptions: {
                    column: {
                        depth: 25,
                        colorByPoint: true
                    }
                },
                credits: {
                    enabled: false
                },
                xAxis: {
                    categories: @isset($bulan) {!!json_encode($bulan) !!},
                    @endisset
                },
                exporting: {
                    enabled: false
                }, 
                yAxis: {
                    title: {
                        text: ''
                    },
                },
                tooltip: {
                    formatter: function () {
                        return ' Jumlah Order Masuk di Bulan <b>' + this.x +'</b> : <b>' + Highcharts.numberFormat(this.y, 0) + '</b>';
                    }
                },
                series: [{
                    name: "JUMLAH : {{ $count_order_year }} ORDER DI TAHUN {{date('Y') }}",
                    data: @isset($jumlah) {!!json_encode($jumlah) !!},
                    @endisset
                    shadow: true,
                    dataLabels: {
                        enabled: true,
                        color: '#045396',
                        align: 'center',
                        formatter: function () { 
                            return Highcharts.numberFormat(this.y, 0);
                            }, // one decimal
                        y: 0, // 10 pixels down from the top
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                }]
            });
        });
    </script>
    <div class="row justify-content-center">
        <div class="col-md-8 mb-5 mt-5">
            <div class="card border-0 shadow rounded-lg">
                <div class="card-header">
                    <i class="fa fa-chart-pie"></i> STATISTIC ORDERS THIS YEAR
                </div>
                <div class="card-body">
                    <div class="row text-center justify-content-center">
                        <div class="col-6 col-md-2 mb-3">
                            <h3 class="font-weight-bold text-center">{{$count_order_pending_year }}</h3>
                            <label style="color: red"><i class="fa fa-circlenotch fa-spin"></i>Pending</label>
                       </div>
                       <div class="col-6 col-md-2 mb-3">
                           <h3 class="font-weight-bold text-center">{{$count_order_review_year}}</h3>
                            <label style="color:#ff5722"><i class="fa faspinner fa-spin"></i>In Review</label>
                       </div>
                       <div class="col-6 col-md-2 mb-3">
                           <h3 class="font-weight-bold text-center">{{$count_order_progress_year}}</h3>
                           <label style="color:blue"><i class="fa fa hourglass-start"></i>Progress</label>
                       </div>
                        <div class="col-6 col-md-2 mb-3">
                            <h3 class="font-weight-bold text-center">{{$count_order_shipping_year }}</h3>
                            <label style="color: purple"><i class="fa fatruck"></i>Shipping</label>
                        </div>
                        <div class="col-6 col-md-2 mb-3">
                            <h3 class="font-weight-boldtext-center">{{$count_order_completed_year}}</h3>
                            <label style="color:green"><i class="fa fa-check circle"></i>Completed</label>
                        </div>
                   </div>
               </div>
           </div>
       </div>
       <div class="col-md-4 mb-5 mt-5">
            <div class="card border-0 shadow rounded-lg">
                    <div class="card-header">
                        <i class="fa fa-dollar-sign"></i>INFORMATION INCOME
                    </div>
                    <div class="card-body">
                        <div class="row">
                                <div class="col-12 col-md-12 mb-3">
                                    <h3 class="font-weight-bold">{{money_id($total_revenue_month) }}</h3>
                                    <label>INCOME THIS MONTH</label>
                                </div>
                                <div class="col-12 col-md-12 mb-3">
                                    <h3 class="font-weight-bold">{{money_id($total_revenue_all) }}</h3>
                                    <label>ALL INCOME</label>
                                </div>
                        </div>
                    </div>
            </div> 
        </div>
    </div>
    
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded-lg">
                <div class="card-header">
                    <i class="fa fa-chart-line"></i> STATISTIK ORDERS THIS YEAR
                </div>
                <div class="card-body">
                    <div id="order-masuk"></div>
                </div>
            </div>
        </div>
    </div>

