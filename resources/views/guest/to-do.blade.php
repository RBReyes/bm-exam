@extends('layouts.guest-app')
@section('content')
<guest-todo :_kes="{{$kes}}" :_plan="{{$plan}}" :_cat="{{$cat}}"></guest-todo>
@endsection