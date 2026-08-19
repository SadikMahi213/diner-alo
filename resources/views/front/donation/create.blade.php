<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>দান করুন - দিনের আলো</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Noto Sans Bengali', 'Noto Sans', sans-serif !important; }
    </style>
</head>
<body class="bg-bg font-bg">
    
    <!-- Donation Form Header -->
    <section class="py-16 bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-emerald-400 mb-4 bengali">
                    দান করুন
                </h2>
                <p class="text-gray-400 text-lg mb-8 max-w-2xl mx-auto bengali">
                    আপনার értékপূর্ণ অনুদানের মাধ্যমে হস্তঅভಿವাদীদের জীবন পরিবর্তন করুন।
                </p>
            </div>
        </div>
    </section>

    <!-- Donation Form -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto">
                <form action="{{ route('donation.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Donor Information -->
                    <div>
                        <h3 class="text-lg font-medium text-emerald-600 mb-4 bengoli>দনকারী তথ্য</h3>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 bengali">Full Name</label>
                                <input type="text" name="name" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors"
                                    placeholder="আপনার পূর্ণ নাম">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 bengali">Mobile Number</label>
                                <input type="tel" name="mobile_number" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors"
                                    placeholder="+৮৮০ ১৭১২৩৪৫৬৭৮">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 bengali">Email Address</label>
                            <input type="email" name="email" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors"
                                placeholder="আইমেইল@এড্রেস.কম">
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 bengali">Anonymous Donation</label>
                                <div class="space-y-2">
                                    <label class="flex items-center px-4 py-2 border rounded-lg hover:border-emerald-300 cursor-pointer">
                                        <input type="radio" name="is_anonymous" value="1"
                                            class="w-4 h-4 rounded border-emerald-600 accent-emerald-600">
                                        <span>হ্যাঁ, আমি গোপন রাখতে চাই</span>
                                    </label>
                                    <label class="flex items-center px-4 py-2 border rounded-lg hover:border-emerald-300 cursor-pointer">
                                        <input type="radio" name="is_anonymous" value="0" checked
                                            class="w-4 h-4 rounded border-gray-600">
                                        <span>না, আমার নাম প্রকাশ করুন</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Donation Details -->
                    <div>
                        <h3 class="text-lg font-medium text-emerald-600 mb-4 bengoli>দানের বিবরণ</h3>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 bengali>Donation Amount</label>
                                <div class="space-y-2">
                                    <button type="button" class="w-full py-3 px-4 bg-white text-emerald-600 font-medium rounded-full hover:bg-emerald-100 transition-colors text-sm">
                                        ৳500
                                    </button>
                                    <button type="button" class="w-full py-3 px-4 bg-white text-emerald-600 font-medium rounded-full hover:bg-emerald-100 transition-colors text-sm">
                                        ৳1,000
                                    </button>
                                    <button type="button" class="w-full py-3 px-4 bg-white text-emerald-600 font-medium rounded-full hover:bg-emerald-100 transition-colors text-sm">
                                        ৳2,500
                                    </button>
                                    <button type="button" class="w-full py-3 px-4 bg-white text-emerald-600 font-medium rounded-full hover:bg-emerald-100 transition-colors text-sm">
                                        ৳5,000
                                    </button>
                                    <button type="button" class="w-full py-3 px-4 bg-white text-emerald-600 font-medium rounded-full hover:bg-emerald-100 transition-colors text-sm">
                                        ৳10,000
                                    </button>
                                    <input type="number" name="amount" min="100"
                                        class="w-full py-3 px-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors text-right"
                                        placeholder="Custom amount (৳)">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 bengali>Donation Category</label>
                                <select name="donation_fund_id"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors appearance-none">
                                    <option value="">Category selection...</option>
                                    <?php
                                    $funds = [
                                        ['id' => null, 'name_bn' => 'সাধারণ তহবিল', 'name_en' => 'General Tithe'],
                                        ['id' => null, 'name_bn' => 'শিক্ষা', 'name_en' => 'Education'],
                                        ['id' => null, 'name_bn' => 'খাদ্য', 'name_en' => 'Food'],
                                        ['id' => null, 'name_bn' => 'চিকিৎসা', 'name_en' => 'Healthcare'],
                                        ['id' => null, 'name_bn' => 'জরুরি ত্রাণ', 'name_en' => 'Emergency Relief'],
                                        ['id' => null, 'name_bn' => 'যাকাত', 'name_en' => 'Zakat'],
                                        ['id' => null, 'name_bn' => 'সদকা', 'name_en' => 'Sadaqah'],
                                        ['id' => null, 'name_bn' => 'প্রজেক্ট-ভিত্তিক দান', 'name_en' => 'Project-based Donation'],
                                    ];
                                    foreach ($funds as $fund): ?>
                                        <option value="<?= $fund['id'] ?>" 
                                            <?= ($donation && $donation->donation_fund_id == $fund['id']) ? 'selected' : '' ?>>
                                            <?= $fund['name_bn'] ?> / <?= $fund['name_en'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Project Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 bengali>Select Project (Optional)</label>
                            <select name="project_id"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors appearance-none">
                                <option value="">Select a project...</option>
                                <?php foreach ($projects as $project): ?>
                                    <option value="<?= $project->id ?>">
                                        <?= $project->title ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <!-- Donor Message -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 bengali">Message (Optional)</label>
                            <textarea name="message" rows="3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors resize-none bengali"
                                placeholder="আপনার বার্তা বা dedicó here"></textarea>
                        </div>
                    </div>
                    
                    <!-- Payment Method -->
                    <div>
                        <h3 class="text-lg font-medium text-emerald-600 mb-4 bengoli>পেমেন্ট মেথড</h3>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 bengali">bKash</label>
                                <div class="px-4 py-3 border border-emerald-200 rounded-lg bg-emerald-50">
                                    <p class="text-emerald-600 font-medium">Mobile: 01712345678</p>
                                    <p class="text-gray-500 text-sm">Scan or send money to the number above</p>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 bengali">Nagad</label>
                                <div class="px-4 py-3 border border-gold-200 rounded-lg bg-gold-50">
                                    <p class="text-gold-600 font-medium">Mobile: 01712345678</p>
                                    <p class="text-gray-500 text-sm">Send money via Nagad</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 bengali">Card</label>
                                <div class="px-4 py-3 border rounded-lg bg-white shadow-sm">
                                    <div class="grid grid-cols-2 gap-2">
                                        <input type="text" placeholder="Card Number" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                        <input type="text" placeholder="MM/YY" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                    </div>
                                    <div class="grid grid-cols-3 gap-2 mt-2">
                                        <input type="text" placeholder="CVV" class="w-20 px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                        <input type="text" placeholder="Amount" class="w-32 px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                        <select class="px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                            <option>Expiry</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 bengali">Bank Transfer</label>
                                <div class="px-4 py-3 border rounded-lg bg-white shadow-sm">
                                    <p class="text-gray-600 text-sm">Account:Dummy Account Number</p>
                                    <p class="text-gray-600 text-sm">Bank:Dummy Bank Name</p>
                                    <p class="text-gray-600 text-sm">Branch:Dummy Branch</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <button type="submit"
                                class="w-full py-4 px-8 bg-emerald text-white font-medium rounded-full hover:bg-emerald-dark transition-colors text-lg">
                                পেমেন্ট পোর্টালে যাওয়
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Thank You Section -->
    <section class="py-16 bg-emerald-50">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto text-center">
                <div class="w-20 h-20 mx-auto bg-emerald-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2v6m-4-2v-6l-4-2v-6m4 2v6m-4-2v-6L12 3v6l-4 2v6M5 11h14m0 0v3a4 4 0 004 4h3a4 4 0 014 4v3m-8-3v12a2 2 0 002 2h2a2 2 0 002-2v-5m-12-2v5"></path></svg>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-emerald-600 mb-4 bengali">
                    ধন্যবাদ!
                </h2>
                <p class="text-gray-400 text-lg mb-6 bengali">
                    আপনার দানের জন্য গ্রামীণ অসাধন পায়ের lifestyle in rural areas।
                </p>
                <p class="text-gray-500 text-sm bengali">
                    আপনার_transaction_id: DA-2026-00001
                </p>
                <a href="{{ route('home') }}"
                    class="bg-white text-emerald-600 px-6 py-3 rounded-full font-medium hover:bg-emerald-100 transition-colors text-lg">
                   _home_going
                </a>
            </div>
        </div>
    </section>
</body>
</html>