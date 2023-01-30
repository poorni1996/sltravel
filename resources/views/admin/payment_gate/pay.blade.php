<!DOCTYPE html>
<html lang="en">
<head>
    <title>Payment Gateway</title>

</head>
<body>
    <h1>Pay</h1>
    <form action="{{ route('hotel_booking.paid') }}" method="GET">
        <input type="hidden" name="id" value="{{ $payment['id'] }}">
        <table>
            <tr>
                <td>Description</td>
                <td>:</td>
                <td>{{ $payment['description'] }}</td>
            </tr>
            <tr>
                <td>Price</td>
                <td>:</td>
                <td>Rs. {{ number_format($payment['price'], 2) }}</td>
            </tr>
        </table>
        <hr>
        <div>
            <label for="status">Test Status</label>
            <select name="status" id="status">
                <option value="S">Success</option>
                <option value="E">Error</option>
            </select>
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
</body>
</html>