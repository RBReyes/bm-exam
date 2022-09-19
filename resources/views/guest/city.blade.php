@extends('layouts.guest-app')
@section('content')
<guest-city :_kes="{{$kes}}" :_plan="{{$plan}}" :_cat="{{$cat}}"></guest-city>
@endsection