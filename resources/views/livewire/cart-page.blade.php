<div class="flex flex-row h-full w-full justify-center space-x-6">

    <div class="w-[50%] flex flex-col border space-y-3 p-3">
        @foreach ($vehicles as $vehicle)
        <div id="vehicle" class="flex border items-center rounded-lg flex-row w-full h-[20%] my-4 overflow-hidden shadow-md">
            <div class="w-[30%]">
                <img src="{{ asset('storage/' . $vehicle->vin_info->image_url) }}" alt="Vehicle Image" class="w-full h-full object-cover" />
            </div>
            <div class="w-[30%] flex flex-col justify-center px-4">
                <div class="">
                    <span class="text-lg font-semibold">{{ $vehicle->vin_info->model_info->model_name }}</span>
                    <span >{{ $vehicle->vin_info->model_info->brand_info->brand_name }}</span>
                </div>
                <div class="mb-1">
                    <span>{{ $vehicle->vin_info->model_year }}</span>
                </div>
                <div class="mb-1">
                    <span>{{ $vehicle->vin_info->variant_info->variant_name }}</span>
                </div>
            </div>
            <div class="w-[30%] flex flex-col justify-center px-4">
                <span class="text-lg font-semibold">Price - ${{ $vehicle->retail_price }}</span>
                <span class="text-base font-medium">Dealer - {{ $vehicle->dealer_info->dealer }}</span>
            </div>
            <button wire:click="removeCart({{ $vehicle->id }})" class="text-red-800">
                Remove
            </button>
        </div>
        @endforeach
    </div>
    <div class="w-[30%] bg-zinc-600 text-white border rounded-lg overflow-hidden shadow-md p-4">
        <h2 class="text-2xl font-semibold mb-4">Order Overview</h2>
        <div class="h-[70%] overflow-y-auto">
            @foreach ($vehicles as $vehicle)
            <div class="mb-4 border-b pb-2">
                <h3 class="text-lg font-semibold  mb-2">Dealer - {{ $vehicle->dealer_info->dealer }}</h3>

                <div class="flex justify-between items-center">
                    <div class="flex flex-col">
                        <span class="text-md "> {{ $vehicle->vin_info->model_info->brand_info->brand_name }}</span>
                        <span class="text-lg font-semibold ">{{ $vehicle->vin_info->model_year }} {{ $vehicle->vin_info->model_info->model_name }}</span>

                    </div>

                    <div class="flex items-center">
                        <span class="text-lg font-semibold ml-2">${{ $vehicle->retail_price }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Total -->
        <div class="border-t pt-2 mt-2 mb-7">
            <div class="flex justify-between items-center">
                <span class="text-lg font-semibold">Total:</span>
                <span class="text-lg font-semibold">${{ $vehicles->sum('retail_price') }}</span>
            </div>
        </div>
        <div class="flex justify-end">
            <button wire:click="confirmOrder" class="bg-blue-500 text-white hover:bg-blue-800 hover:shadow-lg p-3 rounded-md">
                Confirm Order
            </button>
        </div>
    </div>


</div>
