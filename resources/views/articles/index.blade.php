@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      @foreach ($articles as $article)
      <div class="col-sm-6 col-md-4">
          <form action="{{ route('cart.update', auth()->user()->cart )}}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="article" value={{ $article->id }}>
            
            <div class="article border p-4 my-2">
              <div class="article-image">( Image de l'article)</div>
              <h2>{{ $article->label}}</h2>
              <p class="fw-bold">{{ $article->price}} €</p>

              <select name="quantity" class="form-control my-2">
                @for ($i = 1; $i < $article->stock_quantity; $i++)
                  <option value="{{ $i}}"> {{ $i }}</option>
                @endfor
              </select>

              <div class="buttons">
                <button class="btn btn-primary" type="submit">Ajouter au panier</button>
              </div>
            </div>
        </div>
      </form>
      @endforeach
    </div>
</div>
@endsection