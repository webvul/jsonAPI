@extends('app')


@section('title')图表统计@stop

@section('content')

    <div class="templatemo-content-container">

        <div class="templatemo-content-widget white-bg">

            <div class="panel panel-default no-border">
                <div class="panel-heading border-radius-10">
                    <h2>曲线图采集统计</h2>
                </div>
                <div class="col-lg-12 form-group charts-line">
                    <form action="">
                        <div class="margin-right-15 templatemo-inline-block">
                            <input for="year" type="radio" name="radio" id="r4" value="">
                            <label for="year" class="font-weight-400"><span></span>今年</label>
                        </div>
                        <div class="margin-right-15 templatemo-inline-block">
                            <input for="month" type="radio" name="radio" id="r4" value="">
                            <label for="month" class="font-weight-400"><span></span>本月</label>
                        </div>
                        <div class="margin-right-15 templatemo-inline-block">
                            <input for="yesterday" type="radio" name="radio" id="r5" value="">
                            <label for="yesterday" class="font-weight-400"><span></span>昨天</label>
                        </div>
                        <div class="margin-right-15 templatemo-inline-block">
                            <input for="today" type="radio" name="radio" id="r6" value="">
                            <label for="today" class="font-weight-400"><span></span>今天</label>
                        </div>
                        <div class="margin-right-15 templatemo-inline-block">
                            <input for="hour" type="radio" name="radio" id="r6" value="">
                            <label for="hour" class="font-weight-400"><span></span>时时</label>
                        </div>
                    </form>
                </div>
                <div class="panel-body">
                    <div id="line_div" style="height: 300px;width: 100%;"></div>
                </div>
            </div>
            <div class="panel panel-default no-border">
                <div class="panel-heading border-radius-10">
                    <h2>饼图采集统计</h2>
                </div>
                <div class="col-lg-12 form-group charts-line">
                    <form action="">
                        <div class="margin-right-15 templatemo-inline-block">
                            <input for="year" type="radio" name="radio" id="r4" value="">
                            <label for="year" class="font-weight-400"><span></span>今年</label>
                        </div>
                        <div class="margin-right-15 templatemo-inline-block">
                            <input for="month" type="radio" name="radio" id="r4" value="">
                            <label for="month" class="font-weight-400"><span></span>本月</label>
                        </div>
                        <div class="margin-right-15 templatemo-inline-block">
                            <input for="yesterday" type="radio" name="radio" id="r5" value="">
                            <label for="yesterday" class="font-weight-400"><span></span>昨天</label>
                        </div>
                        <div class="margin-right-15 templatemo-inline-block">
                            <input for="today" type="radio" name="radio" id="r6" value="">
                            <label for="today" class="font-weight-400"><span></span>今天</label>
                        </div>
                        <div class="margin-right-15 templatemo-inline-block">
                            <input for="hour" type="radio" name="radio" id="r6" value="">
                            <label for="hour" class="font-weight-400"><span></span>时时</label>
                        </div>
                    </form>
                </div>
                <div class="panel-body">
                    <div id="pie_div"   style="width: 100%;height: 300px;"></div>
                </div>
            </div>
            <div class="panel panel-default no-border">
                <div class="panel-heading border-radius-10">
                    <h2>Area Chart</h2>
                </div>
                <div class="panel-body">
                    <div class="templatemo-flex-row flex-content-row">
                        <div class="col-1">
                            <div id="area_chart_div" class="templatemo-chart"></div>
                            <h3 class="text-center margin-bottom-5">Company Performance</h3>

                            <p class="text-center">Fusce mi lacus</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


@section('javascript')
    <script src="http://echarts.baidu.com/build/dist/echarts.js"></script>
    <script type="text/javascript">
        $(function () {
            //设置好默认选择
            $('input[for={{ $time }}]').attr('checked', 'checked');


            //按钮
            $('.templatemo-inline-block').click(function () {
                var type = $(this).find('label').attr('for');
                window.location.href = '/charts/index/' + type;
            })


        })

        $(function () {
            // 路径配置
            require.config({
                paths: {
                    echarts: 'http://echarts.baidu.com/build/dist'
                }
            });

            // 使用
            require(
                    [
                        'echarts',
                        'echarts/chart/line' // 使用折线
                    ],
                    function (ec) {
                        // 基于准备好的dom，初始化echarts图表
                        var myChart = ec.init(document.getElementById('line_div'), 'macarons');

                        option = {
                            title: {
                                text: '曲线图采集统计',
                                subtext: '从每日0点开始计算'
                            },
                            tooltip: {
                                trigger: 'axis'
                            },
                            legend: {
                                data: ['facebook', 'twitter']
                            },
                            toolbox: {
                                show: true,
                                feature: {
                                    restore: {show: true},
                                    saveAsImage: {show: true}
                                }
                            },
                            calculable: true,
                            xAxis: [
                                {
                                    type: 'category',
                                    boundaryGap: false,
                                    data: {!! json_encode($line['xAxis'])  !!}
                                }
                            ],
                            yAxis: [
                                {
                                    type: 'value',
                                    axisLabel: {
                                        formatter: '{value} '
                                    }
                                }
                            ],
                            series: [
                                {
                                    name: 'facebook',
                                    type: 'line',
                                    data: {!! json_encode($line['facebook']) !!},
                                    markPoint: {
                                        data: [
                                            {type: 'max', name: '最大值'},
                                            {type: 'min', name: '最小值'}
                                        ]
                                    },
                                    markLine: {
                                        data: [
                                            {type: 'average', name: '平均值'}
                                        ]
                                    }
                                },
                                {
                                    name: 'twitter',
                                    type: 'line',
                                    data: {!! json_encode($line['twitter']) !!},
                                    markPoint: {
                                        data: [
                                            {type: 'max', name: '最大值'},
                                            {type: 'min', name: '最小值'}
                                        ]
                                    },
                                    markLine: {
                                        data: [
                                            {type: 'average', name: '平均值'}
                                        ]
                                    }
                                }
                            ]
                        };


                        // 为echarts对象加载数据
                        myChart.setOption(option);
                    }
            );

            // 使用
            require(
                    [
                        'echarts',
                        'echarts/chart/pie' //饼图
                    ],
                    function (ec) {
                        // 基于准备好的dom，初始化echarts图表
                        var myChart = ec.init(document.getElementById('pie_div'), 'macarons');

                        option = {
                            title: {
                                text: '曲线图采集统计',
                                subtext: '',
                                x: 'center',
                            },
                            tooltip: {
                                trigger: 'item',
                                formatter: "{a} <br/>{b} : {c} ({d}%)"
                            },
                            legend: {
                                orient: 'vertical',
                                x: 'left',
                                data: ['facebook', 'twitter']
                            },
                            toolbox: {
                                show: true,
                                feature: {

                                    dataView: {show: true, readOnly: false},
                                    restore: {show: true},
                                    saveAsImage: {show: true}
                                }
                            },
                            calculable: true,
                            series: [
                                {
                                    name: '采集数量',
                                    type: 'pie',
                                    radius: '70%',
                                    center: ['50%', '60%'],
                                    data: [
                                        {value:{!! $pie['facebook'] !!}, name: 'facebook'},
                                        {value:{!! $pie['twitter'] !!}, name: 'twitter'}
                                    ]
                                }
                            ]
                        };


                        // 为echarts对象加载数据
                        myChart.setOption(option);
                    }
            );
        })
    </script>
@stop