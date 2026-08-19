<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>স্বেচ্ছাসেবক রেজিস্ট্রেশন - দিনের আলো</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Noto Sans Bengali', 'Noto Sans', sans-serif !important; }
    </style>
</head>
<body class="bg-bg font-bg">

    <!-- Volunteer Form Header -->
    <section class="py-16 bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-emerald-400 mb-4 bengali">
                    স্বেচ্ছাসেবক হোন
                </h2>
                <p class="text-gray-400 text-lg mb-8 max-w-2xl mx-auto bengali">
                    আমাদের মানব utvikকয়ারিতা কার্যক্রমে অংশ হিসেবে Bengals volunteers needed।
                </p>
            </div>
        </div>
    </section>

    <!-- Volunteer Form -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto">
                <form action="{{ route('volunteer.store') }}" method="POST" class="space-y-6">
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
                                    placeholder="পেশাগত স деятельности">
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-medium text-emerald-600 mb-4 bengoli> készতা ও ন willingness</h3>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 bengoli">Skills</label>
                                <textarea name="skills" rows="3"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors resize-none bengali"
                                    placeholder="আপনার 기술 এবং যোগ্যতা (যেমন: ক্যাকিং, শিক্ষা, মেডিকেল ইত্যাদি)"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 bengoli">Availability</label>
                                <select name="availability"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors appearance-none">
                                    <option value="">Select availability...</option>
                                    <option value="weekends">Weekends فقط</option>
                                    <option value="weekdays">Weekdaysのみ</option>
                                    <option value="flexible">Flexible</option>
                                    <option value="full_time">Full-time</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 bengoli">Preferred Activity</label>
                                <select name="preferred_activity"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors appearance-none">
                                    <option value="">Select preferred activity...</option>
                                    <option value="education">শিক্ষা</option>
                                    <option value="medical">চিকিৎসা</option>
                                    <option value="food">খাদ্য ও सहায়তা</option>
                                    <option value="relief">রিলিফ ও ত্রাণ</option>
                                    <option value="events">ঘটনা ও সমাবেশ</option>
                                    <option value="administrative">আইনামিতি/ প্রশাসনিক</option>
                                    <option value="other">অন্যান্য</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 bengoli">Experience</label>
                                <textarea name="experience" rows="3"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors resize-none bengali"
                                    placeholder="পrior volunteer experience বা related experience描述"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-emerald-600 mb-4 bengoli>আবেদন শেষihar</h3>
                        <p class="text-gray-500 text-sm mb-6 bengoli>
                            আপনার আবেদন reçev되고 প্রশাসন হতে হবে review। আমাদেরチーム will contact you within 3-5 business days.
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
    <section class="py-16 bg-emerald-50">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto text-center">
                <div class="w-16 h-16 mx-auto bg-emerald-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-emerald-600 mb-4 bengali">
                    ধন্যবাদ!
                </h2>
                <p class="text-gray-400 text-lg mb-6 bengali">
                    আমাদের টিম আপনার আবেদন পর্যালোচনা করবে এবং ৩-৫ কাজের দিনের মধ্যে আপনার সাথে যোগাযোগ করবে।
                </p>
                <p class="text-gray-500 text-sm bengali">
                    আপনার আবেদন আইডি: VOL-{{ date('Y') }}-{{ str_pad(random_int(1, 9999), 4, '0', STR_PAD_LEFT) }}
                </p>
                <a href="#!"
                    class="bg-emerald text-white px-6 py-3 rounded-full font-medium hover:bg-emerald-dark transition-colors text-lg">
                    হোমপেজে ফিরুন
                </a>
            </div>
        </div>
    </section>

</body>
</html>