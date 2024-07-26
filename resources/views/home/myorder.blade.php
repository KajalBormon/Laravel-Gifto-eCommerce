<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style>
        table th,td{
            padding: 15px;;
        }
    </style>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end slider section -->
  </div>
  <center>
  <div class="myorder mt-5 mb-5">
    <table class="table-bordered table-striped">
        <thead>
            <th>Product Name</th>
            <th>Price</th>
            <th>Delivery Status</th>
            <th>Image</th>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->product->title }}</td>
                <td>{{ $order->product->price }}</td>
                <td>{{ $order->status }}</td>
                <td>
                    <img src="{{ asset('/storage/'.$order->product->image) }}" width="80px" height="90px" alt="">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</center>


@include('home.footer')

</body>
</html>