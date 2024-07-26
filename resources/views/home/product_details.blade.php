<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style>
      /*   .images{
            display: inline;
            justify-content: left;
            
        }
        .info{
            display: inline;
            justify-content: right;
        } */
         .info .title{
            color: green;
            font-size: 18px;
         }
         .info .des{
            
         }
        .info span{
            font: 18px;
            color: green;
            font-weight: 400;
         }
    </style>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
  </div>
  <!-- end hero area -->

  <!-- shop Details section -->

  
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-2"></div>
          <div class="col-sm-4">
            <div class="mb-5">
                <img src="{{ asset('/storage/'.$data->image) }}" width="200px" height="300px" alt="">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="info">
                <div class="title mb-2">
                    {{ $data->title }}
                </div>
                <div class="des mt-1 mb-3">
                    <span>Description: </span><br>
                    {{ $data->description }}
                </div>
                <div class="price mb-1">
                    <span>Price:</span> 
                    {{ $data->price }}
                </div>
                <div class="category mb-1">
                    <span>Category:</span>
                     {{ $data->category }}
                </div>
                <div class="quantity mb-1">
                    <span>Available quantity:</span>
                     {{ $data->quantity }}
                </div>
            </div>
          </div>
        </div>
    </div>
  


   
  <!-- info section -->

  @include('home.footer')

</body>

</html>