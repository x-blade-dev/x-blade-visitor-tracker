<div class="bg-white p-4 rounded shadow">
    <h2 class="text-lg font-bold mb-2">Visitor Log</h2>
    <ul class="text-sm">
        @foreach ($visitors as $visitor)
            <li>
                {{ $visitor['ip'] }} - {{ $visitor['agent'] }} ({{ $visitor['time'] }})
            </li>
        @endforeach
    </ul>
</div>
