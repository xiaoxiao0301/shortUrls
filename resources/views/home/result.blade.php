@extends('layout.master')
@section('content')
    <h1>短链生成器</h1>
    <div class="col-lg-8">
        <form  action="{{url('generate')}}" method="post">
            {{csrf_field()}}
            <div class="input-group">
                <input type="text" class="form-control input-lg" placeholder="请输入URL链接" name="url">
                <span class="input-group-btn">
		        <button class="btn btn-success btn-lg" type="submit">生成</button>
		      </span>
            </div>
        </form>
        @if(count($errors)>0)
        <br><br>
            <div class="mark">
                @if(is_object($errors))
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                @else
                    <p>{{$errors}}</p>
                @endif
            </div>
        @endif
        <br><br>
        <h2>您的短链:<a href="{{url($shortened)}}" target="_blank">{{url($shortened)}}</a></h2>
    </div>
@endsection



