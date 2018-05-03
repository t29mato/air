@extends('layouts.airapp')
@section('title', 'エア消費量計算サイト')

@section('content')
<div class="row">
    <div class="col-sm">
        <hr>
        <h2>このサイトって？</h2>
        <p>
        このサイトはダイバーのためのエア消費量計算サービスです。<br>
        ダイビング時に利用したタンク容量、エントリー残圧、エキジット残圧、平均水深、潜水時間を入力することで、自動的に1分あたりのエア消費量を算出してくれます。
        </p>
        <a href="/calculate" class="btn btn-primary btn-block">早速、計算する</a>
        <hr>
        <h2>新着 みんなのエア消費量</h2>
        <div class="table-responsive">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th scoep="col">登録日時</th>
                        <th scoep="col">性別</th>
                        <th scoep="col">年代</th>
                        <th scoep="col">エア消費量</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{$item->created_at}}</td>
                            <td>@if ($item->gender === 0) 男性 @elseif ($item->gender === 1) 女性 @else 不明 @endif</td>
                            <td> {{$item->age}}代</td>
                            <td>{{$item->minute_air}} (L/min)</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
