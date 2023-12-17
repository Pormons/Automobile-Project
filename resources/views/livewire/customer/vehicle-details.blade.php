<div class="w-full h-full flex flex-row">
    <div class="w-[60%] h-full flex flex-col pl-10 pt-0.5 pb-6">
        <div class="flex flex-row items-centersjustify-between">
            <div class="p-2 flex flex-col items-start">
                <p class="text-[30px] font-semibold">{{ $vehicle->vin_info->model_year }}
                    {{ $vehicle->vin_info->model_info->model_name }} </p>
                <p class="text-gray-600">{{ $vehicle->vin_info->model_info->brand_info->brand_name }},
                    {{ $vehicle->vin_info->variant_info->variant_name }}</p>
            </div>
        </div>
        <div class="border shadow-2xl flex items-center justify-center h-[80%] w-full rounded overflow-hidden">
            <img src="{{ asset('storage/' . $vehicle->vin_info->image_url) }}" alt=""
                class="w-full h-full object-fill">
        </div>
    </div>

    <div class="flex flex-col flex-grow p-7 space-y-4">
        <div class="border bg-zinc-600 text-white rounded-xl flex flex-col items-center space-y-7 p-4">
            <div class="flex flex-col items-center">
                <p>PRICE</p>
                <p class="text-[40px] font-medium">${{ $vehicle->retail_price }}</p>
            </div>

            <div class="flex flex-col items-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" width="32" height="32">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                </svg>
                <div class="flex flex-col text-center">
                    <span class="font-extralight">
                        Dealer Location
                    </span>
                    <p class="font-bold">
                        {{ $vehicle->dealer_info->dealer }}
                    </p>
                    <p class="font-bold">
                        {{ $vehicle->dealer_info->address }}
                    </p>
                </div>
            </div>

            <div class="flex w-full items-center justify-center space-x-5 flex-wrap">

                @if ((!isset(session('shoppingCart', [])[$vehicle->id])))
                <button wire:click='addCart'
                    class="w-1/4 p-3 outline-none border-none hover:bg-zinc-800 bg-zinc-500 text-white rounded-xl">
                    Add to Cart
                </button>
                @else
                    <button wire:click='removeCart'
                        class="w-[27%] p-3 outline-none border-none text-sm hover:bg-red-800 bg-red-500 text-white rounded-xl">
                        Remove from Cart
                    </button>
                @endif
                <a href="{{ $vehicle->id }}/Checkout"
                    class="w-1/4 text-center p-3 border-none outline-none bg-blue-700 hover:bg-blue-800 text-white rounded-xl">
                    Buy Now
                </a>
            </div>
        </div>
        <div class=" bg-zinc-500 text-white shadow-2xl flex flex-col text-center w-full rounded-xl p-5">
            <h3 class="mb-3 text-lg font-semibold">Vehicle Overview</h3>
            <div class="grid grid-cols-3 gap-3">
                <div class="flex flex-col">
                    <div class="flex flex-col text-left">
                        <span>
                            Transmission:
                        </span>
                        <p class="font-bold">{{ $vehicle->vin_info->vehicleparts[1]->part_info->part_name }}
                        </p>
                    </div>
                </div>

                <!-- Engine -->
                <div class="flex flex-col">
                    <div class="flex flex-col text-left">
                        <span>
                            Engine:
                        </span>
                        <p class="font-bold">{{ $vehicle->vin_info->vehicleparts[0]->part_info->part_name }}
                        </p>
                    </div>
                </div>

                <!-- Exterior -->
                <div class="flex flex-col">
                    <div class="flex flex-col text-left">
                        <span class="font-extralight">
                            Exterior
                        </span>
                        <p class="font-bold">{{ $vehicle->vin_info->color_info->color_name }}</p>
                    </div>
                </div>

                <!-- Axle -->
                <div class="flex flex-col">
                    <div class="flex flex-col text-left">
                        <span>
                            Axle:
                        </span>
                        <p class="font-bold">{{ $vehicle->vin_info->vehicleparts[2]->part_info->part_name }}
                        </p>
                    </div>
                </div>

                <!-- ShockObserber -->
                <div class="flex flex-col">
                    <div class="flex flex-col text-left">
                        <span class="font-extralight">
                            Shock Absorber:
                        </span>
                        <p class="font-bold">
                            {{ $vehicle->vin_info->vehicleparts[3]->part_info->part_name }}
                        </p>
                    </div>
                </div>

                <!-- VIN -->
                <div class="flex flex-col">
                    <div class="flex flex-col text-left">
                        <span class="font-extralight">
                            VIN #
                        </span>
                        <p class="font-bold">{{ $vehicle->vin_info->vin }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
