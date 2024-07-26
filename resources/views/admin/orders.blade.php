<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style>
        .all_info{
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;

        }
        table th, td{
            padding: 15px;
            color: white;
        }
    </style>
  </head>
  <body>
    @include('admin.header')

    @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
          <div class="order">
            <div class="heading">
                <h2 class="text-light text-center">All Orders</h2>
            </div>
            <div class="all_info">
                <table class="table-bordered table-striped">
                    <thead>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Product Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Change Status</th>
                        <th>Pdf</th>
                    </thead>
                    <tbody>
                        @foreach ($orders_info as $order)
                        <tr>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->rec_add }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->product->title }}</td>
                            <td>{{ $order->product->price }}</td>
                            <td><img src="{{ asset('/storage/'.$order->product->image) }}" alt="" width="80px" height="90px"></td>
                            <td>
                              @if($order->status == 'in progress')
                                <span style="color:red">{{ $order->status }}</span>
                              @elseif($order->status == 'On the Way')
                                <span class="text-warning">{{ $order->status }}</span>
                              @else
                              <span class="text-success">{{ $order->status }}</span>
                              @endif
                            </td>
                            <td>
                              <a href="{{ route('on_the_way',$order->id) }}" class="btn btn-primary btn-sm">On the way</a>
                              <a href="{{ route('delivered',$order->id) }}" class="btn btn-success btn-sm mt-2">Delivered</a>
                            </td>
                            <td>
                              <a href="{{ route('print_pdf',$order->id) }}" class="btn btn-secondary btn-sm">Pdf</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>
          </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{ asset('/admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/popper.js/umd/popper.min.js') }}"> </script>
    <script src="{{ asset('/admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ asset('/admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('/admincss/js/front.js') }}"></script>
  </body>
</html>