@extends('layouts.airapp')
@section('title', 'エア消費量計算サイト')

@section('content')
@if (count($errors) > 0)
@foreach ($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
@endif
    <form action="/calculate" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="form-group col-sm"> <h2 class="text-secondary">1. 入力</h2> <label for="tank_capacity">タンク容量 (L)</label> <select name="tank_capacity" class="form-control" id="tank_capacity" required> <option value="">選択してください</option> <option value="8" @if (isset($data)) @if ($data['tank_capacity'] == 8) selected @endif @endif>8 L</option>
                    <option value="10" @if (isset($data)) @if ($data['tank_capacity'] == 10) selected @endif @endif>10 L</option>
                    <option value="12" @if (isset($data)) @if ($data['tank_capacity'] == 12) selected @endif @endif>12 L</option>
                    <option value="14" @if (isset($data)) @if ($data['tank_capacity'] == 14) selected @endif @endif>14 L</option>
                </select>
                <small id="tank_capacity__help" class="form-text text-muted">日本では一般的に10Lのタンクが利用されています。</small>
            </div>
        </div>
        
        <div class="row">
            <div class="form-group col-sm">
                <label for="entry_pressure">エントリー残圧 (bar)</label>
                <select name="entry_pressure" class="form-control" id="entry_pressure" required>
                    <option value="">選択してください</option>
                    @for ($i = 150; $i < 250; $i+=10)
                    <option value="{{$i}}" @if (isset($data)) @if ($data['entry_pressure'] == $i) selected @endif @endif>{{$i}}</option>
                    @endfor
                </select>            
            </div>                            
            <div class="form-group col-sm">
                <label for="exit_pressure">エキジット残圧 (bar)</label>
                <select name="exit_pressure" class="form-control" id="exit_pressure" required>
                    <option value="">選択してください</option>
                    @for ($i = 0; $i < 150; $i+=10)
                    <option value="{{$i}}" @if (isset($data)) @if ($data['exit_pressure'] == $i) selected @endif @endif>{{$i}}</option>
                    @endfor
                </select>
            </div>
        </div>
        
        <div class="row">
            <div class="form-group col-sm">
                <label for="average_depth">平均水深 (m)</label>
                <input name="average_depth" type="number" step="0.1" @if (isset($data)) value="{{$data['average_depth']}}" @else value="10.0" @endif max="40" min="0.1" required>
                <small id="averageDepth_help" class="form-text text-muted">ダイブコンピューターから確認ください。</small>
            </div>                            
            <div class="form-group col-sm">
                <label for="dive_time">潜水時間 (min)</label>
                <input name="dive_time" type="number" @if (isset($data)) value="{{$data['dive_time']}}" @else value="35" @endif max="120" min="1" required>
            </div>
        </div>
        <div class="row">
                <div class="form-group col-sm">
                    <label for="gender">性別</label>
                    <select name="gender" class="form-control" id="gender">
                        <option value="">選択する</option>
                        <option value="0" @if (isset($data['gender'])) @if ($data['gender'] == 0) selected @endif @endif>男性</option>
                        <option value="1" @if (isset($data['gender'])) @if ($data['gender'] == 1) selected @endif @endif>女性</option>
                    </select>
                    <small id="gender_help" class="form-text text-muted">入力すると男女別の平均データと比較した考察が得られます。</small>
                </div>
                <div class="form-group col-sm">
                    <label for="age">年齢</label>
                    <select name="age" class="form-control" id="age">
                        <option value="">選択する</option>
                        @for ($i = 10; $i <= 90; $i+=10)
                            <option value="{{$i}}" @if (isset($data['age'])) @if ($data['age'] == $i) selected @endif @endif>{{$i}}代</option>
                        @endfor
                    </select>
                    <small id="tank_capacity_help" class="form-text text-muted">今後の参考にしたいので入力いただけると助かります。</small>
                </div>
            </div>
            
        <div class="row">
            <div class="form-group col">
                    <button type="submit" value="send" class="btn btn-primary btn-block">{{$action}}</button>
            </div>
        </div>
    </form>

    @if (isset($data['minute_air']))
        <div class="row">
            <div class="col-sm">
                <h2 class="text-secondary">2. 結果</h2>
                <p class="text-primary">あなたの1分間あたりのエア消費量は<span class="font-weight-bold"> {{$data['minute_air']}} L/min</span>です。</p>
                @if (isset($data['gender']))
                <h2 class="text-secondary">3. 考察</h2>
                <p class="text-info">{{$msg}}</p>
                @endif
                <h2 class="text-secondary">4. みんなのデータ</h2>
                <p><a href="/show">みんなのデータを見る</a></p>
            </div>
        </div>
    @endif
                   
        

@endsection
