@extends('site.v1.layouts.account')

@section('content')

<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 mb-6">
        <h1 class="heading-font text-3xl text-gray-900 mb-2">Мои рефералы</h1>
        <p class="text-gray-600 mb-8">Управление реферальной программой</p>

        @php
            $user = auth()->user();
            $referrals = $user->referrals;
            $referralCode = $user->referral_code;
        @endphp

        <!-- Реферальная ссылка -->
        <div class="bg-primary bg-opacity-10 rounded-lg p-6 mb-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Ваша реферальная ссылка</h2>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                <input type="text" id="referral-link" value="{{ url('/register?ref=' . $referralCode) }}" readonly class="flex-1 px-4 py-3 bg-white border border-gray-300 rounded-button font-mono text-sm break-all">
                <button onclick="copyReferralLink()" class="px-6 py-3 bg-primary text-gray-900 rounded-button font-medium hover:bg-opacity-80 transition-colors whitespace-nowrap">
                    <i class="ri-file-copy-line mr-2"></i> Копировать ссылку
                </button>
            </div>
            <p class="text-sm text-gray-600 mt-4">Поделитесь этой ссылкой с друзьями, чтобы получить бонусы за их регистрацию!</p>
            <div class="mt-4 flex flex-wrap gap-3">
                <a href="https://vk.com/share.php?url={{ urlencode(url('/register?ref=' . $referralCode)) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-button text-sm hover:bg-blue-700 transition-colors">
                    <i class="ri-vk-fill mr-2"></i> VK
                </a>
                <a href="https://t.me/share/url?url={{ urlencode(url('/register?ref=' . $referralCode)) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-button text-sm hover:bg-blue-600 transition-colors">
                    <i class="ri-telegram-fill mr-2"></i> Telegram
                </a>
                <button onclick="shareViaWhatsApp()" class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-button text-sm hover:bg-green-600 transition-colors">
                    <i class="ri-whatsapp-fill mr-2"></i> WhatsApp
                </button>
                <a href="https://ok.ru/dk?st.cmd=addShare&st.s=1&st._surl={{ urlencode(url('/register?ref=' . $referralCode)) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-orange-500 text-white rounded-button text-sm hover:bg-orange-600 transition-colors">
                    <i class="ri-odnoklassniki-fill mr-2"></i> Одноклассники
                </a>
                <a href="https://connect.mail.ru/share?url={{ urlencode(url('/register?ref=' . $referralCode)) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-700 text-white rounded-button text-sm hover:bg-blue-800 transition-colors">
                    <i class="ri-mail-fill mr-2"></i> Mail.ru
                </a>
                <a href="https://connect.ok.ru/offer?url={{ urlencode(url('/register?ref=' . $referralCode)) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-orange-600 text-white rounded-button text-sm hover:bg-orange-700 transition-colors">
                    <i class="ri-messenger-fill mr-2"></i> Мессенджер
                </a>
                <a href="https://vk.me/share?url={{ urlencode(url('/register?ref=' . $referralCode)) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-button text-sm hover:bg-blue-600 transition-colors">
                    <i class="ri-messenger-line mr-2"></i> VK Мессенджер
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url('/register?ref=' . $referralCode)) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-sky-500 text-white rounded-button text-sm hover:bg-sky-600 transition-colors">
                    <i class="ri-twitter-x-fill mr-2"></i> X (Twitter)
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url('/register?ref=' . $referralCode)) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-button text-sm hover:bg-blue-700 transition-colors">
                    <i class="ri-facebook-fill mr-2"></i> Facebook
                </a>
            </div>
        </div>

        <!-- Статистика -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="stat-card rounded-xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Всего рефералов</p>
                        <p class="text-3xl font-bold text-primary">{{ $user->referrals_count ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-primary bg-opacity-20 rounded-full flex items-center justify-center">
                        <i class="ri-user-line text-primary text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="stat-card rounded-xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Активных</p>
                        <p class="text-3xl font-bold text-secondary">{{ $referrals->where('rating', '>', 0)->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-secondary bg-opacity-20 rounded-full flex items-center justify-center">
                        <i class="ri-user-star-line text-secondary text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="stat-card rounded-xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Пригласил вас</p>
                        <p class="text-3xl font-bold text-yellow-600">
                            @if($user->referredBy)
                                <a href="/players/{{ $user->referredBy->nickname ?? $user->referredBy->id }}" class="hover:underline">
                                    {{ $user->referredBy->name }}
                                </a>
                            @else
                                Нет
                            @endif
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                        <i class="ri-share-line text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Список рефералов -->
        @if($referrals->count() > 0)
        <div>
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Список рефералов</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Имя</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Рейтинг</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Дата регистрации</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($referrals as $referral)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="/players/{{ $referral->nickname ?? $referral->id }}" class="text-sm font-medium text-gray-900 hover:text-primary hover:underline">
                                    {{ $referral->name }}
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $referral->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ number_format($referral->rating ?? 0, 1) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $referral->created_at->format('d.m.Y') }}</div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="text-center py-12">
            <i class="ri-user-add-line text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg">У вас пока нет рефералов</p>
            <p class="text-gray-400 text-sm mt-2">Поделитесь своим реферальным кодом с друзьями!</p>
        </div>
        @endif
    </div>
</div>

<script>
function copyReferralLink() {
    const input = document.getElementById('referral-link');
    input.select();
    input.setSelectionRange(0, 99999); // Для мобильных устройств

    try {
        document.execCommand('copy');
        navigator.clipboard.writeText(input.value).then(() => {
            showNotification('Ссылка скопирована!', 'success');
        }).catch(() => {
            showNotification('Ссылка скопирована!', 'success');
        });
    } catch (err) {
        // Fallback для старых браузеров
        input.select();
        document.execCommand('copy');
        showNotification('Ссылка скопирована!', 'success');
    }
}

function shareViaWhatsApp() {
    const link = document.getElementById('referral-link').value;
    window.open('https://wa.me/?text=' + encodeURIComponent(link), '_blank');
}

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 px-6 py-3 rounded-button shadow-lg z-50 ${type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'}`;
    notification.textContent = message;
    document.body.appendChild(notification);

    setTimeout(() => {
        notification.remove();
    }, 3000);
}
</script>

@endsection
