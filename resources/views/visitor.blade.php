<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Log</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Visitor Log</h1>
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 p-2">IP Address</th>
                    <th class="border border-gray-300 p-2">User Agent</th>
                    <th class="border border-gray-300 p-2">Visited At</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($visitors as $visitor)
                    <tr class="border border-gray-300">
                        <td class="border border-gray-300 p-2">{{ $visitor['ip'] }}</td>
                        <td class="border border-gray-300 p-2">{{ $visitor['agent'] }}</td>
                        <td class="border border-gray-300 p-2">{{ $visitor['time'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center p-4">No visitors yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
