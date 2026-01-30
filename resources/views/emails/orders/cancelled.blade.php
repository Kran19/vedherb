<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Cancelled</title>
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
            margin: 20px auto;
            background: #fff;
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
            background: #fff5f5;
            border-radius: 6px;
            border: 1px solid #fee2e2;
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

        .footer {
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1 style="color: #991b1b; margin-bottom: 5px;">Order Cancelled</h1>
            <p style="color: #64748b; margin-top: 0;">As per your request, your order has been cancelled.</p>
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
                    <td><strong>Status:</strong></td>
                    <td style="text-align: right; color: #991b1b; font-weight: bold;">CANCELLED</td>
                </tr>
                @if($order->cancellation_reason)
                    <tr>
                        <td><strong>Reason:</strong></td>
                        <td style="text-align: right;">{{ $order->cancellation_reason }}</td>
                    </tr>
                @endif
            </table>
        </div>

        <h3>Cancelled Items</h3>
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

        @if($order->payment_method === 'online' && ($order->payment_status === 'paid' || $order->payment_status === 'authorized'))
            <div
                style="margin-top: 20px; padding: 15px; background: #ecfdf5; border: 1px solid #d1fae5; border-radius: 6px;">
                <strong style="color: #064e3b;">Refund Information:</strong>
                <p style="margin: 5px 0 0; color: #065f46; font-size: 14px;">
                    Since your order was paid online, a refund for
                    <strong>₹{{ number_format($order->grand_total, 2) }}</strong> will be initiated shortly. It typically
                    takes 5-7 working days to reflect in your original payment method.
                </p>
            </div>
        @endif

        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>If you have any questions or did not request this cancellation, please contact support immediately at
                support@drkinjal.in</p>
        </div>
    </div>
</body>

</html>