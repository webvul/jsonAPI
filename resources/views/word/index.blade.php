@extends('app')


@section('title')采集词管理@stop

@section('content')
    <div class="templatemo-content-container">
        <div class="templatemo-flex-row flex-content-row">
            <div class="col-1">
                {!! Form::open(['url'=>'/word/add']) !!}
                <div class="panel panel-default margin-10">
                    <div class="panel-heading"><h2 class="text-uppercase">添加采集词</h2></div>
                    <div class="panel-body">
                        <form action="http://www.17sucai.com/preview/2/2015-05-19/admin/index.html" class="templatemo-login-form">
                            <div class="form-group">
                                <label for="inputEmail">采集词</label>
                                <textarea name="word" class="form-control" placeholder="可输入一个或多个,用换行隔开" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="templatemo-blue-button">确定</button>
                            </div>
                        </form>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div> <!-- Second row ends -->
        <div class="templatemo-content-widget no-padding">
            <div class="panel panel-default table-responsive">
                <table class="table table-striped table-bordered templatemo-user-table">
                    <thead>
                    <tr>
                        <td><a href="#" class="white-text templatemo-sort-by"># <span class="caret"></span></a></td>
                        <td><a href="#" class="white-text templatemo-sort-by">采集词 <span class="caret"></span></a>
                        </td>
                        <td><a href="#" class="white-text templatemo-sort-by">采集次数<span class="caret"></span></a>
                        </td>
                        <td><a href="#" class="white-text templatemo-sort-by">最后采集时间 <span class="caret"></span></a>
                        </td>
                        <td><a href="#" class="white-text templatemo-sort-by">创建时间 <span class="caret"></span></a></td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($word as $key => $val)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$val->name}}</td>
                        <td>{{$val->collection}}</td>
                        <td>{{$val->sendTime}}</td>
                        <td>{{$val->time}}</td>
                        <td><a href="#" class="templatemo-edit-btn">Delete</a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>


@stop