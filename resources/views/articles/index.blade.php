@extends('layouts.app')

@section('content')
  <article-list :cart="{{ auth()->user()->cart}}"></article-list>
@endsection