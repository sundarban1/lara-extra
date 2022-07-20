<html>
    products
    <ul>
    @foreach($products as $product)
    <li>Id-{{$product->id}}-Name - {{$product->name}} -- Price -{{$product->price}} -- Size - {{$product->size}}</li>
    @endforeach
    </ul>
</html>