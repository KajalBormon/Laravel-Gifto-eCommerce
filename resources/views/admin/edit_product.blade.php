<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
  </head>
  <body>
    @include('admin.header')

    @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
          
            {{-- Add Product Option --}}
            <div class="div_deg">
                <h2 class="text-center text-light">Update Products</h2>
                @if(session('status'))
                <div class="text-center">
                    <p class="text-success">{{ session('status') }}</p>
                </div>
                @endif
                <form action="{{ route('update_product',$edit_product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="" value="{{ $edit_product->title }}">
                    </div>

                    <div>
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="" cols="60" rows="5">{{ $edit_product->description }}"</textarea>
                    </div>

                    <div>
                        <label for="price">Price</label>
                        <input type="text" name="price" value="{{ $edit_product->price }}" class="form-control" id="">
                    </div>

                    <div>
                        <label for="category">Category</label>
                        <select name="category" id="" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($category as $item)           
                            <option value="{{ $item->category_name }}">{{ $item->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="qty">Quantity</label>
                        <input type="text" name="qty" value="{{ $edit_product->quantity }}" class="form-control" id="">
                    </div>
                    <div>
                        <label for="image">Image</label>
                        <img src="{{ asset('/storage/'.$edit_product->image) }}" height="100px" width="80px" alt="" id="output">
                    </div>

                    <div>
                        <input type="file" name="image" onchange="document.querySelector('#output').src=window.URL.createObjectURL(this.files[0])" class="form-control" id="">
                    </div>

                    <div>
                        <input type="submit" class="btn btn-primary mt-2" value="Update Product" id="">
                    </div>
                </form>
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