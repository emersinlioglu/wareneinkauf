<?php
use dosamigos\chartjs\ChartJs;
use miloschuman\highcharts\Highcharts;
/* @var $this yii\web\View */

//$this->title = 'ABG Projekt Manager';
$this->title = '';
?>
<div class="site-index">

    <div class="jumbotron">

        <img src="/images/logo.png" style="max-width: 200px;" alt="ABG">
        <p class="lead">
            <?php
            $uhrzeit = date('H');

            if ($uhrzeit >= 3 && $uhrzeit < 12) {
                echo 'Guten Morgen!';
            } elseif ($uhrzeit >= 12 && $uhrzeit < 18) {
                echo 'Guten Tag!';
            } elseif ($uhrzeit >= 18 && $uhrzeit < 22) {
                echo 'Guten Abend!';
            } elseif ($uhrzeit >= 22 && $uhrzeit < 3) {
                echo 'Gute Nacht!';
            }

            ?>

        </p>

        <h1>Willkommen </h1>
        <p class="lead">
            bei ABG Wohnungsportal
        </p>
        <!--        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>-->
    </div>

    <div class="body-content">


        <?php
        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => 'Verkaufsentwicklung'],
//                'xAxis' => [
//                    'categories' => ['Apples', 'Bananas', 'Oranges']
//                ],
//                'yAxis' => [
//                    'title' => ['text' => 'Fruit eaten']
//                ],
//                'series' => [
//                    ['name' => 'Jane', 'data' => [1, 0, 4]],
//                    ['name' => 'John', 'data' => [5, 7, 3]]
//                ]
                'chart'=> [
                    'plotBackgroundColor'=> null,
                    'plotBorderWidth'=> null,
                    'plotShadow'=> false,
                    'type'=> 'pie'
                ],
                'tooltip'=> [
                        'pointFormat'=> '{series.name}: <b>{point.percentage:.2f}%</b>'
                ],
                'plotOptions'=> [
                    'pie'=> [
                        'allowPointSelect'=> true,
                        'cursor'=> 'pointer',
                        'dataLabels'=> [
                            'enabled'=> true,
                            'format'=> '<b>{point.name}</b>: {point.y:.2f} m²',
                            'style'=> [
                                'color'=> "(Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'"
                            ],
                            'connectorColor'=> 'silver'
                        ]
                    ]
                ],
                'series'=> [
                    [
                        'name'=> 'Einheitstyp',
                        'data'=> $verkaufsentwicklungDataProProjekt,
                        'size'=> '75%',
                        'innerSize'=> '50%',
                        'dataLabels'=> [
                            'formatter'=> "function () {
                                // display only if larger than 1
                                return this.y > 1 ? '<b>' + this.point.name + ':</b> ' + this.y + '%' : null;
                            }"
                        ]
                    ],
                    [
                        'name'=> 'Projekte',
                        'data'=> $verkaufsentwicklungData,
                        'size'=> '50%',
                        'dataLabels'=> [
                            'formatter'=> 'function () {
                                return this.y > 5 ? this.point.name : null;
                            }',
                            'color'=> '#ffffff',
                            'distance'=> -30
                        ]
                    ],

                ]
            ]
        ]);
        ?>


        <!--
        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>-->
    </div>
    <!-- page script -->
    <script>
//        $(function () {
//
//            //-------------
//            //- PIE CHART -
//            //-------------
//            // Get context with jQuery - using jQuery's .get() method.
//            var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
//            var pieChart = new Chart(pieChartCanvas);
//            var PieData = [
//                {
//                    value: 700,
//                    color: "#f56954",
//                    highlight: "#f56954",
//                    label: "Chrome"
//                },
//                {
//                    value: 500,
//                    color: "#00a65a",
//                    highlight: "#00a65a",
//                    label: "IE"
//                },
//                {
//                    value: 400,
//                    color: "#f39c12",
//                    highlight: "#f39c12",
//                    label: "FireFox"
//                },
//                {
//                    value: 600,
//                    color: "#00c0ef",
//                    highlight: "#00c0ef",
//                    label: "Safari"
//                },
//                {
//                    value: 300,
//                    color: "#3c8dbc",
//                    highlight: "#3c8dbc",
//                    label: "Opera"
//                },
//                {
//                    value: 100,
//                    color: "#d2d6de",
//                    highlight: "#d2d6de",
//                    label: "Navigator"
//                }
//            ];
//            var pieOptions = {
//                //Boolean - Whether we should show a stroke on each segment
//                segmentShowStroke: true,
//                //String - The colour of each segment stroke
//                segmentStrokeColor: "#fff",
//                //Number - The width of each segment stroke
//                segmentStrokeWidth: 2,
//                //Number - The percentage of the chart that we cut out of the middle
//                percentageInnerCutout: 50, // This is 0 for Pie charts
//                //Number - Amount of animation steps
//                animationSteps: 100,
//                //String - Animation easing effect
//                animationEasing: "easeOutBounce",
//                //Boolean - Whether we animate the rotation of the Doughnut
//                animateRotate: true,
//                //Boolean - Whether we animate scaling the Doughnut from the centre
//                animateScale: false,
//                //Boolean - whether to make the chart responsive to window resizing
//                responsive: true,
//                // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
//                maintainAspectRatio: true,
//                //String - A legend template
//                legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
//            };
//            //Create pie or douhnut chart
//            // You can switch between pie and douhnut using the method below.
//            pieChart.Doughnut(PieData, pieOptions);
//
//        }
//
//        })
//        ;
    </script>