<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>সংসদ সদস্য রেজিস্ট্রেশন - দিনের আলো</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Noto Sans Bengali', 'Noto Sans', sans-serif !important; }
    </style>
</head>
<body class="bg-bg font-bg">

    <!-- Membership Form Header -->
    <section class="py-16 bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-emerald-400 mb-4 bengali">
                    membership
                </h2>
                <p class="text-gray-400 text-lg mb-8 max-w-2xl mx-auto bengali">
                    আমাদের সংস্থায় সদস্য হন এবং সহায়তার})^{} part of our mission.
                </p>
            </div>
        </div>
    </section>

    <!-- Membership Form -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto">
                <form action="{{ route('membership.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <h3 class="text-lg font-medium text-emerald-600 mb-4 bengoli> ব্যক্তিগত তথ্য</h3>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 bengoli">Full Name</label>
                                <input type="text" name="name" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors"
                                    placeholder="আপনার পূর্ণ নাম">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 bengoli">Mobile Number</label>
                                <input type="tel" name="phone" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors"
                                    placeholder="+৮৮০ ১৭১২৩৪৫৬৭৮">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 bengoli">Email Address</label>
                            <input type="email" name="email" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors"
                                placeholder="আইমেইল@এড্রেস.কম">
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 bengoli">District</label>
                                <select name="district"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors appearance-none">
                                    <option value="">Select district...</option>
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Chittagong">Chittagong</option>
                                    <option value="Rajshahi">Rajshahi</option>
                                    <option value="Khulna">Khulna</option>
                                    <option value="Barisal">Barisal</option>
                                    <option value="Sylhet">Sylhet</option>
                                    <option value="Rangpur">Rangpur</option>
                                    <option value="Mymensingh">Mymensingh</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 bengoli">Profession</label>
                                <input type="text" name="profession"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors"
                                    placeholder="পেশা বা Occupation">
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-medium text-emerald-600 mb-4 bengoli> সদস্য.type</h3>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block p-3 border border-emerald-200 rounded-lg cursor-pointer hover:border-emerald-300 transition-colors">
                                    <input type="radio" name="membership_type" value="general"
                                        class="w-4 h-4 rounded border-emerald-600 accent-emerald-600 cursor-pointer bg-white">
                                    <div>
                                        <h4 class="font-medium text-emerald-600 bengoli">সাধারণ সদস্য</h4>
                                        <p class="text-gray-500 text-sm">বছরগতdues renewal every year</p>
                                    </div>
                                </label>
                            </div>
                            <div>
                                <label class="block p-3 border border-gold-200 rounded-lg cursor-pointer hover:border-gold-300 transition-colors">
                                    <input type="radio" name="membership_type" value="lifetime"
                                        class="w-4 h-4 rounded border-gold-600 accent-gold-600 cursor-pointer bg-white">
                                    <div>
                                        <h4 class="font-medium text-gold-600 bengoli">আজীবন সদস্য</h4>
                                        <p class="text-gray-500 text-sm">একবারbd renewal once lifetime</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <label class="block p-3 border border-emerald-200 rounded-lg cursor-pointer hover:border-emerald-300 transition-colors">
                                <input type="radio" name="membership_type" value="contributor"
                                    class="w-4 h-4 rounded border-emerald-600 accent-emerald-600 cursor-pointer bg-white">
                                <div>
                                    <h4 class="font-medium text-emerald-600 bengoli">সহযোগী সদস্য</h4>
                                    <p class="text-gray-500 text-sm">Special contribution member</p>
                                </div>
                            </div>
                            <div>
                                <label class="block p-3 border border-emerald-200 rounded-lg cursor-pointer hover:border-emerald-300 transition-colors">
                                    <input type="radio" name="membership_type" value="volunteer"
                                        class="w-4 h-4 rounded border-emerald-600 accent-emerald-600 cursor-pointer bg-white">
                                    <div>
                                        <h4 class="font-medium text-emerald-600 bengoli">স্বেচ্ছাসেবক</h4>
                                        <p class="text-gray-500 text-sm">Volunteer member</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-medium text-emerald-600 mb-4 bengoli>past experience (Optional)</h3>
                        <textarea name="experience" rows="3"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors resize-none bengali"
                            placeholder=" applicable volunteer experience বা past membership"></textarea>
                    </div>
                    
                    <div class="pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-emerald-600 mb-4 bengoli>আবেদন শেষihar</h3>
                        <p class="text-gray-500 text-sm mb-6 bengoli">
                            আপনার আবেদন review জন্য submitted হবে। Our team will process your application within 5-7 business days and notify you of the status.
                        </p>
                        <button type="submit"
                            class="w-full py-4 px-8 bg-emerald text-white font-medium rounded-full hover:bg-emerald-dark transition-colors text-lg">
                            আবেদন পাঠান
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Thank You Section -->
    @if(!empty($member))
    <section class="py-16 bg-emerald-50">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto text-center">
                <div class="w-16 h-16 mx-auto bg-emerald-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-emerald-600 mb-4 bengali">
                    আবেদন vastaan
                </h2>
                <p class="text-gray-400 text-lg mb-6 bengali">
                    আপনার membership application সফলভাবে জমা হয়েছে। আপনার আবেদন প্রক্রিয়াবদ্ধ হবে এবং ৫-৭ কাজের দিনের মধ্যে notifications despatched হবে।
                </p>
                <p class="text-gray-500 text-sm bengali">
                    আপনার membership ID: {{ $member->member_id ?? '' }}
                </p>
                <a href="#!"
                    class="bg-emerald text-white px-6 py-3 rounded-full font-medium hover:bg-emerald-dark transition-colors text-lg">
                    হোমপেজে ফিরুন
                </a>
            </div>
        </div>
    </section>
    @endif

</body>
</html>