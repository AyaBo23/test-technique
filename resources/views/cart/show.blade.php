@extends('layouts.app')

@section('content')
  <cart :articles="{{ auth()->user()->cart->articles()->withPivot('quantity')->get()}}">
        <h6 class="h2">Prix total:  {{ $totalPrice }}€</h6>
  </cart>
@endsection