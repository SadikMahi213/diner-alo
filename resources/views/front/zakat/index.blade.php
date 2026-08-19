<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>যাকাত 계산ATOR - দিনের আলো</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Noto Sans Bengali', 'Noto Sans', sans-serif !important; }
        .zakat-result { border-top: 3px solid #22c55e; }
    </style>
</head>
<body class="bg-bg font-bg">

    <!-- Zakat Calculator Header -->
    <section class="py-16 bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-emerald-400 mb-4 bengali">
                    যাকাত 계산ATOR
                </h2>
                <p class="text-gray-400 text-lg mb-8 bengali">
                    ধারম erklär: যাকাত islāmের পাঁচ প sondhার একটি viktig অংশ। উদাহরণস্বরূপ, আপনার সম্পত্তি অতিরিক্ত Tk 42,240 (নসাব)ের上限 surpass করে, তবে ২.৫% donor হিসেবে দিতে হবে।
                </p>
            </div>
        </div>
    </section>

    <!-- Zakat Calculator Form -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto">
                <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100 hover-transition">
                    <h3 class="text-2xl font-bold text-emerald-600 mb-6 bengoli>Zakat 계산</h3>
                    
                    <form id="zakatForm">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 bengoli>Cash in Hand</label>
                                <input type="number" name="cash" id="cash"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors"
                                    placeholder="0">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 bengoli>Bank Balance</label>
                                <input type="number" name="bank_balance" id="bank_balance"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors"
                                    placeholder="0">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 bengoli">Gold (gram)</label>
                                <input type="number" name="gold" id="gold"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors"
                                    placeholder="0">
                                <p class="text-xs text-gray-500 bengoli>Current gold rate: ~৳7,500/gram (approx)</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 bengoli">Silver (gram)</label>
                                <input type="number" name="silver" id="silver"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors"
                                    placeholder="0">
                                <p class="text-xs text-gray-500 bengoli>Current silver rate: ~৳90/gram (approx)</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 bengoli">Investments</label>
                                <input type="number" name="investments" id="investments"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors"
                                    placeholder="0">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 bengoli">Business Inventory</label>
                                <input type="number" name="business" id="business"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors"
                                    placeholder="0">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 bengoli">Receivables</label>
                                <input type="number" name="receivables" id="receivables"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors"
                                    placeholder="0">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 bengoli">Liabilities</label>
                                <input type="number" name="liabilities" id="liabilities"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors"
                                    placeholder="0">
                                <p class="text-xs text-gray-500 mt-1 bengoli>(Deduct from total)</p>
                            </div>
                        </div>
                        
                        <div class="pt-6 border-t border-gray-200">
                            <button type="submit"
                                class="w-full py-4 px-8 bg-emerald text-white font-medium rounded-full hover:bg-emerald-dark transition-colors text-lg">
                                계산
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Zakat Result -->
    <section id="zakatResult" class="py-16 bg-gray-50 hidden">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto">
                <div class="zakat-result bg-emerald-50 rounded-2xl p-8 border-l-4 border-emerald-500">
                    <h3 class="text-2xl font-bold text-emerald-600 mb-4 bengoli>Zakat Ergebnis</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <p class="text-gray-500 text-sm bengoli>Total Assets</p>
                            <p class="text-2xl font-bold" id="totalAssets">0</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm bengoli>Total Liabilities</p>
                            <p class="text-2xl font-bold" id="totalLiabilities">0</p>
                        </div>
                    </div>
                    
                    <div class="bg-emerald-100 rounded-lg p-6">
                        <p class="text-emerald-600 font-medium mb-2 bengoli>Nisab (Threshold)</p>
                        <p class="text-gray-600 text-sm" id="nisabValue">৳42,240</p>
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-emerald-200">
                        <p class="text-emerald-600 font-large mb-2 bengoli>Zakat Amount</p>
                        <p class="text-4xl font-bold text-emerald-600" id="zakatAmount">0</p>
                        <p class="text-gray-500 text-sm bengoli>2.5% of your total assets above the nisab threshold</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Zakat Calculator
        document.getElementById('zakatForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form values
            const cash = parseFloat(document.getElementById('cash')?.value) || 0;
            const bankBalance = parseFloat(document.getElementById('bank_balance')?.value) || 0;
            const gold = parseFloat(document.getElementById('gold')?.value) || 0;
            const silver = parseFloat(document.getElementById('silver')?.value) || 0;
            const investments = parseFloat(document.getElementById('investments')?.value) || 0;
            const business = parseFloat(document.getElementById('business')?.value) || 0;
            const receivables = parseFloat(document.getElementById('receivables')?.value) || 0;
            const liabilities = parseFloat(document.getElementById('liabilities')?.value) || 0;
            
            // Current market rates (approx)
            const goldRate = 7500; // BDT per gram
            const silverRate = 90; // BDT per gram
            const nisabCash = 42240; // Approximate nisab threshold in BDT
            
            // Calculate total assets
            const totalAssets = cash + bankBalance + (gold * goldRate) + (silver * silverRate) + investments + business + receivables;
            const totalLiabilities = liabilities;
            const netAssets = totalAssets - totalLiabilities;
            
            // Display results
            document.getElementById('totalAssets')?.textContent 
                ? Number(totalAssets).toLocaleString() 
                : document.getElementById('totalAssets').textContent = Number(totalAssets).toLocaleString();
            
            document.getElementById('totalLiabilities')?.textContent 
                ? Number(totalLiabilities).toLocaleString() 
                : document.getElementById('totalLiabilities').textContent = Number(totalLiabilities).toLocaleString();
            
            document.getElementById('nisabValue')?.textContent = '৳' + nisabCash.toLocaleString();
            
            // Calculate zakat
            let zakatAmount = 0;
            if (netAssets > nisabCash) {
                zakatAmount = netAssets * 0.025;
            }
            
            document.getElementById('zakatAmount')?.textContent 
                ? '৳' + zakatAmount.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})
                : document.getElementById('zakatAmount').textContent = '৳' + zakatAmount.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
            
            // Show result section
            document.getElementById('zakatResult')?.classList.remove('hidden');
        });
    </script>

</body>
</html>