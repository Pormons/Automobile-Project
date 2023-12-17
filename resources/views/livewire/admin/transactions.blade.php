<div class="w-full p-3  dark:bg-gray-900">
    <div class="flex flex-col items-start space-y-5 mb-2">
        <a href="{{ route('vehicles') }}"
            class="bg-blue-300 p-2 flex items-center justify-center rounded-lg text-[20px] hover:bg-blue-900 hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
            </svg>
            BACK
        </a>
        <span class="text-[40px] font-thin"> Transactions Details </span>
    </div>
    <section class="sm:p-5">
        <div class="mx-auto max-w-screen-xl">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="p-4">
                    <p class="font-semibold">Transaction ID: {{ $details->transaction_id }}</p>
                </div>
                <div
                    class="flex flex-col md:flex-row-reverse justify-center space-y-3 md:space-y-0 md:space-x-4 p-4">

                    <div class="w-[30%] p-4">
                        <p class="font-semibold">Dealer: {{ $details->dealer_info->dealer }}</p>
                        <p>Address: {{ $details->dealer_info->address }}</p>
                        <p>Phone Number: {{ $details->dealer_info->phone_number }}</p>
                        <p>Email: {{ $details->dealer_info->email }}</p>
                        <br>
                        <br>
                        <p class="font-semibold">Customer: {{ $details->customer_info->first_name }}
                            {{ $details->customer_info->middle_name }} {{ $details->customer_info->last_name }}</p>
                        <p>Address: {{ $details->customer_info->address }}</p>
                        <p>Phone Number: {{ $details->customer_info->phone_number }}</p>
                        <p>Email: {{ $details->customer_info->email }}</p>
                    </div>

                    <div class="flex flex-col flex-grow md:flex-row p-4">
                        <div class="w-full overflow-x-auto">
                            <div class="bg-white dark:bg-gray-800 shadow-md rounded-md overflow-hidden">
                                <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">

                                    <thead class="bg-gray-200 dark:bg-gray-700">
                                        <tr>
                                            <th class="px-4 py-3">Product</th>
                                            <th class="px-4 py-3">Details</th>
                                            <th class="px-4 py-3">VIN</th>
                                            <th class="px-4 py-3">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($details->purchasedVehicles as $key => $inventory)
                                            <tr class="{{ $key % 2 === 0 ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                                                <td class="px-4 py-3 font-semibold">
                                                    <img src="{{ asset('storage/' . $inventory->dealer_inventory->vin_info->image_url) }}"
                                                        alt="" class="h-16 w-25 object-cover rounded">
                                                </td>
                                                <td class="px-4 py-3">
                                                    <p class="text-gray-800 dark:text-white">
                                                        <span
                                                            class="font-semibold">{{ $inventory->dealer_inventory->vin_info->model_info->brand_info->brand_name }}
                                                            {{ $inventory->dealer_inventory->vin_info->model_info->model_name }}</span><br>
                                                        {{ $inventory->dealer_inventory->vin_info->color_info->color_name }}
                                                        /
                                                        {{ $inventory->dealer_inventory->vin_info->body_info->body_style }}
                                                        / {{ $inventory->dealer_inventory->vin_info->model_year }}
                                                    </p>
                                                </td>
                                                <td class="px-4 py-3">
                                                    {{ $inventory->dealer_inventory->vin_info->vin }}
                                                </td>
                                                <td class="px-4 py-3">
                                                    ${{ number_format($inventory->dealer_inventory->retail_price, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="font-semibold">
                                        <tr>
                                            <td colspan="3" class="text-right pr-4">Total:</td>
                                            <td class="px-4 py-3">
                                                ${{ number_format($details->purchasedVehicles->sum('price'), 2) }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="w-full md:w-1/3 p-4">
                                <!-- Additional Information, if any -->
                            </div>
                        </div>
                    </div>
                </div>
    </section>
</div>
