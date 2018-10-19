@extends('admin.index')

@section('title', '| Home Admin')

@section('stylesheets')

 <style>
 .admin-body {
  margin-left: 196px;

margin-top: 37px;
 }
.panel-body .btn:not(.btn-block) { width:120px;margin-bottom:10px; }
</style>

@endsection

@section('main')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-offset-2 admin-body">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-bookmark"></span> Website Manager</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                          <a href="{{ route('admin.index') }}" class="btn btn-danger btn-lg" role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/>News</a>
                          <a href="{{ route('storages.posts.index') }}" class="btn btn-warning btn-lg" role="button"><span class="glyphicon glyphicon-bookmark"></span> <br/>Storages</a>
                          <a href="{{ route('posts.index') }}" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-signal"></span> <br/>Posts</a>
                          <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-comment"></span> <br/>Comments</a>
                        </div>
                        <div class="col-xs-6 col-md-6">
                          <a href="{{ route('users.index') }}" class="btn btn-success btn-lg" role="button"><span class="glyphicon glyphicon-user"></span> <br/>Users</a>
                          <a href="{{ route('categories.index') }}" class="btn btn-info btn-lg" role="button"><span class="glyphicon glyphicon-file"></span> <br/>Categories</a>
                          <a href="{{ route('roles.index') }}" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-picture"></span> <br/>Authorization</a>
                          <a href="{{ route('tags.index') }}" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-tag"></span> <br/>Tags</a>
                        </div>
                    </div>
                    <a href="{{ route('pages.index') }}" class="btn btn-success btn-lg btn-block" role="button"><span class="glyphicon glyphicon-globe"></span> News Website</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection