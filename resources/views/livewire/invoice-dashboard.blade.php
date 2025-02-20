<div class="p-6 bg-white rounded-lg shadow-md">
    <!-- Tabs -->
    <div class="flex space-x-4 border-b pb-2 mb-4">
        @foreach (['all' => 'All invoices', 'draft' => 'Draft', 'outstanding' => 'Outstanding', 'paid' => 'Paid'] as $key => $label)
            <button wire:click="setTab('{{ $key }}')"
                class="px-4 py-2 text-sm font-medium rounded-t-lg {{ $activeTab === $key ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-600' }}">
                {{ $label }}
            </button>
        @endforeach
    </div>

    <!-- Invoice Table -->
    <table class="w-full border-collapse">
        <thead>
            <tr class="text-left bg-gray-100">
                <th class="p-2">AMOUNT</th>
                <th class="p-2">INVOICE NUMBER</th>
                <th class="p-2">CUSTOMER</th>
                <th class="p-2">STATUS</th>
                <th class="p-2">CREATED</th>
                <th class="p-2"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($filteredInvoices as $index => $invoice)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-2">${{ $invoice['amount'] }} USD</td>
                    <td class="p-2">{{ $invoice['number'] }}</td>
                    <td class="p-2">{{ $invoice['customer'] }}</td>
                    <td class="p-2">
                        <span class="px-2 py-1 text-xs font-semibold rounded-lg 
                            {{ $invoice['status'] === 'paid' ? 'bg-green-200 text-green-700' : ($invoice['status'] === 'draft' ? 'bg-gray-200 text-gray-700' : 'bg-yellow-200 text-yellow-700') }} ">
                            {{ ucfirst($invoice['status']) }}
                        </span>
                    </td>
                    <td class="p-2">{{ $invoice['created'] }}</td>
                    <td class="p-2 relative">
                        <!-- Dropdown Button -->
                        <button wire:click="toggleDropdown({{ $index }})" class="px-2 py-1 bg-gray-200 rounded focus:outline-none">
                            ⋮
                        </button>

                        <!-- Dropdown Menu -->
                        @if ($dropdownOpen[$index])
                            <div class="absolute right-0 mt-2 w-40 bg-white border rounded-lg shadow-lg">
                                <button class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Download PDF</button>
                                <button class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Duplicate Invoice</button>
                                <button class="block w-full px-4 py-2 text-sm text-red-600 hover:bg-red-100">Delete</button>
                            </div>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-4 text-center text-gray-500">No invoices found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>