<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Receipt</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    .container {
      width: 80%;
      margin: 50px auto;
      background-color: #fff;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .header h1 {
      margin: 0;
      color: #4CAF50;
    }

    .content {
      margin-bottom: 20px;
    }

    .content p {
      margin: 5px 0;
    }

    .footer {
      text-align: center;
      margin-top: 20px;
    }

    .footer p {
      margin: 0;
      color: #888;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <h1>Payment Successful</h1>
    </div>
    <div class="content">
      <p>Thank you for your payment!</p>
      <p><strong>Transaction ID:</strong> {{ $payments->id }}</p>
      <p><strong>Payment Method:</strong> {{ $payments->payment_method }}</p>
      <p><strong>Amount Paid:</strong> {{ $payments->amount }}</p>
      <p><strong>Date:</strong> {{ $payments->created_at }}</p>
    </div>
    <div class="footer">
      <p>&copy; {{ date('Y') }} Booking App. All rights reserved.</p>
    </div>
  </div>
</body>

</html>
