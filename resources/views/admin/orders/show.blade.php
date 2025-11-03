<x-app-layout>
    <x-slot name="header">
        <div class="admin-header-flex">
            <h2 class="admin-header-title">
                {{ __('Order Details') }}
            </h2>
        </div>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="card-list">

                {{-- Card 1: Order & Customer Details --}}
                <div class="admin-card">
                    <div class="admin-card-body">
                        <div class="admin-order-details-grid">
                            {{-- Order Details --}}
                            <div>
                                <h3 class="admin-detail-heading">Order #{{ $order->id }}</h3>
                                <div class="admin-detail-group">
                                    <p class="admin-text-secondary"><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, H:i A') }}</p>
                                    <p class="admin-text-secondary"><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
                                    <p class="admin-text-secondary"><strong>Total Amount:</strong> <span class="font-bold text-lg text-gray-900">৳{{ number_format($order->total, 2) }}</span></p>
                                </div>
                                <div class="mt-4">
                                    @php
                                        $statusColorClass = match($order->status) {
                                            'pending' => 'status-2',
                                            'processing' => 'status-4',
                                            'shipped' => 'status-5',
                                            'delivered' => 'status-3',
                                            'cancelled' => 'status-1',
                                            default => 'status-8',
                                        };
                                    @endphp
                                    <span class="admin-status-badge {{ $statusColorClass }}">{{ $order->status }}</span>
                                </div>
                            </div>

                            {{-- Customer Details --}}
                            <div>
                                <h3 class="admin-detail-heading">Customer Details</h3>
                                <div class="admin-detail-group">
                                    <p class="admin-text-secondary"><strong>Name:</strong> {{ $order->name }}</p>
                                    <p class="admin-text-secondary"><strong>Email:</strong> <a href="mailto:{{ $order->email }}" class="text-blue-600 hover:underline">{{ $order->email }}</a></p>
                                    <p class="admin-text-secondary"><strong>Phone:</strong> {{ $order->phone }}</p>
                                    <p class="admin-text-secondary"><strong>Shipping Address:</strong> {{ $order->address }}, {{ $order->city }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 2: Order Items --}}
                <div class="admin-card">
                    <div class="admin-card-body">
                        <h3 class="admin-detail-heading">Order Items ({{ $order->items->count() }})</h3>
                        <div class="admin-table-container">
                            <table class="admin-table">
                                <thead class="admin-table-thead">
                                    <tr>
                                        <th scope="col" class="admin-table-th mobile-visible-column">Product</th>
                                        <th scope="col" class="admin-table-th text-center">Quantity</th>
                                        <th scope="col" class="admin-table-th text-right">Unit Price</th>
                                        <th scope="col" class="admin-table-th text-right">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="admin-table-tbody">
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td class="admin-table-td mobile-visible-column">
                                                <span class="table-cell-content">
                                                    <div class="flex items-center">
                                                        <img src="{{ $item->product->image_path ? asset('storage/' . $item->product->image_path) : 'https://via.placeholder.com/100' }}" alt="{{ $item->product->name }}" class="w-12 h-12 object-cover rounded-md mr-4">
                                                        <div>
                                                            <p class="font-semibold text-sm">{{ $item->product->name }}</p>
                                                            <p class="text-xs text-gray-500">SKU: {{ $item->product->sku }}</p>
                                                        </div>
                                                    </div>
                                                </span>
                                            </td>
                                            <td class="admin-table-td text-center">{{ $item->quantity }}</td>
                                            <td class="admin-table-td text-right">৳{{ number_format($item->price, 2) }}</td>
                                            <td class="admin-table-td text-right">৳{{ number_format($item->price * $item->quantity, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Card 3: Update Status --}}
                <div class="admin-card">
                    <div class="admin-card-body">
                        <div class="admin-form-container">
                            <header>
                                <h3 class="admin-detail-heading">Update Order Status</h3>
                                <p class="admin-section-description">Change the current status of the order.</p>
                            </header>
                            <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="admin-form-vertical">
                                @csrf
                                @method('PUT')
                                <div class="admin-form-group">
                                    <select name="status" class="admin-form-input">
                                        <option value="pending" @if($order->status == 'pending') selected @endif>Pending</option>
                                        <option value="processing" @if($order->status == 'processing') selected @endif>Processing</option>
                                        <option value="shipped" @if($order->status == 'shipped') selected @endif>Shipped</option>
                                        <option value="delivered" @if($order->status == 'delivered') selected @endif>Delivered</option>
                                        <option value="cancelled" @if($order->status == 'cancelled') selected @endif>Cancelled</option>
                                    </select>
                                </div>
                                <div class="admin-form-actions">
                                    <button type="submit" class="admin-button-base admin-button-purple">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
