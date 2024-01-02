<div class="w-full p-3  dark:bg-gray-900">
    <div class="mb-5">
        <span class="text-[50px] font-thin">Vehicles</span>
    </div>
    <section class="p-0">
        <div class="mx-auto max-w-screen-xl">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 w-full relative shadow-md sm:rounded-lg overflow-hidden">
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
                                wire:model.live="search" id="simple-search" name="simple-search" type="text"
                                placeholder="Search Vin">
                        </div>
                        <div>
                            <select id="countries" wire:model.live="brandSearch"
                                class="bg-transparent border-2 rounded-lg focus:ring-0 focus:outline-none outline-none">
                                <option value="">Brands</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-row space-x-6">
                        <div data-modal-target="models-modal" data-modal-toggle="models-modal"
                            class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                            <button type="button"
                                class="flex items-center justify-center text-white bg-black hover:bg-primary-800 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none focus:ring-0">
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                Add Model Brand
                            </button>
                        </div>
                        <livewire:admin.components.add-model />
                        <div data-modal-target="vehicle-modal" data-modal-toggle="vehicle-modal"
                            class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                            <button type="button"
                                class="flex items-center justify-center text-white bg-black hover:bg-primary-800 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none focus:ring-0">
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                Add Vehicle
                            </button>
                        </div>
                        <livewire:admin.components.add-vehicle />
                    </div>
                </div>
                <div class="w-full">
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
                                <th scope="col" class="px-4 py-3">Price</th>
                                <th scope="col" class="px-4 py-3">Manufactured Date</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">Dealers</th>
                                <th scope="col" class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicles as $vehicle)
                                <tr class="border-b dark:border-gray-700">
                                    <td scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $vehicle->vin }}
                                    </td>
                                    <td class="px-4 py-3">{{ $vehicle->model_info->brand_info->brand_name }}</td>
                                    <td class="px-4 py-3">{{ $vehicle->model_info->model_name }}</td>
                                    <td class="px-4 py-3">{{ $vehicle->variant_info->variant_name }}</td>
                                    <td class="px-4 py-3">{{ $vehicle->color_info->color_name }}</td>
                                    <td class="px-4 py-3">{{ $vehicle->body_info->body_style }}</td>
                                    <td class="px-4 py-3">{{ $vehicle->model_year }}</td>
                                    <td class="px-4 py-3">{{ $vehicle->price }}</td>
                                    <td class="px-4 py-3">{{ $vehicle->manufactured_date }}</td>
                                    <td class="px-4 py-3">{{ $vehicle->status }}</td>
                                    @if ($vehicle->inventories)
                                    <td class="px-4 py-3">
                                        @forelse ($vehicle->inventories as $inventory)
                                            {{ $inventory->dealer_info->dealer }}
                                        @empty

                                        @endforelse
                                    </td>
                                    @endif
                                    <td class="px-4 py-3 flex items-center justify-end gap-3">
                                        @if ($vehicle->status == 'sold')
                                            <a href="/Admin/Vehicles/{{ $vehicle->inventories->first()->purchasedVehicles->first()->transaction }}"
                                                class=" bg-green-200 rounded-md p-1">
                                                <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 20 16">
                                                    <path
                                                        d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM5 12a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm0-3a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm0-3a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm10 6H9a1 1 0 0 1 0-2h6a1 1 0 0 1 0 2Zm0-3H9a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Zm0-3H9a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Z" />
                                                </svg>
                                            </a>
                                        @endif

                                        <button type="button" wire:click="deleteVin('{{ $vehicle->vin }}')"
                                            wire:confirm="Are you sure you want to delete this vehicle?"
                                            class=" bg-red-500 rounded-md p-1">
                                            <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 18 20">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <nav class="p-4">
                    {{ $vehicles->links() }}
                </nav>
            </div>
        </div>
    </section>

</div>
