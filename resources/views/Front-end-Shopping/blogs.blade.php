<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .cart-section {
            display: flex;
            flex-wrap: wrap;
        }

        .cart-table {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            flex: 1;
        }

        .table thead th {
            font-size: 16px;
            color: #333;
            text-transform: uppercase;
            border-bottom: none;
            padding-bottom: 15px;
        }

        .table tbody td {
            padding: 20px 15px;
            vertical-align: middle;
        }

        .table tbody td img {
            width: 80px;
            height: auto;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-control input {
            text-align: center;
            width: 50px;
            border: none;
            font-size: 16px;
        }

        .quantity-control button {
            background-color: #ddd;
            border: none;
            padding: 10px;
            font-size: 18px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-control button:hover {
            background-color: #bbb;
        }

        .cart-summary {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            margin-left: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .cart-summary h4 {
            font-size: 18px;
            font-weight: bold;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .cart-summary p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .cart-summary h4.total {
            border-top: 1px solid #eee;
            padding-top: 10px;
        }

        .btn-checkout {
            background-color: #28a745;
            color: #fff;
            border-radius: 30px;
            padding: 10px 30px;
            font-weight: bold;
            margin-top: 20px;
            width: 100%;
        }

        .btn-checkout:hover {
            background-color: #218838;
        }

        .coupon-section {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .coupon-section input {
            flex: 1;
            margin-right: 10px;
            border-radius: 30px;
            padding: 10px 20px;
            border: 1px solid #ccc;
        }

        .coupon-section button {
            border-radius: 30px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
        }

        .coupon-section button:hover {
            background-color: #0056b3;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .cart-section {
                flex-direction: column;
            }

            .cart-summary {
                margin-left: 0;
                margin-top: 20px;
            }

            .coupon-section {
                flex-direction: column;
            }

            .coupon-section input, .coupon-section button {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mt-5">Giỏ hàng của bạn</h2>
    <div class="cart-section">
        <div class="cart-table">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <img src="https://via.placeholder.com/80" alt="Product Image">
                            Fresh Strawberries
                        </td>
                        <td>$36.00</td>
                        <td>
                            <div class="quantity-control">
                                <button class="btn btn-outline-secondary" type="button">-</button>
                                <input type="text" value="1">
                                <button class="btn btn-outline-secondary" type="button">+</button>
                            </div>
                        </td>
                        <td>$36.00</td>
                    </tr>
                    <tr>
                        <td>
                            <img src="https://via.placeholder.com/80" alt="Product Image">
                           Quá được nhở
                        </td>
                        <td>$16.00</td>
                        <td>
                            <div class="quantity-control">
                                <button class="btn btn-outline-secondary" type="button">-</button>
                                <input type="text" value="1">
                                <button class="btn btn-outline-secondary" type="button">+</button>
                            </div>
                        </td>
                        <td>$16.00</td>
                    </tr>
                </tbody>
            </table>
            <div class="coupon-section">
                <input type="text" placeholder="Coupon Code">
                <button class="btn">APPLY COUPON</button>
            </div>
        </div>

        <div class="cart-summary">
            <div>
                <h4>Tổng đơn hàng</h4>
                <p><strong>Subtotal:</strong> $52.00</p>
                <p><strong>Shipping:</strong> Free</p>
                <h4 class="total"><strong>Total:</strong> $52.00</h4>
            </div>
            <a href="checkout.html" class="btn btn-checkout">TIẾP TỤC THANH TOÁN</a>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
