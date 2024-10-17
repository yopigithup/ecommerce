<div>
    @if ($orders->isEmpty())
        <div class="alert alert-info">No orders have been placed yet.</div>
    @else
        <table class="w-full border border-collapse border-gray-300 table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2 border border-gray-300">Order ID</th>
                    <th class="px-4 py-2 border border-gray-300">Customer ID</th>
                    <th class="px-4 py-2 border border-gray-300">Product ID</th>
                    {{-- <th class="px-4 py-2 border border-gray-300">Quantity</th> --}}
                    <th class="px-4 py-2 border border-gray-300">Total Price</th>
                    <th class="px-4 py-2 border border-gray-300">Status</th>
                    <th class="px-4 py-2 border border-gray-300">Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td class="px-4 py-2 border border-gray-300">{{ $order->id }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $order->customer_id }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $order->product_id }}</td>
                        {{-- <td class="px-4 py-2 border border-gray-300">{{ $order->product->qty }}</td> --}}
                        <td class="px-4 py-2 border border-gray-300">{{ $order->total_price }} Birr</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $order->status == 1 ? 'Paid' : 'Not Paid' }}
                        </td>
                        <td class="px-4 py-2 border border-gray-300">{{ $order->created_at->format('Y-m-d H:i') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
</div>
