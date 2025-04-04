<div class="p-4 bg-white shadow rounded-md">
    <h3 class="text-lg font-semibold mb-3">Visitor Logs</h3>
    <ul>
        @foreach ($visitors as $visitor)
            <li class="text-sm text-gray-600">
                <strong>IP:</strong> {{ $visitor['ip'] ?? 'Unknown' }} 
                - <strong>Time:</strong> {{ $visitor['time'] ?? 'N/A' }}
            </li>
        @endforeach
    </ul>
</div>
