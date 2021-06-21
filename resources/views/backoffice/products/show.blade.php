<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title></title>
  </head>
  <body>
    <div class="card" style="width: 18rem;">
      <div class="card-body">

        <h5 class="card-title">Product:{{ $product->slug }}</h5>

        <h6>{{ $product->title }}</h6>
        <p class="card-text">{{ $product->description }}</p>
        <p>{{ $product->price }}</p>
        @if ($product->visible)
          <p style="color:green">Visible</p>
        @else
          <p style="color:red">Not Visible</p>
        @endif

        <a href="{{  route('products.edit', ['product' => $product->slug]) }}" class="btn btn-dark">Modify</a>

        <div class="">
          <form class="" action="{{ route('products.destroy', ['product' => $product->slug]) }}" method="post">
            @csrf
            @method('DELETE')
            
            <button class="btn btn-danger" href="" type="submit">Delete</a>
          </form>
        </div>
      </div>

      <a href="{{  route('products.index') }}" class="btn btn-primary" >Go back to the products list</a>
    </div>
  </body>
</html>
