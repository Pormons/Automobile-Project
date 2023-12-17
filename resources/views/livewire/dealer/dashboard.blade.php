<div class="w-full h-full flex-col">
    <div class="flex w-full flex-row space-x-4">
        <div class="border rounded-lg flex flex-col flex-grow p-4 bg-white">
            <h2 class="text-xl font-bold mb-2">Annual</h2>
            <span class="text-green-600 text-[40px]">$ {{ $annual }}</span>
        </div>

        <div class="border rounded-lg flex flex-col flex-grow p p-4 bg-white">
            <h2 class="text-xl font-bold mb-2">Monthly</h2>
            <span class="text-green-600 text-[40px]">$ {{ $month }}</span>
        </div>

        <div class="border rounded-lg p-4 flex flex-col flex-grow bg-white">
            <h2 class="text-xl font-bold mb-2">Inventory ({{ $inventory }})</h2>
            <span class="text-green-600 text-[20px]">Sold: {{ $sold }}</span>
            <span class="text-green-600 text-[20px]">Available: {{ $available }}</span>
        </div>

        <div class="border rounded-lg p-4 flex flex-col flex-grow bg-white">
            <h2 class="text-xl font-bold mb-2">Orders ({{ $orders }})</h2>
            <span class="text-green-600">Sold: {{ $sold_status }}</span>
            <span class="text-green-600">Pending: {{ $pending }}</span>
            <span class="text-green-600">Rejected: {{ $rejected }}</span>
        </div>
    </div>
    <div class="flex w-full flex-row space-x-4">
        <div>

        </div>
        <div>

        </div>

    </div>
</div>
