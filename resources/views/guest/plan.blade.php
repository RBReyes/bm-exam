@extends('layouts.guest-app')
@section('content')
<guest-plan :_kes="{{$kes}}" :_plan="{{$plan}}"></guest-plan>
@endsection