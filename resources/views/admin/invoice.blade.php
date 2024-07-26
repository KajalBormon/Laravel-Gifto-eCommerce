<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
   
</head>
<body>
    <center>
       
        <div class="invoice">
            <table>
                <tr>
                    <td>Customer name: {{ $data->name }}</td>
                </tr>
                <tr>
                    <td>Receiver Address: {{ $data->rec_add }}</td>
                </tr>
                <tr>
                    <td>Phone: {{ $data->phone }}</td>
                </tr>
                <tr>
                    <td>Product Title: {{ $data->product->title }}</td>
                </tr>
                <tr>
                    <td>Product Price: {{ $data->product->price }}</td>
                </tr>
                <tr>
                    <td>
                        Product Image: <img src="products/{{ $data->product->image }}" alt="" >
                    </td>
                </tr>
            </table>
        </div>
        
    </center>
</body>
</html>