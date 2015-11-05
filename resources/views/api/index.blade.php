@extends('app')


@section('title')列表页面@stop

@section('content')
    <div class="templatemo-content-container">
        <div class="templatemo-content-widget no-padding">
            <div class="panel panel-default table-responsive">
                <table class="table table-striped table-bordered templatemo-user-table">
                    <thead>
                    <tr>
                        <td><a href="#" class="white-text templatemo-sort-by"># <span class="caret"></span></a></td>
                        <td><a href="#" class="white-text templatemo-sort-by">接口名称 <span class="caret"></span></a>
                        </td>
                        <td><a href="#" class="white-text templatemo-sort-by">入口地址<span class="caret"></span></a>
                        </td>
                        <td><a href="#" class="white-text templatemo-sort-by">进程数<span class="caret"></span></a>
                        </td>
                        <td><a href="#" class="white-text templatemo-sort-by">队列数<span class="caret"></span></a>
                        </td>
                        <td>Edit</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($api as $key => $val)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$val->name}}</td>
                        <td>{{$val->url}}</td>
                        <td>{{$val->reserved}}</td>
                        <td>{{$val->jobs}}</td>
                        <td><a href="#" class="templatemo-edit-btn">Edit</a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>

@stop