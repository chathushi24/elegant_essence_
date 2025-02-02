<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-72 bg-black text-white p-6 flex flex-col">
            <h2 class="text-3xl font-extrabold mb-6 text-white">Admin Panel</h2>
            <nav class="flex-1">
                <ul>
                    <li class="mb-4">
                        <a href="{{ route('admin.products.index') }}" class="block p-4 rounded-lg bg-pink-700 hover:bg-pink-600 transition-all duration-300 shadow-md">Manage Products</a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ route('admin.orders.index') }}" class="block p-3 rounded-md bg-blue-600 hover:bg-blue-500 transition">
                            Orders
                        </a>
                    </li>
                </ul>
            </nav>
            <form action="{{ route('admin.logout') }}" method="POST" class="mt-auto">
                @csrf
                <button type="submit" class="w-full p-4 rounded-lg bg-pink-600 hover:bg-red-700 transition-all duration-300 shadow-md">Logout</button>
            </form>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-12 bg-white shadow-2xl rounded-lg border border-gray-200">
            @yield('content')
        </main>
    </div>

</body>
</html>
