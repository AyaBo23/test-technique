@extends('layouts.app')

@section('content')
<!--:articles="{{ auth()->user()->cart->articles()->withPivot('quantity')->get()}}"  -->
  <cart :total="{{ $totalPrice }}">

    <form action="{{ route('commandes.store')}}" method="post">
      @csrf
      <input type="hidden" name="price" value="{{ $totalPrice }}">
      
      <button class="btn btn-primary btn-lg" type="submit">
        Commander Maintenant
      </button>
    </form>
  </cart>
@endsection