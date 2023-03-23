<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: "Segoe UI", serif;
        }

        /* Center tables for demo */
        table {
            margin: 0 auto;
        }

        /* Default Table Style */
        table {
            color: #333;
            background: white;
            border: 1px solid grey;
            font-size: 12pt;
            border-collapse: collapse;
        }

        table thead th,
        table tfoot th {
            color: #777;
            background: rgba(0, 0, 0, .1);
        }

        table caption {
            padding: .5em;
        }

        table th,
        table td {
            padding: .5em;
            border: 1px solid lightgrey;
        }

        /* Zebra Table Style */
        [data-table-theme*=zebra] tbody tr:nth-of-type(odd) {
            background: rgba(0, 0, 0, .05);
        }

        [data-table-theme*=zebra][data-table-theme*=dark] tbody tr:nth-of-type(odd) {
            background: rgba(255, 255, 255, .05);
        }

        /* Dark Style */
        [data-table-theme*=dark] {
            color: #ddd;
            background: #333;
            font-size: 12pt;
            border-collapse: collapse;
        }

        [data-table-theme*=dark] thead th,
        [data-table-theme*=dark] tfoot th {
            color: #aaa;
            background: rgba(0255, 255, 255, .15);
        }

        [data-table-theme*=dark] caption {
            padding: .5em;
        }

        [data-table-theme*=dark] th,
        [data-table-theme*=dark] td {
            padding: .5em;
            border: 1px solid grey;
        }
    </style>
</head>
<body>
<h4>Thank you for your order!</h4>
<p>If you received this e-mail your payment was processed successfully.</p>

<table>
    <thead>
    <tr>
        <th></th>
        <th>Name</th>
        <th>Quantity</th>
        <th>Amount</th>
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
    </tr>
    </tbody>
</table>
</body>
</html>
