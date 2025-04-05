<div class="bg-white p-6 rounded-lg border border-gray-200">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Visitor Analytics</h2>
            <p class="text-gray-500 text-sm">Real-time visitor tracking</p>
        </div>
        <div class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-sm font-medium">
            Live
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <!-- Today's Visits -->
        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-blue-600">Today's Visits</p>
                    <p id="visitorCount" class="text-3xl font-bold text-gray-800">0</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Unique Visitors -->
        <div class="bg-green-50 p-4 rounded-lg border border-green-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-green-600">Unique Visitors</p>
                    <p id="uniqueVisitors" class="text-3xl font-bold text-gray-800">0</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Current Active -->
        <div class="bg-purple-50 p-4 rounded-lg border border-purple-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-purple-600">Active Now</p>
                    <p id="activeVisitors" class="text-3xl font-bold text-gray-800">0</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Traffic Chart -->
    <div class="mb-6">
        <div class="flex justify-between items-center mb-3">
            <h3 class="text-lg font-semibold text-gray-800">Hourly Traffic</h3>
            <span class="text-sm text-gray-500">Last 24 hours</span>
        </div>
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 h-64">
            <canvas id="trafficChart"></canvas>
        </div>
    </div>

    <!-- Visitor Details -->
    <div>
        <div class="flex justify-between items-center mb-3">
            <h3 class="text-lg font-semibold text-gray-800">Recent Visitors</h3>
            <button id="toggleDetails" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                <span>View All</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        </div>
        <div id="visitorDetails" class="hidden">
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 max-h-[300px] overflow-y-auto">
                <ul id="visitorList" class="space-y-3">
                    <li class="text-gray-500 py-2">Loading...</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const visitorCountEl = document.getElementById('visitorCount');
    const uniqueVisitorsEl = document.getElementById('uniqueVisitors');
    const activeVisitorsEl = document.getElementById('activeVisitors');
    const visitorListEl = document.getElementById('visitorList');
    const toggleBtn = document.getElementById('toggleDetails');
    const detailsSection = document.getElementById('visitorDetails');
    let trafficChart = null;

    toggleBtn.addEventListener('click', function () {
        detailsSection.classList.toggle('hidden');
        const icon = this.querySelector('svg');
        if (detailsSection.classList.contains('hidden')) {
            icon.style.transform = 'rotate(0deg)';
            this.querySelector('span').textContent = 'View All';
        } else {
            icon.style.transform = 'rotate(180deg)';
            this.querySelector('span').textContent = 'Hide';
        }
    });

    async function fetchVisitorData() {
        try {
            const response = await fetch('/api/visitor-count');
            const data = await response.json();

            // Update counts
            visitorCountEl.textContent = data.count;
            uniqueVisitorsEl.textContent = data.unique_visitors || '0';
            activeVisitorsEl.textContent = data.active_visitors || '0';

            // Update visitor list
            if (Array.isArray(data.visitors)) {
                visitorListEl.innerHTML = '';

                if (data.visitors.length === 0) {
                    visitorListEl.innerHTML = '<li class="text-gray-500 py-2">No visits recorded today.</li>';
                } else {
                    data.visitors.forEach(visitor => {
                        const li = document.createElement('li');
                        li.className = 'py-3 px-2 hover:bg-gray-100 rounded transition';
                        li.innerHTML = `
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="bg-blue-100 p-2 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">${visitor.ip}</p>
                                        <p class="text-sm text-gray-500">${visitor.agent}</p>
                                    </div>
                                </div>
                                <span class="text-sm text-gray-500">${visitor.time}</span>
                            </div>
                        `;
                        visitorListEl.appendChild(li);
                    });
                }
            }

            // Update chart if hourly data exists
            if (data.hourly_traffic) {
                updateTrafficChart(data.hourly_traffic);
            }

        } catch (error) {
            console.error('Failed to fetch visitor data:', error);
        }
    }

    function updateTrafficChart(hourlyData) {
        const ctx = document.getElementById('trafficChart').getContext('2d');
        
        if (trafficChart) {
            trafficChart.destroy();
        }

        const hours = Object.keys(hourlyData);
        const visits = Object.values(hourlyData);

        trafficChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: hours,
                datasets: [{
                    label: 'Visits',
                    data: visits,
                    backgroundColor: 'rgba(59, 130, 246, 0.5)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            stepSize: 1
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.parsed.y} visit${context.parsed.y !== 1 ? 's' : ''}`;
                            }
                        }
                    }
                }
            }
        });
    }

    // First fetch
    fetchVisitorData();

    // Poll every 5 seconds
    setInterval(fetchVisitorData, 5000);
</script>