<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

      <h4>Products table</h4>

      <table style="border: 1px solid grey; width: 100%">
        <th>#</th>
        <th>Name</th>
        <th>Product Category</th>
        <th>Description</th>
        <th>Price</th>
        <th>Visible</th>
        <th># Orders</th>
        <th>Actions</th>

        @foreach ($products as $product)
          <tbody >
            <td style="border: 1px solid grey">{{$product->id}}</td>
            <td style="border: 1px solid grey">{{ $product->title }}</td>
            <td style="border: 1px solid grey">{{ $product->product_category_id }}</td>
            <td style="border: 1px solid grey">{{ $product->description }}</td>
            <td style="border: 1px solid grey">{{ $product->price }}</td>
            <td style="border: 1px solid grey">
              @if ($product->visible)
                  <span style="color:green">Visible</span>
              @else
                <span style="color:red">Not Visible</span>
              @endif
            </td>
            <td style="border: 1px solid grey">{{ $product->orders()->count() }}</td>
          </tbody>

        @endforeach

      </table>

      <p>If you want to create a new product, <a href="{{ route('products.create') }}"> click here!</a> </p>
  </body>
</html>
