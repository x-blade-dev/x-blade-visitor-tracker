<div class="bg-white p-6 rounded-lg border border-gray-200">
    <h2 class="text-xl font-semibold mb-4 text-gray-800">📊 Visitor Log</h2>

    <!-- Today's visit count box -->
    <div class="flex items-center justify-between bg-blue-500 text-white p-4 rounded-lg">
        <div>
            <p class="text-sm font-medium">Today's Total Visits</p>
            <p id="visitorCount" class="text-3xl font-bold">0</p> <!-- AJAX target -->
        </div>
        <button id="toggleDetails" class="bg-white text-blue-500 px-4 py-2 rounded-lg hover:bg-gray-100 transition">
            View Details
        </button>
    </div>

    <!-- Visit details -->
    <div id="visitorDetails" class="hidden mt-4">
        <h3 class="text-lg font-semibold mb-2 text-gray-700">📌 Visit Details</h3>
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 max-h-[300px] overflow-y-auto">
            <ul class="space-y-3">
                @forelse ($visitors as $visitor)
                    <li class="py-2 border-b border-gray-200 last:border-b-0">
                        <p class="font-medium text-gray-800">IP: <span class="font-normal">{{ $visitor['ip'] }}</span></p>
                        <p class="font-medium text-gray-800">Device: <span class="font-normal">{{ $visitor['agent'] }}</span></p>
                        <p class="font-medium text-gray-800">Time: <span class="font-normal">{{ $visitor['time'] }}</span></p>
                    </li>
                @empty
                    <li class="text-gray-500 py-2">No visits recorded today.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

<!-- Toggle Detail Script + Realtime Fetch -->
<script>
    // Toggle detail section
    document.getElementById('toggleDetails').addEventListener('click', function () {
        const details = document.getElementById('visitorDetails');
        details.classList.toggle('hidden');
    });

    // Function to fetch visitor count via AJAX
    async function fetchVisitorCount() {
        try {
            const response = await fetch('/api/visitor-count');
            const data = await response.json();
            document.getElementById('visitorCount').textContent = data.count;
        } catch (error) {
            console.error('Failed to fetch visitor count:', error);
        }
    }

    // First load
    fetchVisitorCount();

    // Polling every 5 seconds
    setInterval(fetchVisitorCount, 5000);
</script>
