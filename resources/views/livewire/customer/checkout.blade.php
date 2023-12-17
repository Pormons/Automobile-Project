<div class="container flex-col mx-auto p-4 bg-white shadow-md rounded-md flex" wire:loading.remove>
    <div class="flex justify-between space-x-4 ">
        <h1 class=" text-[40px] font-bold mb-4">Order Summary</h1>
        <div class="flex space-x-4">
            <a href="/" class="hover:bg-zinc-300 text-center flex justify-center items-center hover:text-white hover:shadow-xl hover:-translate-y-1 transition-all ease-in-out h-[50px] w-[140px] bg-zinc-600 text-white rounded-xl">
                Cancel Order
            </a>
            <button wire:click="confirmOrder" class="hover:bg-blue-800 hover:text-white hover:shadow-xl hover:-translate-y-1 transition-all ease-in-out h-[50px] w-[140px] bg-blue-500 rounded-xl">
                Confirm Order
            </button>
        </div>
    </div>
    <div class="flex flex-col m-3">
        <div class="order-details col-span-2">
            <div class="mb-4">
                <p><strong>Date:</strong> {{ now()->format('F d Y') }}</p>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-2">
            <div class="border rounded-md col-span-1 p-2">
                <h3 class="text-lg font-bold mb-2">Dealer</h3>
                <p><strong>Dealer:</strong>{{ $inventory->dealer_info->dealer  }}</p>
                <p><strong>Address:</strong>{{ $inventory->dealer_info->address }}</p>
                <p><strong>Email:</strong>{{ $inventory->dealer_info->email }}</p>
                <p><strong>Phone Number:</strong>{{ $inventory->dealer_info->phone_number }}</p>
            </div>
            <div class="border rounded-md col-span-1 p-2">
                <h3 class="text-lg font-bold mb-2">Customer</h3>
                <p><strong>Full Name:</strong>{{ $user->first_name }} {{ $inventory->middle_name }} {{ $inventory->middle_name }}</p>
                <p><strong>Address:</strong>{{ $user->address }}</p>
                <p><strong>Email:</strong>{{ $user->email }}</p>
                <p><strong>Phone Number:</strong>{{ $user->phone_number }}</p>
            </div>
        </div>
    </div>

    <div class="vehicle-details flex-1 ml-4 mb-10">
        <h2 class="text-xl font-bold mb-4">Vehicle Details</h2>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Image</th>
                    <th class="border px-4 py-2">VIN</th>
                    <th class="border px-4 py-2">Brand</th>
                    <th class="border px-4 py-2">Model</th>
                    <th class="border px-4 py-2">Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border px-4 py-2"><img src="{{ asset('storage/' . $inventory->vin_info->image_url) }}" alt="Vehicle Image" class="w-16 h-16"></td>
                    <td class="border px-4 py-2">{{ $inventory->vin_info->vin }}</td>
                    <td class="border px-4 py-2">{{ $inventory->vin_info->model_info->brand_info->brand_name }}</td>
                    <td class="border px-4 py-2">{{ $inventory->vin_info->model_info->model_name }}</td>
                    <td class="border px-4 py-2">$ {{ $inventory->retail_price }}</td>
                </tr>

            </tbody>
            <tfoot>
                <tr>
                    <td class="border border-r-0 px-4 py-2"></td>
                    <td class="border border-r-0 px-4 py-2"></td>
                    <td class="border border-r-0 px-4 py-2"></td>
                    <td class="border text-center "><strong> Total Amount: </strong></td>
                    <td class="border px-4 py-2">$ {{ $inventory->retail_price }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
