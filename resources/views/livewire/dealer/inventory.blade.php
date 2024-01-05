<div class="w-full p-3  dark:bg-gray-900">
    <div class="flex flex-col items-start space-y-5 mb-2">
        <span class="text-[40px] font-thin">{{ $name }} - Inventory </span>
    </div>
    <section class="sm:p-5">
        <div class="mx-auto max-w-screen-xl">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-2 md:space-y-0 md:space-x-4 p-2">
                    <div class="w-full md:w-[70%] flex flex-row space-x-2">
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
                                wire:model.live.500ms="searchVin" id="simple-search" name="simple-search" type="text"
                                placeholder="Search Vin">
                        </div>
                        <div>
                            <select id="countries" wire:model.live.500ms="searchBrand"
                                class="bg-transparent border-2 rounded-lg focus:ring-0 focus:outline-none outline-none">
                                <option value="">Brands</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <select id="models" wire:model.live.500ms="searchModel"
                                class="bg-transparent mb-2 w-full border-2 rounded-lg focus:ring-0 focus:outline-none outline-none">
                                <option value="">Model</option>
                                @foreach ($brandmodels as $model)
                                    <option value="{{ $model->id }}">{{ $model->model_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <select id="models" wire:model.live.500ms="searchStatus"
                                class="bg-transparent mb-2 w-full border-2 rounded-lg focus:ring-0 focus:outline-none outline-none">
                                <option value="">Sell</option>
                                <option value=1 >Available</option>
                                <option value=false >Not Yet Available</option>
                            </select>
                        </div>
                        <div>
                            <select id="models" wire:model.live.500ms="status"
                                class="bg-transparent mb-2 w-full border-2 rounded-lg focus:ring-0 focus:outline-none outline-none">
                                <option value="">Status</option>
                                <option value=1>Sold</option>
                                <option value=0 >Available</option>
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
                        <livewire:dealer.components.add-inventory />
                        <livewire:dealer.components.retail-modal />
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Vehicle</th>
                                <th scope="col" class="px-4 py-3">Vehicle Identification Number</th>
                                <th scope="col" class="px-4 py-3">Brand</th>
                                <th scope="col" class="px-4 py-3">Model</th>
                                <th scope="col" class="px-4 py-3">Variant</th>
                                <th scope="col" class="px-4 py-3">Color</th>
                                <th scope="col" class="px-4 py-3">Body Style</th>
                                <th scope="col" class="px-4 py-3">Model Year</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">Retail Price</th>
                                <th scope="col" class="px-4 py-3">Sell</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventories as $key => $inventory)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3 font-semibold">
                                        <img src="{{ asset('storage/' . $inventory->vin_info->image_url) }}"
                                            alt="" class="h-16 w-25 object-cover rounded">
                                    </td>
                                    <th scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $inventory->vin_info->vin }}
                                    </th>
                                    <td class="px-4 py-3">{{ $inventory->vin_info->model_info->brand_info->brand_name }}
                                    </td>
                                    <td class="px-4 py-3">{{ $inventory->vin_info->model_info->model_name }}</td>
                                    <td class="px-4 py-3">{{ $inventory->vin_info->variant_info->variant_name }}</td>
                                    <td class="px-4 py-3">{{ $inventory->vin_info->color_info->color_name }}</td>
                                    <td class="px-4 py-3">{{ $inventory->vin_info->body_info->body_style }}</td>
                                    <td class="px-4 py-3">{{ $inventory->vin_info->model_year }}</td>
                                    <td class="px-4 py-3">
                                        @if ($inventory->sold_status)
                                            Sold
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">{{ $inventory->retail_price }}</td>
                                    <td class="px-4 py-3 flex items-center justify-center">
                                        @if (!$inventory->retail_price)
                                            Input Price
                                        @else
                                            <div class="flex items-center">
                                                <label class="relative inline-flex items-center me-5 cursor-pointer">
                                                    <input
                                                        wire:click='toggleUserStatus("{{ $inventory->vin_info->vin }}")'
                                                        type="checkbox" value="" class="sr-only peer"
                                                        {{ $inventory->available ? 'checked' : '' }}
                                                        {{ $inventory->sold_status ? 'disabled' : '' }}
                                                    >
                                                    <div class="w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                                                    </div>
                                                </label>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <button id="dropdownMenuIconButton"
                                            data-dropdown-toggle="dropdownDots{{ $key }}"
                                            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                            type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="currentColor" viewBox="0 0 4 15">
                                                <path
                                                    d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                            </svg>
                                        </button>
                                        <div id="dropdownDots{{ $key }}"
                                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                                aria-labelledby="dropdownMenuIconButton">

                                                @if ($inventory->sold_status)
                                                    <li>
                                                        <a href="/Dealer/Transactions/{{ $inventory->purchasedVehicles->first()->transaction }}"
                                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Details</a>

                                                    </li>
                                                @else
                                                <li>
                                                    <a href="#"
                                                        wire:click='returnVehicle({{ $inventory->id }})'
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Return</a>
                                                </li>
                                                <li>
                                                    <div data-modal-target=retail-modal data-modal-toggle=retail-modal
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                        <button type="button"
                                                            wire:click='retailPrice({{ $inventory->id }})'>
                                                            Retail Price
                                                        </button>
                                                    </div>
                                                </li>


                                                @endif

                                            </ul>
                                        </div>
                                    </td>

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
