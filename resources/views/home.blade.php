@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            {{--{{ trans('messages.dashboard.title') }}--}}
            '대시보드'
          </div>

          <div class="panel-body">
            {{--{{ trans('messages.dashboard.message') }}--}}
            '로그인 되었습니다!'
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
