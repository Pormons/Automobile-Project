<div class="w-full p-3  dark:bg-gray-900">
    <div class="flex flex-col items-start space-y-5 mb-2">
        <a href="{{ route('dealers') }}"
            class="bg-blue-300 p-2 flex items-center justify-center rounded-lg text-[20px] hover:bg-blue-900 hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
            </svg>
            BACK
        </a>
        <span class="text-[40px] font-thin">{{ $name }} - Inventory </span>
    </div>
    <section class="sm:p-5">
        <div class="mx-auto max-w-screen-xl">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-[40%] flex flex-row space-x-2">
                        <div class="flex flex-row-reverse border-2 rounded-lg pr-2">
                            <div class="flex items-center">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input
                                class="flex flex-grow bg-transparent focus:border-none focus:ring-0 border-none outline-none"
                                wire:model.live="searchVin" id="simple-search" name="simple-search" type="text"
                                placeholder="Search Vin">
                        </div>
                        <div>
                            <select id="countries" wire:model.live="searchBrand"
                                class="bg-transparent border-2 rounded-lg focus:ring-0 focus:outline-none outline-none">
                                <option value="">Brands</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-row space-x-6">
                        <div data-modal-target=vehicle-dealer-modal data-modal-toggle=vehicle-dealer-modal
                            class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                            <button type="button"
                                class="flex items-center justify-center text-white bg-black hover:bg-primary-800 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none focus:ring-0">
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                Add Vehicle To Inventory
                            </button>
                        </div>
                        <livewire:admin.components.add-vehicle-dealer :dealerId="$dealerId" />
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Vehicle Identification Number</th>
                                <th scope="col" class="px-4 py-3">Brand</th>
                                <th scope="col" class="px-4 py-3">Model</th>
                                <th scope="col" class="px-4 py-3">Variant</th>
                                <th scope="col" class="px-4 py-3">Color</th>
                                <th scope="col" class="px-4 py-3">Body Style</th>
                                <th scope="col" class="px-4 py-3">Model Year</th>
                                <th scope="col" class="px-4 py-3">Retail Price</th>
                                <th scope="col" class="px-4 py-3">Manufactured Date</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventories as $inventory)
                                    <tr class="border-b dark:border-gray-700">
                                        <th scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $inventory->vin_info->vin }}
                                        </th>
                                        <td class="px-4 py-3">{{ $inventory->vin_info->model_info->brand_info->brand_name }}</td>
                                        <td class="px-4 py-3">{{ $inventory->vin_info->model_info->model_name }}</td>
                                        <td class="px-4 py-3">{{ $inventory->vin_info->variant_info->variant_name }}</td>
                                        <td class="px-4 py-3">{{ $inventory->vin_info->color_info->color_name }}</td>
                                        <td class="px-4 py-3">{{ $inventory->vin_info->body_info->body_style }}</td>
                                        <td class="px-4 py-3">{{ $inventory->vin_info->model_year }}</td>
                                        <td class="px-4 py-3">{{ $inventory->retail_price }}</td>
                                        <td class="px-4 py-3">{{ $inventory->vin_info->manufactured_date }}</td>
                                        <td class="px-4 py-3">{{ $inventory->sold_status }}</td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <nav class="p-4">
                    {{ $inventories->links() }}
                </nav>
            </div>
        </div>
    </section>
</div>
