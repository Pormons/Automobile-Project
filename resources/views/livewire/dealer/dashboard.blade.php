<div class="w-full h-full flex-col">
    <div class="flex w-full flex-row space-x-4">
        <div class="border rounded-lg flex flex-col flex-grow p-4 bg-white">
            <div class="flex flex-row items-center">
                <h2 class="text-[30px] font-bold mr-5">Annual</h2>
                <select wire:model.live="year"class="border-none ring-0 focus:ring-0 font-bold text-[26px]">
                    <option value="{{ $currentYear }}" selected>{{ now()->year }}</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                  </select>
            </div>
            <span class="text-green-600 text-[40px]">$ {{ $annual }}</span>
        </div>

        <div class="border rounded-lg flex flex-col flex-grow p p-4 bg-white">
            <h2 class="text-xl font-bold mb-2">Monthly</h2>
            <span class="text-green-600 text-[40px]">$ {{ $month }}</span>
        </div>

        <div class="border rounded-lg p-4 flex flex-col flex-grow bg-white">
            <h2 class="text-xl font-bold mb-2">Orders ({{ $orders }})</h2>
            <span class="text-green-600">Sold: {{ $sold_status }}</span>
            <span class="text-green-600">Pending: {{ $pending }}</span>
            <span class="text-green-600">Rejected: {{ $rejected }}</span>
        </div>
    </div>
    <div class="flex w-full h-full flex-row mt-2 space-x-4">
        <div class="border bg-white rounded-lg p-4 h-[20rem]">
            <span class="text-base font-semibold">
                Inventory (Total - {{ $inventory }})
            </span>
            <div class="h-[87%]">
            <livewire:livewire-column-chart
            :column-chart-model="$columnChartModel"
            />
            </div>
        </div>
        <div class="border text-center bg-white rounded-lg p-4 h-[20rem]">
            <span class="text-base font-semibold">
                Top 2 Models ({{ $year? $year : now()->year }})
            </span>
            <div class="h-[87%]">
                <livewire:livewire-column-chart
                key="{{ $horizontalChartModel->reactiveKey() }}"
                :column-chart-model="$horizontalChartModel"
            />
            </div>
        </div>
        <div class="border text-center bg-white rounded-lg p-4 flex flex-col flex-grow h-[20rem]">
            <span class="text-base font-semibold">
                Total Sales ({{ $year? $year : now()->year }})
            </span>
            <div class="h-[87%] w-full">
                <livewire:livewire-line-chart
                key="{{ $lineChartModel->reactiveKey() }}"
                :line-chart-model="$lineChartModel"
            />
            </div>
        </div>
    </div>
</div>
