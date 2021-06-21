<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title></title>
  </head>
  <body style="max-width: 1000px; margin: auto">

    {{-- <pre>{{ json_encode($productCategories, JSON_PRETTY_PRINT) }}</pre> --}}
    <h3>Modify Product</h3>

    <form method="POST" action="{{ route('products.update', ['product' => $product->slug]) }}">
      @csrf
      @method('PATCH')

      <div class="mb-3">
        <label for="title" class="form-label">Name</label>
        <input name="title" type="string" class="form-control" id="exampleInputEmail1" value="{{ old('title',$product->title) }}">

        @error ('title')
          <p style=" font-size:15px; color:red">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" type="text" class="form-control" id="exampleInputPassword1">{{ old('description',$product->description) }}</textarea>

        @error ('description')
          <p style="font-size:15px; color:red">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-5 " style="Display:inline">
        <label class="form-check-label" for="productCategory">Product Category</label>
        <select id="product-category" class="" name="productCategory">
          @foreach ($productCategories as $productCategory)
            <option value="{{ $productCategory->slug }}"{{ old('productCategory') == $productCategory->id  ? 'selected' : ''}} >{{ $productCategory->title }}</option>
          @endforeach
            <option value="">No choice</option>
        </select>

        @error ('productCategory')
          <p style=" font-size:15px;color:red">{{ $message }}</p>
        @enderror
      </div>


      <div class="mb-3 mt-3">
        <label class="form-label" for="price">Price</label>
        <input name="price" type="number" step="0.01" min="0" id="price" value="{{ old('price', $product->getPureFloatPrice()) }}">

        @error ('price')
          <p style=" font-size:15px; color:red">{{ $message }}</p>
        @enderror
      </div>


      {{-- <div class="mb-3 form-check">
        <input name="visibility" type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="bisibility">Visible</label>

        @error ('visibility')
          <p style="font-size:15px; color:red">{{ $message }}</p>
        @enderror
      </div> --}}

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>

      <a class="btn btn-danger" href="{{ route('products.index') }}" name="button">Go back to Products List</a>
  </body>
</html>
