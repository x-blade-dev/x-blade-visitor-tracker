<div class="max-w-4xl p-4  mx-auto">
    <div class="bg-white p-4 mt-12 rounded-lg border border-gray-200 shadow-sm">
        <!-- Header -->
        <div class="flex justify-between items-start mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Visitor Analytics</h2>
                <p class="text-gray-500 text-sm">Real-time visitor tracking</p>
            </div>
            <div class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-sm font-medium">
                Live
            </div>
        </div>

        <!-- Stats Cards - 4 Columns -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <!-- Today's Visits -->
            <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-blue-600">Today's Visits</p>
                        <div class="flex items-baseline space-x-2">
                            <p id="visitorCount" class="text-3xl font-bold text-gray-800">0</p>
                            <span id="visitorTrend" class="text-sm flex items-center">
                                <span class="text-gray-400">Loading...</span>
                            </span>
                        </div>
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

            <!-- Page Views -->
            <div class="bg-amber-50 p-4 rounded-lg border border-amber-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-amber-600">Page Views</p>
                        <p id="pageViews" class="text-3xl font-bold text-gray-800">0</p>
                    </div>
                    <div class="bg-amber-100 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tempatkan di bagian bawah sebelum penutup div utama -->
        <div class="mt-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Visitor Trend (Last 7 Days)</h3>
            <div class="bg-white mt-4 p-2">
                <canvas id="visitorChart" height="300"></canvas>
            </div>
        </div>

        <!-- Visitor Details -->
        <div>
            <div class="flex justify-between mt-4 items-center mb-3">
                <h3 class="text-lg font-semibold text-gray-800">Recent Visitors (Last 10 IP's)</h3>
                <button id="toggleDetails" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                    <span>View Details</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>
            <div id="visitorDetails" class="hidden mt-4">
                <div class="max-h-[300px] overflow-y-auto">
                    <ul id="visitorList" class="space-y-3">
                        <li class="text-gray-500 py-2">Loading...</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Elements
    const elements = {
        count: document.getElementById('visitorCount'),
        trend: document.getElementById('visitorTrend'),
        unique: document.getElementById('uniqueVisitors'),
        active: document.getElementById('activeVisitors'),
        views: document.getElementById('pageViews'),
        list: document.getElementById('visitorList'),
        toggle: document.getElementById('toggleDetails'),
        details: document.getElementById('visitorDetails')
    };
    
    // State
    let prevCount = 0;
    let lastData = [];
    let visitorChart = null; // Chart instance

    // Improved browser detection
    const getBrowserInfo = (userAgent) => {
        if (!userAgent) return 'Unknown';
        if (userAgent.includes('Edg/')) return 'Edge';
        if (userAgent.includes('Opera') || userAgent.includes('OPR/')) return 'Opera';
        if (userAgent.includes('Chrome')) return 'Chrome';
        if (userAgent.includes('Firefox')) return 'Firefox';
        if (userAgent.includes('Safari')) return 'Safari';
        const match = userAgent.match(/([a-zA-Z]+)\/[0-9.]+/);
        return match ? match[1] : 'Unknown';
    };

    // Device detection
    const deviceType = agent => !agent ? 'Unknown' : 
        /mobile|android|iphone|ipad|ipod/i.test(agent) ? 'Mobile' :
        /tablet|ipad|kindle/i.test(agent) ? 'Tablet' : 'Desktop';
    
    // Time formatting
    const timeAgo = time => {
        if (!time) return 'Just now';
        const sec = Math.floor((new Date() - new Date(time)) / 1000);
        return sec < 60 ? 'Just now' : 
               sec < 3600 ? `${Math.floor(sec/60)}m ago` :
               sec < 86400 ? `${Math.floor(sec/3600)}h ago` : 
               `${Math.floor(sec/86400)}d ago`;
    };

    // Date formatter
    const formatEnglishDateTime = (dateString) => {
        try {
            const date = new Date(dateString);
            const timeStr = date.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });
            const dateStr = date.toLocaleDateString('en-US', {
                month: 'long',
                day: 'numeric',
                year: 'numeric'
            });
            return `${timeStr} / ${dateStr}`;
        } catch (e) {
            console.error('Error formatting date:', e);
            return dateString;
        }
    };

    // Prepare chart data
    const prepareChartData = (visitors) => {
        const visitsByDate = {};
        
        visitors.forEach(v => {
            const visitDate = new Date(v.time).toISOString().split('T')[0];
            visitsByDate[visitDate] = (visitsByDate[visitDate] || 0) + 1;
        });
        
        const dates = [];
        for (let i = 6; i >= 0; i--) {
            const date = new Date();
            date.setDate(date.getDate() - i);
            dates.push(date.toISOString().split('T')[0]);
        }
        
        return {
            labels: dates.map(date => {
                const d = new Date(date);
                return d.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
            }),
            datasets: [{
                label: 'Visitors',
                data: dates.map(date => visitsByDate[date] || 0),
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.3,
                fill: true,
                borderWidth: 2
            }]
        };
    };

    // Update or create chart
    const updateVisitorChart = (visitors) => {
        const ctx = document.getElementById('visitorChart').getContext('2d');
        const chartData = prepareChartData(visitors);
        
        if (visitorChart) {
            visitorChart.data = chartData;
            visitorChart.update();
        } else {
            visitorChart = new Chart(ctx, {
                type: 'line',
                data: chartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: (ctx) => `${ctx.parsed.y} visitors`
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0 }
                        }
                    }
                }
            });
        }
    };

    // Main update function
    // Perbaikan pada fungsi updateUI
    const updateUI = data => {
    let visitors = Array.isArray(data) ? data : data?.visitors || data?.data || [];
    
    // Update chart
    updateVisitorChart(visitors);
    
    // Hitung total kunjungan (termasuk duplikat IP)
    const totalVisits = visitors.length;
    
    // Filter unique IPs untuk menghitung unique visitors
    const uniqueIPs = new Map();
    visitors.forEach(v => {
        if (!uniqueIPs.has(v.ip) || new Date(v.time) > new Date(uniqueIPs.get(v.ip).time)) {
            uniqueIPs.set(v.ip, v);
        }
    });
    
    // Untuk active visitors, gunakan semua data (bukan hanya unique)
    const now = new Date();
    const activeVisitors = visitors.filter(v => {
        try {
            return (now - new Date(v.time)) < (5 * 60 * 1000);
        } catch (e) {
            return false;
        }
    }).length;

    // Update counts
    elements.count.textContent = totalVisits.toLocaleString(); // Total semua kunjungan
    elements.unique.textContent = uniqueIPs.size.toLocaleString(); // Unique IPs
    elements.active.textContent = activeVisitors.toLocaleString(); // Active dari semua kunjungan
    elements.views.textContent = totalVisits.toLocaleString(); // Sama dengan total kunjungan
    
    // Update trend
    elements.trend.innerHTML = prevCount ? 
        totalVisits > prevCount ? 
            `<span class="text-green-500">+${totalVisits-prevCount} ↑</span>` :
            totalVisits < prevCount ? 
            `<span class="text-red-500">${totalVisits-prevCount} ↓</span>` :
            `<span class="text-gray-500">0 →</span>` :
        `<span class="text-gray-400">New</span>`;
    prevCount = totalVisits;
    
    elements.list.innerHTML = visitors.length ? 
    // Urutkan dari yang terbaru (waktu descending)
    [...visitors].sort((a, b) => new Date(b.time) - new Date(a.time))
    // Ambil 10 teratas
    .slice(0, 10)
    // Map ke HTML
    .map(v => {
        const browser = getBrowserInfo(v.agent);
        return `
        <li class="group py-3 px-4 bg-gray-50 rounded-md">
            <div class="flex justify-between items-start gap-3">
                <div class="flex items-start space-x-3 min-w-0">
                    <div class="bg-blue-100 p-2 rounded-full mt-2">
                        <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="mx-4">
                        <p class="font-medium text-gray-800 truncate">${v.ip || 'N/A'}</p>
                        <div class="flex flex-wrap gap-x-4 gap-y-1 mt-1 text-sm">
                            <div class="flex items-center text-gray-600">
                                <span>${deviceType(v.agent)}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right min-w-[120px]">
                    <div class="inline-flex text-right px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        ${browser}
                    </div>
                    <div class="mt-1 ml-2 text-xs text-gray-500">${formatEnglishDateTime(v.time)}</div>
                </div>
            </div>
            <div class="mt-2 hidden group-hover:block">
                <p class="text-xs text-gray-500 p-3 bg-gray-50 rounded">${v.agent || 'No user agent'}</p>
            </div>
        </li>`;
    }).join('') : '<li class="text-gray-500 py-2">No visits today</li>';
    };

    // Fetch data
    const fetchData = async () => {
        try {
            const res = await fetch('/api/visitor-count');
            if (!res.ok) throw new Error(`Error ${res.status}`);
            updateUI(await res.json());
        } catch (err) {
            console.error('Fetch error:', err);
            elements.list.innerHTML = `<li class="text-red-500 py-2">Error: ${err.message}</li>`;
            ['count','unique','active','views'].forEach(id => elements[id].textContent = '0');
        }
    };
    
    // Initialize toggle button
    elements.toggle.addEventListener('click', () => {
        elements.details.classList.toggle('hidden');
        const icon = elements.toggle.querySelector('svg');
        icon.style.transform = elements.details.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
        elements.toggle.querySelector('span').textContent = elements.details.classList.contains('hidden') ? 'View Details' : 'Hide';
    });

    // Start polling
    fetchData();
    setInterval(fetchData, 5000);
</script>