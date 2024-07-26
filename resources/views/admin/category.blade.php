<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style>
        input[type='text']{
            width: 400px;
            display: inline;
        }
        .div_deg{
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 30px;
        }
        .category_show{
          text-align: center;
          margin: auto;
          margin-top: 50px;
        }
        th{
          background-color: rgb(221, 209, 209);
          color: black;
          padding: 10px;
          
        }
        td{
          padding: 10px;
          color: white;
          border: 1px solid skyblue;
          
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
            <h2 style="color: white;" class="text-center">Add Category Items</h2>
            
                @if(session('status'))
                <div style="color: green; text-align:center">
                    {{ session('status') }}
                </div>
                @endif
            
            <div class="div_deg">
                <form action="{{ route('add_category') }}" method="post">
                    @csrf
                    <div>
                        <input type="text" class="form-control" name="category" id="">
                        <input type="submit" class="btn btn-primary ml-2" value="Add Category">
                    </div>
                </form>
            </div>

            <div>
              <table class="table-bordered table-striped category_show">
                <thead>
                  <th>Category Name</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </thead>
                <tbody>
                  @foreach ($category as $item) 
                  <tr>
                    <td>{{ $item->category_name }}</td>
                    <td>
                      <a href="{{ route('edit_category',$item->id) }}" class="btn btn-success">Edit</a>
                    </td>
                    <td>
                      <a href="{{ route('delete_category',$item->id) }}" onclick="confirmation(event)" class="btn btn-danger">Delete</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>


          </div>
      </div>
    </div>
    <!-- JavaScript files-->

    @include('admin.js')

</body>
</html>