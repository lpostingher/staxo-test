@extends('mail.base')

@section('content')
    <h4>Your order is done!</h4>
    <p>If you received this e-mail, your payment are fully processed. Thank you</p>

    <table>
        <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Amount</th>
            <th>Balance</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <img src="{{ Storage::disk('public')->url($product->image_path) }}" alt="48" width="48">
            </td>
            <td>{{ $product->name }}</td>
            <td>{{ $order->quantity }}</td>
            <td>${{ number_format($order->amount, 2) }}</td>
            <td>${{ number_format($order->balance, 2) }}</td>
        </tr>
        </tbody>
    </table>
@endsection
