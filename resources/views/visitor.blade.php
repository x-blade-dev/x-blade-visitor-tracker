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
            <ul id="visitorList" class="space-y-3">
                <li class="text-gray-500 py-2">Loading...</li>
            </ul>
        </div>
    </div>
</div>

<!-- Toggle Detail Script + Realtime Fetch -->
<script>
    const visitorCountEl = document.getElementById('visitorCount');
    const visitorListEl = document.getElementById('visitorList');
    const toggleBtn = document.getElementById('toggleDetails');
    const detailsSection = document.getElementById('visitorDetails');

    toggleBtn.addEventListener('click', function () {
        detailsSection.classList.toggle('hidden');
    });

    async function fetchVisitorData() {
        try {
            const response = await fetch('/api/visitor-count');
            const data = await response.json();

            // Update count
            visitorCountEl.textContent = data.count;

            // Update visitor list
            if (Array.isArray(data.visitors)) {
                visitorListEl.innerHTML = '';

                if (data.visitors.length === 0) {
                    visitorListEl.innerHTML = '<li class="text-gray-500 py-2">No visits recorded today.</li>';
                } else {
                    data.visitors.forEach(visitor => {
                        const li = document.createElement('li');
                        li.className = 'py-2 border-b border-gray-200 last:border-b-0';
                        li.innerHTML = `
                            <p class="font-medium text-gray-800">IP: <span class="font-normal">${visitor.ip}</span></p>
                            <p class="font-medium text-gray-800">Device: <span class="font-normal">${visitor.agent}</span></p>
                            <p class="font-medium text-gray-800">Time: <span class="font-normal">${visitor.time}</span></p>
                        `;
                        visitorListEl.appendChild(li);
                    });
                }
            }

        } catch (error) {
            console.error('Failed to fetch visitor data:', error);
        }
    }

    // First fetch
    fetchVisitorData();

    // Poll every 5 seconds
    setInterval(fetchVisitorData, 5000);
</script>
