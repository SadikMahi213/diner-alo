<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>লগইন - দিনের আলো</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Noto Sans Bengali', sans-serif !important; }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg w-96">
            <h2 class="text-2xl font-bold text-center bengali mb-6">অ্যাডমিন লগইন</h2>
            <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1 bengali">ইমেল</label>
                    <input type="email" name="email" required
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-emerald-500"
                        placeholder="admin@saifacademy.com">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1 bengali">পাসওয়ার্ড</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-emerald-500"
                        placeholder="password">
                </div>
                <button type="submit"
                    class="w-full bg-emerald-600 text-white py-2 rounded hover:bg-emerald-700 transition">
                    লগইন করুন
                </button>
            </form>
        </div>
    </div>
</body>
</html>
