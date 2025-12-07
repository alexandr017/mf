<div class="bg-gray-50 p-6 rounded-lg">
    <h3 class="text-xl font-semibold mb-4">Форма обратной связи</h3>

    <div id="contact-form" class="hidden mb-6">
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-gray-700 font-medium mb-2">Ваше имя</label>
                <input type="text" id="name" class="w-full px-4 py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition" placeholder="Your name">
            </div>
            <div>
                <label for="email" class="block text-gray-700 font-medium mb-2">Ваш Email</label>
                <input type="email" id="email" class="w-full px-4 py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition" placeholder="Your email address">
            </div>
        </div>

        <div class="mb-6">
            <label for="feedback" class="block text-gray-700 font-medium mb-2">Share your feedback or suggestions</label>
            <textarea id="feedback" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition" placeholder="What could we improve or explain better?"></textarea>
        </div>
    </div>

    <button class="bg-primary text-white px-6 py-3 !rounded-button hover:bg-blue-600 transition-colors whitespace-nowrap">Submit Feedback</button>
</div>
