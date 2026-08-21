@extends('layouts.front')
@section('title', 'যোগাযোগ')

@section('content')

    <!-- Contact Header -->
    <section class="py-16 bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-emerald-400 mb-4 bengali">
                    যোগাযোগ
                </h2>
                <p class="text-gray-400 text-lg mb-8 bengali">
                    আমাদের সাথে জড়িত হন বা আরও তথ্য জন্য যোগাযোগ করুন।
                </p>
            </div>
        </div>
    </section>

    <!-- Contact Form -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto">
                <form action="#" class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2 bengoli">Name</label>
                        <input type="text"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors bg-white text-gray-900 placeholder:text-gray-500"
                            placeholder="আপনার নাম">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2 bengoli">Phone</label>
                        <input type="tel"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors bg-white text-gray-900 placeholder:text-gray-500"
                            placeholder="+৮৮০ ১৭১২৩৪৫৬৭৮">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2 bengoli">Email</label>
                        <input type="email"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors bg-white text-gray-900 placeholder:text-gray-500"
                            placeholder="আইমেইল@এড্রেস.কম">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2 bengoli">Subject</label>
                        <input type="text"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors bg-white text-gray-900 placeholder:text-gray-500"
                           placeholder="বিষয়">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2 bengoli">Message</label>
                        <textarea rows="5"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors resize-none bengali bg-white text-gray-900 placeholder:text-gray-500"
                            placeholder="আপনার বার্তাটি here"></textarea>
                    </div>
                    <button type="submit"
                        class="w-full py-4 px-8 bg-emerald text-white font-medium rounded-full hover:bg-emerald-dark transition-colors text-lg">
                        পাঠান
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Contact Info -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

                <div>
                    <h4 class="text-emerald-600 font-medium mb-4 bengali">Office Address</h4>
                    <address class="text-gray-600 text-sm bengali">
                        <p>📍 House # 123, Road # 5, Mohammadpur, Dhaka-1207, Bangladesh</p>
                        <p>🕐 Office Hours: 9:00 AM - 5:00 PM (Saturday to Thursday)</p>
                    </address>
                </div>

                <div>
                    <h4 class="text-amber-600 font-medium mb-4 bengali">Phone</h4>
                    <div class="space-y-2 text-gray-600 text-sm bengali">
                        <p>📞 +880 1712345678 (Main Office)</p>
                        <p>📞 +880 1787654321 (Emergency)</p>
                    </div>
                </div>

                <div>
                    <h4 class="text-emerald-600 font-medium mb-4 bengali">Email</h4>
                    <div class="space-y-2 text-gray-600 text-sm bengali">
                        <p>📧 info@dineralo.org</p>
                        <p>📧 admin@dineralo.org</p>
                    </div>
                </div>

                <div>
                    <h4 class="text-amber-600 font-medium mb-4 bengali">Social Media</h4>
                    <div class="flex space-x-3">
                        <a href="#!" class="text-gray-400 hover:text-emerald-400 transition-colors">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h1v4h-1m0 0h1m-1-4h1v4h-1m1 8V7a1 1 0 00-1-1h-4a1 1 0 00-1 1v4m0 0h1m-1 0l-3 3m-3-3l3 3m0 0l3-3m-3 3l3-3"/></svg>
                            Facebook
                        </a>
                        <a href="#!" class="text-gray-400 hover:text-emerald-400 transition-colors">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7zM12 20a8 8 0 00-8 8h16a8 8 0 00-8-8z"></path></svg>
                            Twitter
                        </a>
                        <a href="#!" class="text-gray-400 hover:text-emerald-400 transition-colors">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.261 2.261a5.992 5.992 0 018.482 0M15.547 15.547l6.057 6.057m0-1.321l-6.057-6.057m6.057 6.057-3.028-3.028m3.394-3.394L15.547 15.547"/></svg>
                            Instagram
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="rounded-2xl overflow-hidden bg-gray-100">
                <!-- Google Maps Embed would go here -->
                <div class="h-96 w-full bg-gray-200">
                    <p class="text-center text-gray-500 py-16">Google Map placeholder - would embed actual map in production</p>
                </div>
            </div>
        </div>
    </section>

@endsection
