<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <div class="admin-card-header">
                        <form action="{{ route('admin.orders.index') }}" method="GET" class="admin-search-container">
                            <input type="text" name="search" placeholder="Search orders..." value="{{ request('search') }}" class="admin-search-input">
                            <button type="submit" class="admin-button-base admin-button-black">
                                Search
                            </button>
                        </form>
                    </div>
                    <table class="admin-table">
                        <thead class="admin-table-thead">
                            <tr>
                                <th scope="col" class="admin-table-th mobile-visible-column">
                                    Order ID
                                </th>
                                <th scope="col" class="admin-table-th mobile-visible-column">
                                    Customer
                                </th>
                                <th scope="col" class="admin-table-th">
                                    Total
                                </th>
                                <th scope="col" class="admin-table-th">
                                    Status
                                </th>
                                <th scope="col" class="admin-table-th">
                                    Order Date
                                </th>
                                <th scope="col" class="admin-table-th-action mobile-visible-column">
                                    <span class="sr-only">View</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="admin-table-tbody">
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="admin-table-td mobile-visible-column">
                                        <span class="table-cell-content">{{ $order->id }}</span>
                                    </td>
                                    <td class="admin-table-td mobile-visible-column">
                                        {{ $order->name }}
                                    </td>
                                    <td class="admin-table-td">
                                        {{ $order->total }}
                                    </td>
                                    <td class="admin-table-td">
                                        @php
                                            $badgeClass = match($order->status) {
                                                'pending' => 'status-2',
                                                'processing' => 'status-4',
                                                'shipped' => 'status-5',
                                                'delivered' => 'status-3',
                                                'cancelled' => 'status-1',
                                                default => 'status-8',
                                            };
                                        @endphp
                                        <span class="admin-status-badge {{ $badgeClass }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="admin-table-td">
                                        {{ $order->created_at->format('d M Y') }}
                                    </td>
                                    <td class="admin-table-td admin-table-action-td mobile-visible-column">
                                        <span class="table-cell-content">
                                            <a href="{{ route('admin.orders.show', $order) }}" class="admin-table-action-icon" title="View">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="admin-pagination-container">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>