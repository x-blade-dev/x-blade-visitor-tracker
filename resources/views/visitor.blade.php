<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4">📊 Visitor Log</h2>

    <!-- Kotak jumlah kunjungan hari ini -->
    <div class="flex items-center justify-between bg-blue-500 text-white p-4 rounded-lg shadow-md">
        <div>
            <p class="text-sm">Total Kunjungan Hari Ini</p>
            <p class="text-3xl font-bold">{{ count($visitors) }}</p>
        </div>
        <button id="toggleDetails" class="bg-white text-blue-500 px-4 py-2 rounded-lg shadow-md hover:bg-gray-200 transition">
            Lihat Detail
        </button>
    </div>

    <!-- Detail kunjungan -->
    <div id="visitorDetails" class="hidden mt-4">
        <h3 class="text-lg font-semibold mb-2">📌 Detail Kunjungan</h3>
        <ul class="bg-gray-100 p-4 rounded-lg text-sm">
            @forelse ($visitors as $visitor)
                <li class="py-2 border-b border-gray-300">
                    <strong>IP:</strong> {{ $visitor['ip'] }}  
                    <br><strong>Perangkat:</strong> {{ $visitor['agent'] }}  
                    <br><strong>Waktu:</strong> {{ $visitor['time'] }}
                </li>
            @empty
                <li class="text-gray-500">Belum ada kunjungan hari ini.</li>
            @endforelse
        </ul>
    </div>
</div>

<!-- Tambahkan Script untuk Toggle Detail -->
<script>
    document.getElementById('toggleDetails').addEventListener('click', function() {
        const details = document.getElementById('visitorDetails');
        details.classList.toggle('hidden');
    });
</script>
