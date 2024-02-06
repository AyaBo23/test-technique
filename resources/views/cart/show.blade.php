@extends('layouts.app')

@section('content')
  <cart :articles="{{ auth()->user()->cart->articles()->withPivot('quantity')->get() }}"></cart>
@endsection