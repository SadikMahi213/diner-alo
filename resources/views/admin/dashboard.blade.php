<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diners Alo Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Noto Sans Bengali', 'Noto Sans', sans-serif !important; }
        :root {
            --bg: #f8f9fa;
            --fg: #1a1a2e;
            --emerald: #22c55e;
            --emerald-dark: #16a34a;
            --gold: #f59e0b;
            --gold-dark: #d97706;
        }
    </style>
</head>
<body class="bg-bg font-bg">
    
    <!-- Header -->
    <header class="bg-gray-900 text-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <h1 class="text-xl font-bold text-emerald-400">Diners Alo</h1>
                <div class="hidden md:flex items-center space-x-4">
                    <span class="text-gray-300">হ্যালো, {{ Auth::user()->name }}</span>
                    <a href="{{ route('logout') }}" class="text-red-400 hover:text-red-300 transition-colors text-sm">
                        লগআউ�
                    </a>
                </div>
            </div>
            <nav class="hidden md:block">
                <ul class="flex space-x-6">
                    <li><a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-300">ড্যাশবোর্ড</a></li>
                    <li><a href="{{ route('admin.packages') }}" class="hover:text-emerald-300">প্রোগ্রাম</a></li>
                    <li><a href="{{ route('admin.donations') }}" class="hover:text-emerald-300">দানের হিসাব</a></li>
                    <li><a href="#" class="hover:text-emerald-300">প্রশাসক-panel</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                
                <!-- Key Stats Cards -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 hover-transition">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2v6m-4-2v-6l-4-2v-6m4 2v6m-4-2v-6L12 3v6l-4 2v6M5 11h14m0 0v3a4 4 0 004 4h3a4 4 0 014 4v3m-8-3v12a2 2 0 002 2h2a2 2 0 002-2v-5m-12-2v5"></path></svg>
                            </div>
                            <div class="ml-5 flex-1 min-w-0">
                                <p class="text-emerald-500 text-3xl font-bold" id="total-donations">Loading...</p>
                                <p class="text-gray-500 text-sm">Total Donations</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 hover-transition">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gold-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2v6m-4-2v-6l-4-2v-6m4 2v6m-4-2v-6L12 3v6l-4 2v6M5 11h14m0 0v3a4 4 0 004 4h3a4 4 0 014 4v3m-8-3v12a2 2 0 002 2h2a2 2 0 002-2v-5m-12-2v5"></path></svg>
                            </div>
                            <div class="ml-5 flex-1 min-w-0">
                                <p class="text-gold-500 text-3xl font-bold" id="today-donations">Loading...</p>
                                <p class="text-gray-500 text-sm">Today's Donations</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 hover-transition">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                            </div>
                            <div class="ml-5 flex-1 min-w-0">
                                <p class="text-emerald-500 text-3xl font-bold" id="successful-transactions">Loading...</p>
                                <p class="text-gray-500 text-sm">Successful Transactions</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 hover-transition">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gold-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h1v4h-1m0 0h1m-1-4h1v4h-1m1 8V7a1 1 0 00-1-1h-4a1 1 0 00-1 1v4m0 0h1m-1 0l-3 3m-3-3l3 3m0 0l3-3m-3 3l3-3m0 0V7a1 1 0 011-1h2a1 1 0 011 1v4m0-3h4a1 1 0 011 1v1a1 1 0 11-2 0v-1m-4-4h4"></path></svg>
                            </div>
                            <div class="ml-5 flex-1 min-w-0">
                                <p class="text-gold-500 text-3xl font-bold" id="active-projects">Loading...</p>
                                <p class="text-gray-500 text-sm">Active Projects</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="lg:col-span-1 space-y-4">
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 hover-transition">
                        <h2 class="text-lg font-bold text-emerald-600 mb-4 bengali">Monthly Trend</h2>
                        <div class="h-64 bg-gray-50 rounded-xl p-6" id="monthly-chart">Loading chart...</div>
                    </div>
                    
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 hover-transition">
                        <h2 class="text-lg font-bold text-gold-600 mb-4 bengali">Status Distribution</h2>
                        <div class="h-64 bg-gray-50 rounded-xl p-6" id="status-chart">Loading chart...</div>
                    </div>
                </div>
            </div>
            
            <!-- Recent Activity Section -->
            <div class="bg-white rounded-2xl p-6 border border-gray-100 hover-transition mb-8">
                <h2 class="text-lg font-bold text-emerald-600 mb-4 bengoli>Latest Donations</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Donor</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="latest-donations-table">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-500 text-sm" colspan="6">Loading donations...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-8">
                <a href="{{ route('admin.donations') }}" class="bg-emerald text-white px-6 py-4 rounded-lg font-medium hover:bg-emerald-dark transition-colors">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2v6m-4-2v-6l-4-2v-6m4 2v6m-4-2v-6L12 3v6l-4 2v6M5 11h14m0 0v3a4 4 0 004 4h3a4 4 0 014 4v3m-8-3v12a2 2 0 002 2h2a2 2 0 002-2v-5m-12-2v5"></path></svg>
                    Donation Management
                </a>
                <a href="#" class="bg-gold text-white px-6 py-4 rounded-lg font-medium hover:bg-gold-dark transition-colors">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2v6m-4-2v-6l-4-2v-6m4 2v6m-4-2v-6L12 3v6l-4 2v6M5 11h14m0 0v3a4 4 0 004 4h3a4 4 0 014 4v3m-8-3v12a2 2 0 002 2h2a2 2 0 002-2v-5m-12-2v5"></path></svg>
                    Project Management
                </a>
                <a href="#" class="bg-emerald-600 text-white px-6 py-4 rounded-lg font-medium hover-emerald-500 transition-colors">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h1v4h-1m0 0h1m-1-4h1v4h-1m1 8V7a1 1 0 00-1-1h-4a1 1 0 00-1 1v4m0 0h1m-1 0l-3 3m-3-3l3 3m0 0l3-3m-3 3l3-3m0 0V7a1 1 0 011-1h2a1 1 0 011 1v4m0-3h4a1 1 0 011 1v1a1 1 0 11-2 0v-1m-4-4h4"></path></svg>
                    Volunteers
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="text-center text-gray-400 text-sm bengali">
                &copy; 2026 Diners Alo. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        // Initialize dashboard data
        document.addEventListener('DOMContentLoaded', function() {
            loadDashboardStats();
            loadLatestDonations();
        });
        
        function loadDashboardStats() {
            fetch('/admin/statistics')
                .then(response => response.json())
                .then(data => {
                    // Update stats
                    document.getElementById('total-donations').textContent = data.total_funds?.general || '0';
                    document.getElementById('today-donations').textContent = '0'; // Would need separate endpoint
                    document.getElementById('successful-transactions').textContent = '0'; // Would need separate endpoint
                    document.getElementById('active-projects').textContent = '0'; // Would need separate endpoint
                    
                    // Update charts - placeholder for now
                    console.log('Statistics data:', data);
                })
                .catch(error => console.error('Error loading statistics:', error));
        }
        
        function loadLatestDonations() {
            fetch('/admin/donations')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('latest-donations-table');
                    if (data && data.length > 0) {
                        tbody.innerHTML = data.map(donation => `
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-emerald-600 font-medium">
                                    ${donation.transaction_id}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-500 text-sm">
                                    ${donation.donor_name || 'Unknown'}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-500 text-right">
                                    ৳${Number(donation.amount).toLocaleString()}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${donation.status === 'successful' ? 'bg-green-100 text-green-800' : donation.status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800'}">
                                        ${donation.status}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-500 text-sm">
                                    ${donation.created_at ? donation.created_at.format('MMM D, Y') : 'N/A'}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="#" class="text-emerald-400 hover-text-emerald-300 transition-colors text-sm">Details</a>
                                </td>
                            </tr>
                        `).join('');
                    } else {
                        tbody.innerHTML = `<tr><td class="px-6 py-4 whitespace-nowrap text-gray-500 text-sm" colspan="6">No donations found</td></tr>`;
                    }
                })
                .catch(error => {
                    console.error('Error loading donations:', error);
                    document.getElementById('latest-donations-table').innerHTML = '<tr><td class="px-6 py-4 whitespace-nowrap text-gray-500 text-sm" colspan="6">Error loading data</td></tr>';
                });
        }
    </script>
</body>
</html>