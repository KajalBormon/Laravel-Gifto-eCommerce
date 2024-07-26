<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style>
      .pagination{
        display: flex;
        margin: auto;
        justify-content: center;
        margin-top: 30px;
      }
      th{
        color: burlywood;
        text-align: center;
        font-size: 18px;
      }
      td{
        color: white;
      }
      input[type='search']{
        width: 400px;
        display: inline;
      }
      form{
        width: 350px;
        position: absolute;
        right: 30px;
        top: 40px;
        
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
          
            <div class="all_product">
                <h2 class="text-center text-light mb-5">All Products</h2>
                <form action="{{ route('search') }}" method="get">
                  @csrf
                  <div class="input-group">
                    <input type="search" class="form-control" name="search" id="" placeholder="Serach...">
                    <div class="input-group-append">
                      <input type="submit" value="Search" class="btn btn-light">
                    </div>
                  </div>
                </form>
                @if(session('status'))
                <div style="color: green; text-align:center" class="mb-3">
                    {{ session('status') }}
                </div>
                @endif
                <div class="mt-5">
                  <table class="table-bordered table-striped">
                    <thead>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)   
                        <tr>
                            <td class="p-2">{{ $product->title }}</td>
                            <td class="p-2">{!!Str::limit($product->description,50, '...') !!}</td>
                            <td class="p-2">{{ $product->category }}</td>
                            <td class="p-2">{{ $product->price }}</td>
                            <td class="p-2">{{ $product->quantity }}</td>
                            <td class="p-2"><img src="{{ asset('/storage/'.$product->image) }}" height="90px" width="100px" alt=""></td>
                            <td>
                              <a href="{{ route('edit_product',$product->id) }}" class="btn btn-warning">Edit</a>
                            </td>
                            <td>
                              <a href="{{ route('delete_product',$product->id) }}" onclick="confirmation(event)" class="btn btn-danger" >Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                
            </div>
            <div class="pagination">
              {{ $products->onEachSide(1)->links() }}
            </div>
          </div>
      </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
    
  </body>
</html>