<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style>
        table{
            justify-content: center;
        }
        td{
            padding: 10px;
            
        }
        th{
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
  </div>

  <div class="container mt-5 mb-5">
    <div class="row">
        @if(session('status'))
        <div class="text-center">
            <p class="text-success">{{ session('status') }}</p>
        </div>
        @endif
        <center>
        <div class="col-md-12 mb-5">
            <table class="table-bordered table-striped">
                <thead>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Remove</th>
                </thead>
                <tbody>
                    <?php
                        $value = 0; 
                    ?>
                    @foreach ($cart as $item)
                    <tr>
                        <td>{{ $item->product->title }}</td>
                        <td>{{ $item->product->price }}</td>
                        <td><img src="{{ asset('/storage/'.$item->product->image) }}" alt="" width="80px" height="90px"></td>
                        <td><a href="{{ route('cart_delete',$item->id) }}" class="btn btn-danger">Remove</a></td>
                    </tr>
                    <?php 
                        $value = $value + $item->product->price;
                    ?>
                    @endforeach
                 
                    <tr>
                        <td>Total Value: </td>
                        <td>${{ $value }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </center>
        <div class="col-md-6">
            <div class="all_data">
                <form action="{{ route('cart_order') }}" method="post">
                    @csrf
                    <div>
                        <label for="name">Your Name</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}" id="" class="form-control">
                    </div>
                    <div class="mt-2">
                        <label for="name">Reciver Address</label>
                        <textarea name="address" col="30" row="40" class="form-control">{{ Auth::user()->address }}</textarea>
                    </div>
                    <div class="mt-2">
                        <label for="name">Phone Number</label>
                        <input type="number" name="phone" id="" class="form-control" value="{{ Auth::user()->phone }}">
                    </div>
                    <input type="submit" value="Cash On Delivery" class="btn btn-success mt-3">
                    <a href="{{ url('stripe',$value) }}" class="btn btn-success mt-3">Pay using Card</a>
                </form>
            </div>
        </div>
    
    </div>
  </div>






  <!-- end contact section -->

   

  <!-- info section -->

  @include('home.footer')

</body>

</html>