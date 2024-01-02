<div class="w-full h-full flex flex-col" wire:ignore.self>
    <div class="h-[10%] p-2 px-4 items-center w-full flex flex-row justify-between">
        <div>
        </div>
        <div class="flex flex-flex-row w-[22%] border-2 items-center bg-white px-2 rounded-xl">
            <input type="search" wire:model.live.debounce.500ms="searchVehicle" name=""
                class="w-full focus:ring-0 focus:outline-none border-none rounded-xl" id="">
            <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </div>
    </div>
    <div class="flex flex-row flex-grow w-full p-2">
        <div class="top-0 h-full space-y-5 w-[15%]">
            <div id="colors">
                <span class="flex items-center justify-between w-full rtl:text-right font-semibold">
                    Colors
                </span>
                <div class="p-2 dark:bg-gray-900">
                    <ul class="grid grid-cols-2 gap-2">
                        @foreach ($colors as $key => $color)
                            <li>
                                <div class="flex items-center mt-1">
                                    <input wire:model.live.debounce.500ms="selectedColors"
                                        id="default-checkbox-{{ $key }}" type="checkbox"
                                        value="{{ $color->id }}"
                                        class="w-4 h-4 text-zinc-700 bg-gray-100 border-gray-300 focus:text-zinc-500 focus:ring-zinc-700 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="default-checkbox-{{ $key }}"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $color->color_name }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div id="body_style">
                <span class="flex items-center justify-between w-full rtl:text-right font-semibold">
                    Body Styles
                </span>
                <div class="p-2">
                    <ul class="grid grid-cols-2 gap-2">
                        @foreach ($bodyStyles as $key => $bodyStyle)
                            <li>
                                <div class="flex items-center mt-1">
                                    <input wire:model.live.debounce.500ms="selectedBodyStyles"
                                        id="default-checkbox-{{ $key }}" type="checkbox"
                                        value="{{ $bodyStyle->id }}"
                                        class="w-4 h-4 text-zinc-700 bg-gray-100 border-gray-300 focus:text-zinc-500 focus:ring-zinc-700 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="default-checkbox-{{ $key }}"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $bodyStyle->body_style }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div id="variants">
                <span class="flex items-center justify-between w-full rtl:text-right font-semibold">
                    Variants
                </span>
                <div class="p-2 ">
                    <ul class="grid grid-cols-2 gap-2">
                        @foreach ($variants as $key => $variant)
                            <li>
                                <div class="flex items-center mt-1">
                                    <input wire:model.live.debounce.500ms="selectedVariants"
                                        id="default-checkbox-{{ $key }}" type="checkbox"
                                        value="{{ $variant->id }}"
                                        class="w-4 h-4 text-zinc-700 bg-gray-100 border-gray-300 focus:text-zinc-500 focus:ring-zinc-700 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="default-checkbox-{{ $key }}"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $variant->variant_name }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="flex w-[85%]">
            <div class="grid w-full grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 pl-4 pr-4 pb-4">
                <!-- Your cards go here -->
                @foreach ($vehicles as $vehicle)
                    <a href="/{{ $vehicle->inventories->first()->id }}"
                        class="relative shadow-lg hover:-translate-y-1 transition-all ease-in-out bg-zinc- rounded-sm hover:shadow-md cursor-pointer flex flex-col items-center z-10 h-[20rem]">
                        <div class="overflow-hidden rounded-t-md w-full">
                            <img src="{{ asset('storage/' . $vehicle->image_url) }}" alt="Product Image"
                                class="w-full h-[11rem] object-cover mb-4 rounded-t-sm">
                            <div
                                class="absolute inset-x-0 bottom-[142px] h-[2.8rem] bg-gradient-to-b from-transparent to-white opacity-[98%] rounded-t-md">
                            </div>
                        </div>

                        <div class="relative flex-grow flex p-4 flex-col w-full justify-between z-10">
                            <div>
                                <h2 class="text-xl font-semibold mb-2">
                                    {{ $vehicle->model_info->brand_info->brand_name }}
                                </h2>
                                <p class="text-gray-600 mb-2">{{ $vehicle->model_info->model_name }}
                                    {{ $vehicle->model_year }} </p>
                            </div>
                            <div class="flex justify-between items-center">
                                <p class="text-lg font-bold text-green-600">
                                    ${{ $vehicle->inventories->first()->retail_price }}
                                </p>
                                <p>
                                    {{ $vehicle->inventories->first()->dealer_info->address }}
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach


            </div>
        </div>
    </div>
</div>
