@extends('layouts.guest-app')
@section('content')
<thing-todo :_kes="{{$kes}}" :_plan="{{$plan}}" :_cat="{{$cat}}"></thing-todo>
@endsection