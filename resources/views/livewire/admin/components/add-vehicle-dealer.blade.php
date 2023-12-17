<div id="vehicle-dealer-modal" tabindex="-1" wire:ignore.self
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-[70rem] max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-2 md:px-3 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Add Vehicle to Inventory
                </h3>
                <button type="button"
                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="vehicle-dealer-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 flex flex-row md:p-5">
                <div id="dropdownSearch" class="z-10 bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                    <div class="p-3">
                        <label for="input-group-search" class="sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input wire:model.live="searchVin" type="text" id="input-group-search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search vin">
                        </div>
                    </div>
                    <ul class="px-3 h-80 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200">
                        @foreach ($vins as $vin)
                            <li>
                                <div wire:click="selectVin('{{ $vin->vin }}')" class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <input wire:model.defer="selectedVins" value="{{ $vin->vin }}" type="checkbox" value=""
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="checkbox-item-11"
                                        class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                    {{ $vin->vin  }}
                                    </label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <a href="#"
                        wire:click="addVehicles({{ $id }})"
                        class="flex items-center p-3 text-sm font-medium text-red-600 border-t border-gray-200 rounded-b-lg bg-gray-50 dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-red-500 hover:underline">
                        <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 18">
                            <path
                                d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-6a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2Z" />
                        </svg>
                        Add Vehicles
                    </a>
                </div>
                <div class="flex flex-grow flex-row p-4" wire:loading.remove.delay.longest>
                    @if ($selectedVin)
                    <div class="w-[60%] border flex items-center justify-center">
                       <img src="{{ asset('storage/' . $selectedVehicle->image_url) }}" alt="">
                    </div>
                    <div class="p-4 flex flex-col flex-grow items-center">
                        <Span class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $selectedVehicle->model_info->brand_info->brand_name }}</Span>
                        <Span class="mb-2 text-base font-bold tracking-tight text-gray-900 dark:text-white">{{ $selectedVehicle->model_info->model_name }}</Span>
                        <Span class="font-semibold tracking-tight text-lg">VIN : {{ $selectedVin }}</Span>

                        <Label class="mt-5" for="specifications">Specifications</Label>
                        <div id="specifications" name="specifications" class="grid justify-items-start gap-6 grid-cols-2">
                            <div class="flex flex-row items-center mt-4">
                                <h4 class="mr-2 text-gray-600 font-semibold">
                                    Variant:
                                </h4>
                                <span class="text-lg font-bold">
                                    {{ $selectedVehicle->variant_info->variant_name }}
                                </span>
                            </div>
                            <div class="flex flex-row items-center mt-4">
                                <h4 class="mr-2 text-gray-600 font-semibold">
                                    Model Year:
                                </h4>
                                <span class="text-lg font-bold">
                                    {{ $selectedVehicle->model_year }}
                                </span>
                            </div>
                            <div class="flex flex-row items-center mt-1">
                                <h4 class="mr-2 text-gray-600 font-semibold">
                                    Body:
                                </h4>
                                <span class="text-lg font-bold">
                                    {{ $selectedVehicle->body_info->body_style }}
                                </span>
                            </div>
                            <div class="flex flex-row items-center mt-1">
                                <h4 class="mr-2 text-gray-600 font-semibold">
                                    Color:
                                </h4>
                                <span class="text-lg font-bold">
                                    {{ $selectedVehicle->color_info->color_name }}
                                </span>
                            </div>
                            @foreach ($selectedVehicle->vehicleparts as $parts)
                            <div class="flex flex-row items-center mt-1">
                                <h4 class="mr-2 text-gray-600 font-semibold">
                                    {{ $parts->part_info->part_type }}:
                                </h4>
                                <span class="text-lg font-bold">
                                    {{ $parts->part_info->part_name  }}
                                </span>
                            </div>
                            @endforeach

                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
