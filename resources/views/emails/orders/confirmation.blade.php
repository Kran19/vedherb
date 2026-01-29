<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 600px;
            mx-auto;
            background: #fff;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 20px;
        }

        .order-info {
            margin: 20px 0;
            padding: 15px;
            background: #f8fafc;
            border-radius: 6px;
        }

        .item-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .item-table th,
        .item-table td {
            padding: 12px;
            border-bottom: 1px solid #f0f0f0;
            text-align: left;
        }

        .item-table th {
            background: #f8fafc;
            font-size: 12px;
            text-transform: uppercase;
            color: #64748b;
        }

        .total-section {
            margin-top: 20px;
            border-top: 2px solid #f0f0f0;
            padding-top: 20px;
            text-align: right;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
            margin-top: 40px;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-success {
            background: #dcfce7;
            color: #166534;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1 style="color: #064e3b; margin-bottom: 5px;">Thank you for your order!</h1>
            <p style="color: #64748b; margin-top: 0;">We've received your order and we're getting it ready.</p>
        </div>

        <div class="order-info">
            <table style="width: 100%;">
                <tr>
                    <td><strong>Order Number:</strong></td>
                    <td style="text-align: right;">{{ $order->order_number }}</td>
                </tr>
                <tr>
                    <td><strong>Order Date:</strong></td>
                    <td style="text-align: right;">{{ $order->created_at->format('M d, Y') }}</td>
                </tr>
                <tr>
                    <td><strong>Payment Method:</strong></td>
                    <td style="text-align: right; text-transform: uppercase;">
                        {{ str_replace('_', ' ', $order->payment_method) }}</td>
                </tr>
            </table>
        </div>

        <h3>Order Summary</h3>
        <table class="item-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th style="text-align: right;">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>
                            <strong>{{ $item->product_name }}</strong><br>
                            <small style="color: #64748b;">SKU: {{ $item->sku }}</small>
                        </td>
                        <td>{{ $item->quantity }}</td>
                        <td style="text-align: right;">₹{{ number_format($item->unit_price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-section">
            <p>Subtotal: <strong>₹{{ number_format($order->subtotal, 2) }}</strong></p>
            @if($order->shipping_total > 0)
                <p>Shipping: <strong>₹{{ number_format($order->shipping_total, 2) }}</strong></p>
            @endif
            @if($order->tax_total > 0)
                <p>Tax: <strong>₹{{ number_format($order->tax_total, 2) }}</strong></p>
            @endif
            @if($order->discount_total > 0)
                <p>Discount: <strong style="color: #dc2626;">-₹{{ number_format($order->discount_total, 2) }}</strong></p>
            @endif
            <h2 style="color: #064e3b; margin-top: 10px;">Total: ₹{{ number_format($order->grand_total, 2) }}</h2>
        </div>

        <div style="margin-top: 30px;">
            <h3>Shipping Address</h3>
            <p style="color: #4b5563; font-size: 14px;">
                {{ $order->shipping_address['name'] }}<br>
                {{ $order->shipping_address['address'] }}<br>
                {{ $order->shipping_address['city'] }}, {{ $order->shipping_address['state'] }} -
                {{ $order->shipping_address['pincode'] }}<br>
                Phone: {{ $order->shipping_address['phone'] }}
            </p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>If you have any questions, reply to this email or contact support at support@drkinjal.in</p>
        </div>
    </div>
</body>

</html>