@extends('layouts.airapp')
@section('title', 'エア消費量計算サイト')

@section('content')
<div class="row">
    <div class="col-sm">
        <hr>        
        <h2 class="text-secondary">みんなのデータ</h2>
        <p>現在、{{$data['sum_record']}}回分のデータが溜まっています。</p>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <h3>エア消費量</h3>
        
        <div class="table-responsive">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">男性</th>
                        <th scope="col">女性</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>最大</th>
                        <td>{{$data['max_man_minute_air']}} L/min</td>
                        <td>{{$data['max_woman_minute_air']}} L/min</td>
                    </tr>
                    <tr>
                        <th>平均</th>
                        <td>{{$data['avg_man_minute_air']}} L/min</td>
                        <td>{{$data['avg_woman_minute_air']}} L/min</td>
                    </tr>
                    <tr>
                        <th>最小</th>
                        <td>{{$data['min_man_minute_air']}} L/min</td>
                        <td>{{$data['min_woman_minute_air']}} L/min</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-sm-9">    
        <h3>エア消費量 (性別/年代別)</h3>
        <canvas id="minute_air"></canvas>
        <script>
            var ctx = document.getElementById("minute_air").getContext('2d');

            var original = Chart.defaults.global.legend.onClick;
            Chart.defaults.global.legend.onClick = function(e, legendItem) {
            update_caption(legendItem);
            original.call(this, e, legendItem);
            };

            var minute_air = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["10代", "20代", "30代", "40代", "50代", "60代", "70代", "80代", "90代"],
                datasets: [{
                label: '男性',
                backgroundColor: "#4169e1",
                data: [
                    @foreach ($data['age_avg_man_minute_air'] as $man)
                        {{$man}},
                    @endforeach
                    ],
                }, {
                label: '女性',
                backgroundColor: "#ff1493",
                data: [
                    @foreach ($data['age_avg_woman_minute_air'] as $woman)
                        {{$woman}},
                    @endforeach
                    ],
                }]
            }
            });

            var labels = {
            "apples": true,
            "oranges": true
            };

            var caption = document.getElementById("caption");

            var update_caption = function(legend) {
            labels[legend.text] = legend.hidden;

            var selected = Object.keys(labels).filter(function(key) {
                return labels[key];
            });

            var text = selected.length ? selected.join(" & ") : "nothing";

            caption.innerHTML = "The chart is displaying " + text;
            };
        </script>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-3">
        <h3>潜水時間</h3>
        <div class="table-responsive">
            <table class="table table-sm table-bordered">
                <tbody>
                    <tr>
                        <th scope="col">最小</th>
                        <td>{{$data['min_dive_time']}}分</td>
                    </tr>
                    <tr>
                        <th scope="col">平均</th>
                        <td>{{$data['avg_dive_time']}}分</td>
                    </tr>
                    <tr>
                        <th scope="col">最大</th>
                        <td>{{$data['max_dive_time']}}分</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-sm-3">
            <h3>平均水深</h3>
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <tbody>
                        <tr>
                            <th scope="col">最小</th>
                            <td>{{$data['min_average_depth']}}m</td>
                        </tr>
                        <tr>
                            <th scope="col">平均</th>
                            <td>{{$data['avg_average_depth']}}m</td>
                        </tr>
                        <tr>
                            <th scope="col">最大</th>
                            <td>{{$data['max_average_depth']}}m</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    
    <div class="col-sm-6">
        <h3>タンク容量別の回数</h3>
        <canvas id="tank_capacity"></canvas>
        <script>
            var ctx = document.getElementById("tank_capacity").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ["8L", "10L", "12L", "14L"],
                    datasets: [{
                        backgroundColor: [
                        "#448EF6",
                        "#75C2F6",
                        "#65DAF7",
                        "#FFE981",
                        ],
                        data: [
                            {{ $data['count_tank_capacity']['8'] }},
                            {{ $data['count_tank_capacity']['10'] }},
                            {{ $data['count_tank_capacity']['12'] }}, 
                            {{ $data['count_tank_capacity']['14'] }},
                        ],
                    }]
                }
            });
        </script>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-sm-6">
        <h3>エントリー残圧別の回数</h3>
        <canvas id="entry_pressure"></canvas>
        <script>        
            var ctx = document.getElementById("entry_pressure").getContext('2d');

            var original = Chart.defaults.global.legend.onClick;
            Chart.defaults.global.legend.onClick = function(e, legendItem) {
            update_caption(legendItem);
            original.call(this, e, legendItem);
            };

            var entry_pressure = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["150L", "160L", "170L", "180L", "190L", "200L", "210L", "220L", "230L", "240L"],
                datasets: [{
                label: 'エントリー残圧',
                backgroundColor: "#009688",
                data: [
                    @foreach ($data['count_entry_pressure'] as $pressure)
                        {{$pressure}},
                    @endforeach
                    ],
                }],
            }
            });

            var labels = {
            "apples": true,
            "oranges": true
            };

            var caption = document.getElementById("caption");

            var update_caption = function(legend) {
            labels[legend.text] = legend.hidden;

            var selected = Object.keys(labels).filter(function(key) {
                return labels[key];
            });

            var text = selected.length ? selected.join(" & ") : "nothing";

            caption.innerHTML = "The chart is displaying " + text;
            };
        </script>
    </div>
    <div class="col-sm-6">
        <h3>エキジット残圧別の回数</h3>
        <canvas id="exit_pressure"></canvas>
        <script>        
            var ctx = document.getElementById("exit_pressure").getContext('2d');

            var original = Chart.defaults.global.legend.onClick;
            Chart.defaults.global.legend.onClick = function(e, legendItem) {
            update_caption(legendItem);
            original.call(this, e, legendItem);
            };

            var exit_pressure = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["0L", "10L", "20L", "30L", "40L", "50L", "60L", "70L", "80L", "90L", "100L", "110L", "120L", "130L", "140L"],
                datasets: [{
                label: 'エキジット残圧',
                backgroundColor: "#009688",
                data: [
                    @foreach ($data['count_exit_pressure'] as $pressure)
                        {{$pressure}},
                    @endforeach
                    ],
                }],
            }
            });

            var labels = {
            "apples": true,
            "oranges": true
            };

            var caption = document.getElementById("caption");

            var update_caption = function(legend) {
            labels[legend.text] = legend.hidden;

            var selected = Object.keys(labels).filter(function(key) {
                return labels[key];
            });

            var text = selected.length ? selected.join(" & ") : "nothing";

            caption.innerHTML = "The chart is displaying " + text;
            };
        </script>
    </div>
</div>
@endsection
