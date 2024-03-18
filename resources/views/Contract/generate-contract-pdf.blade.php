@php use Carbon\Carbon; @endphp
<body class="bg-gray-100">
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4">Contract Information</h1>
    <div class="bg-white shadow-md rounded-lg p-4 mb-4">
        <p class="text-gray-700"><strong>Current
                Date:</strong> {{ Carbon::parse($contractInformation['Current date'] ?? '')->format('d-m-Y') }}</p>
        <p class="text-gray-700"><strong>Name:</strong> {{ $contractInformation['Name'] ?? 'N/A' }}</p>
        <p class="text-gray-700"><strong>Email:</strong> {{ $contractInformation['Email'] ?? 'N/A' }}</p>
        <p class="text-gray-700"><strong>Created
                At:</strong> {{ Carbon::parse($contractInformation['Created at'] ?? '')->format('d-m-Y') }}</p>
    </div>
</div>
</body>
