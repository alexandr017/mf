
<!DOCTYPE html>
<html lang="en">
<head><script src="https://static.readdy.ai/static/e.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings - Meme Football League</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:'#7FFF00',secondary:'#FF355E'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
    <style>
        :where([class^="ri-"])::before { content: "\f3c2"; }
        body {
            font-family: 'Rubik', sans-serif;
        }
        .heading-font {
            font-family: 'Bangers', cursive;
            letter-spacing: 1px;
        }
        .sidebar-active {
            background-color: rgba(127, 255, 0, 0.1);
            border-right: 4px solid #7FFF00;
            color: #7FFF00;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid #e2e8f0;
        }
        .achievement-badge {
            background: linear-gradient(135deg, #7FFF00 0%, #32CD32 100%);
            animation: pulse-glow 2s infinite;
        }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(127, 255, 0, 0.4); }
            50% { box-shadow: 0 0 30px rgba(127, 255, 0, 0.6); }
        }
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>
<body class="bg-gray-50">
<!-- Top Navigation -->
<nav class="bg-white shadow-md sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="#" class="flex-shrink-0 flex items-center cursor-pointer">
                    <span class="text-3xl font-['Pacifico'] text-primary">logo</span>
                </a>
            </div>
            <div class="flex items-center space-x-6">
                <nav class="hidden md:flex space-x-8">
                    <a href="#" class="text-gray-600 hover:text-primary font-medium cursor-pointer">Dashboard</a>
                    <a href="#" class="text-gray-600 hover:text-primary font-medium cursor-pointer">My Team</a>
                    <a href="#" class="text-gray-600 hover:text-primary font-medium cursor-pointer">Games</a>
                    <a href="#" class="text-gray-600 hover:text-primary font-medium cursor-pointer">Rankings</a>
                </nav>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-3">
                        <img src="https://readdy.ai/api/search-image?query=Professional%20football%20player%20avatar%20portrait%2C%20young%20athlete%20with%20confident%20expression%2C%20friendly%20smile%20in%20team%20colors&width=100&height=100&seq=601&orientation=squarish" alt="Player Avatar" class="w-8 h-8 rounded-full object-cover object-top">
                        <span class="text-gray-700 font-medium">Alex Chen</span>
                    </div>
                    <button class="text-gray-600 hover:text-primary cursor-pointer">
                        <div class="w-6 h-6 flex items-center justify-center">
                            <i class="ri-logout-box-line"></i>
                        </div>
                    </button>
                </div>
            </div>
        </div>
</nav>
<div class="min-h-screen">
    <!-- Main Content -->
    <main class="flex max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 gap-8">
        <!-- Sidebar -->
        <aside class="w-64 flex-shrink-0">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-6">Settings</h2>
                <nav class="space-y-2">
                    <button class="w-full flex items-center space-x-3 px-4 py-3 text-left rounded-button hover:bg-gray-50 transition-colors settings-nav active" data-section="profile">
                        <div class="w-5 h-5 flex items-center justify-center">
                            <i class="ri-user-line text-gray-600"></i>
                        </div>
                        <span class="text-gray-700 font-medium">Profile</span>
                    </button>
                    <button class="w-full flex items-center space-x-3 px-4 py-3 text-left rounded-button hover:bg-gray-50 transition-colors settings-nav" data-section="account">
                        <div class="w-5 h-5 flex items-center justify-center">
                            <i class="ri-settings-line text-gray-600"></i>
                        </div>
                        <span class="text-gray-700 font-medium">Account</span>
                    </button>
                    <button class="w-full flex items-center space-x-3 px-4 py-3 text-left rounded-button hover:bg-gray-50 transition-colors settings-nav" data-section="notifications">
                        <div class="w-5 h-5 flex items-center justify-center">
                            <i class="ri-notification-line text-gray-600"></i>
                        </div>
                        <span class="text-gray-700 font-medium">Notifications</span>
                    </button>
                    <button class="w-full flex items-center space-x-3 px-4 py-3 text-left rounded-button hover:bg-gray-50 transition-colors settings-nav" data-section="privacy">
                        <div class="w-5 h-5 flex items-center justify-center">
                            <i class="ri-shield-line text-gray-600"></i>
                        </div>
                        <span class="text-gray-700 font-medium">Privacy</span>
                    </button>
                    <button class="w-full flex items-center space-x-3 px-4 py-3 text-left rounded-button hover:bg-gray-50 transition-colors settings-nav" data-section="preferences">
                        <div class="w-5 h-5 flex items-center justify-center">
                            <i class="ri-palette-line text-gray-600"></i>
                        </div>
                        <span class="text-gray-700 font-medium">Preferences</span>
                    </button>
                </nav>
            </div>
        </aside>

        <!-- Content Area -->
        <div class="flex-1">
            <!-- Profile Section -->
            <div class="settings-section" id="profile-section">
                <div class="bg-white rounded-xl shadow-lg p-8 mb-6">
                    <h1 class="heading-font text-3xl text-gray-900 mb-2">Profile Settings</h1>
                    <p class="text-gray-600 mb-8">Manage your personal information and player profile</p>

                    <!-- Profile Picture -->
                    <div class="flex items-start space-x-6 mb-8">
                        <div class="relative">
                            <img src="https://readdy.ai/api/search-image?query=Professional%20football%20player%20avatar%20portrait%2C%20young%20Asian%20athlete%20Alex%20Chen%20with%20confident%20expression%2C%20friendly%20smile%20in%20team%20colors&width=200&height=200&seq=602&orientation=squarish" alt="Profile Picture" class="w-24 h-24 rounded-full object-cover object-top">
                            <button class="absolute -bottom-2 -right-2 w-8 h-8 bg-primary rounded-full flex items-center justify-center text-gray-900 hover:bg-opacity-80 transition-colors cursor-pointer">
                                <div class="w-4 h-4 flex items-center justify-center">
                                    <i class="ri-camera-line text-sm"></i>
                                </div>
                            </button>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Profile Picture</h3>
                            <p class="text-sm text-gray-600 mb-4">Upload a new profile picture. Recommended size: 400x400px</p>
                            <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-button text-sm font-medium hover:bg-gray-200 transition-colors cursor-pointer whitespace-nowrap">
                                Change Photo
                            </button>
                        </div>
                    </div>

                    <!-- Player Information Form -->
                    <form class="space-y-6" id="profile-form">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Player Name</label>
                                <input type="text" value="Alex Chen" name="player_name" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Display Name</label>
                                <input type="text" value="AlexC_MFL" name="display_name" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Preferred Position</label>
                                <div class="relative">
                                    <button type="button" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-left bg-white cursor-pointer position-select">
                                        Midfielder
                                    </button>
                                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 flex items-center justify-center">
                                        <i class="ri-arrow-down-s-line text-gray-400"></i>
                                    </div>
                                    <div class="absolute top-full left-0 w-full bg-white border border-gray-300 rounded-button mt-1 shadow-lg z-10 hidden position-dropdown">
                                        <button type="button" class="w-full px-4 py-3 text-left hover:bg-gray-50 cursor-pointer position-option" data-value="Goalkeeper">Goalkeeper</button>
                                        <button type="button" class="w-full px-4 py-3 text-left hover:bg-gray-50 cursor-pointer position-option" data-value="Defender">Defender</button>
                                        <button type="button" class="w-full px-4 py-3 text-left hover:bg-gray-50 cursor-pointer position-option" data-value="Midfielder">Midfielder</button>
                                        <button type="button" class="w-full px-4 py-3 text-left hover:bg-gray-50 cursor-pointer position-option" data-value="Forward">Forward</button>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                                <input type="date" value="1995-03-15" name="birth_date" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                            <textarea rows="4" name="bio" maxlength="500" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent resize-none">Passionate midfielder with 8 years of experience. Love creating plays and supporting my team. Always looking to improve my game and reach new heights in the league.</textarea>
                            <div class="text-right">
                                <span class="text-sm text-gray-500 bio-counter">184/500</span>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4">
                            <button type="button" class="px-6 py-3 text-gray-700 bg-gray-100 rounded-button font-medium hover:bg-gray-200 transition-colors cursor-pointer whitespace-nowrap">
                                Cancel
                            </button>
                            <button type="submit" class="px-6 py-3 bg-primary text-gray-900 rounded-button font-medium hover:bg-opacity-80 transition-colors cursor-pointer whitespace-nowrap">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Account Section -->
            <div class="settings-section hidden" id="account-section">
                <div class="bg-white rounded-xl shadow-lg p-8 mb-6">
                    <h1 class="heading-font text-3xl text-gray-900 mb-2">Account Settings</h1>
                    <p class="text-gray-600 mb-8">Manage your account credentials and security settings</p>

                    <form class="space-y-6" id="account-form">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email" value="alex.chen@email.com" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Change Password</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                                    <input type="password" name="current_password" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                                    <input type="password" name="new_password" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                                    <input type="password" name="confirm_password" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Two-Factor Authentication</h3>
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-button">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Enable 2FA</p>
                                    <p class="text-sm text-gray-600">Add an extra layer of security to your account</p>
                                </div>
                                <div class="relative">
                                    <input type="checkbox" id="2fa-toggle" class="sr-only">
                                    <label for="2fa-toggle" class="relative cursor-pointer">
                                        <div class="w-11 h-6 bg-gray-300 rounded-full toggle-bg"></div>
                                        <div class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full transition-transform toggle-dot"></div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4">
                            <button type="button" class="px-6 py-3 text-gray-700 bg-gray-100 rounded-button font-medium hover:bg-gray-200 transition-colors cursor-pointer whitespace-nowrap">
                                Cancel
                            </button>
                            <button type="submit" class="px-6 py-3 bg-primary text-gray-900 rounded-button font-medium hover:bg-opacity-80 transition-colors cursor-pointer whitespace-nowrap">
                                Update Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Notifications Section -->
            <div class="settings-section hidden" id="notifications-section">
                <div class="bg-white rounded-xl shadow-lg p-8 mb-6">
                    <h1 class="heading-font text-3xl text-gray-900 mb-2">Notification Preferences</h1>
                    <p class="text-gray-600 mb-8">Choose what notifications you want to receive</p>

                    <div class="space-y-6">
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Match Notifications</h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Match Reminders</p>
                                        <p class="text-sm text-gray-600">Get notified 30 minutes before your matches</p>
                                    </div>
                                    <div class="relative">
                                        <input type="checkbox" id="match-reminders" class="sr-only" checked>
                                        <label for="match-reminders" class="relative cursor-pointer">
                                            <div class="w-11 h-6 bg-primary rounded-full toggle-bg"></div>
                                            <div class="absolute top-0.5 right-0.5 w-5 h-5 bg-white rounded-full transition-transform toggle-dot"></div>
                                        </label>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Match Results</p>
                                        <p class="text-sm text-gray-600">Get notified when match results are available</p>
                                    </div>
                                    <div class="relative">
                                        <input type="checkbox" id="match-results" class="sr-only" checked>
                                        <label for="match-results" class="relative cursor-pointer">
                                            <div class="w-11 h-6 bg-primary rounded-full toggle-bg"></div>
                                            <div class="absolute top-0.5 right-0.5 w-5 h-5 bg-white rounded-full transition-transform toggle-dot"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Team Notifications</h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Team Updates</p>
                                        <p class="text-sm text-gray-600">News and announcements from your team</p>
                                    </div>
                                    <div class="relative">
                                        <input type="checkbox" id="team-updates" class="sr-only" checked>
                                        <label for="team-updates" class="relative cursor-pointer">
                                            <div class="w-11 h-6 bg-primary rounded-full toggle-bg"></div>
                                            <div class="absolute top-0.5 right-0.5 w-5 h-5 bg-white rounded-full transition-transform toggle-dot"></div>
                                        </label>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Lineup Changes</p>
                                        <p class="text-sm text-gray-600">When you're added or removed from starting lineup</p>
                                    </div>
                                    <div class="relative">
                                        <input type="checkbox" id="lineup-changes" class="sr-only">
                                        <label for="lineup-changes" class="relative cursor-pointer">
                                            <div class="w-11 h-6 bg-gray-300 rounded-full toggle-bg"></div>
                                            <div class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full transition-transform toggle-dot"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">League Notifications</h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">League News</p>
                                        <p class="text-sm text-gray-600">Updates about the Meme Football League</p>
                                    </div>
                                    <div class="relative">
                                        <input type="checkbox" id="league-news" class="sr-only" checked>
                                        <label for="league-news" class="relative cursor-pointer">
                                            <div class="w-11 h-6 bg-primary rounded-full toggle-bg"></div>
                                            <div class="absolute top-0.5 right-0.5 w-5 h-5 bg-white rounded-full transition-transform toggle-dot"></div>
                                        </label>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Achievement Rewards</p>
                                        <p class="text-sm text-gray-600">When you unlock new achievements or rewards</p>
                                    </div>
                                    <div class="relative">
                                        <input type="checkbox" id="achievements" class="sr-only" checked>
                                        <label for="achievements" class="relative cursor-pointer">
                                            <div class="w-11 h-6 bg-primary rounded-full toggle-bg"></div>
                                            <div class="absolute top-0.5 right-0.5 w-5 h-5 bg-white rounded-full transition-transform toggle-dot"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button class="px-6 py-3 bg-primary text-gray-900 rounded-button font-medium hover:bg-opacity-80 transition-colors cursor-pointer whitespace-nowrap">
                            Save Preferences
                        </button>
                    </div>
                </div>
            </div>

            <!-- Privacy Section -->
            <div class="settings-section hidden" id="privacy-section">
                <div class="bg-white rounded-xl shadow-lg p-8 mb-6">
                    <h1 class="heading-font text-3xl text-gray-900 mb-2">Privacy Settings</h1>
                    <p class="text-gray-600 mb-8">Control who can see your information and activity</p>

                    <div class="space-y-6">
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Profile Visibility</h3>
                            <div class="space-y-4">
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="radio" name="profile_visibility" value="public" checked class="text-primary focus:ring-primary">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Public</p>
                                        <p class="text-sm text-gray-600">Anyone can view your profile and stats</p>
                                    </div>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="radio" name="profile_visibility" value="friends" class="text-primary focus:ring-primary">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Friends Only</p>
                                        <p class="text-sm text-gray-600">Only friends can view your detailed profile</p>
                                    </div>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="radio" name="profile_visibility" value="private" class="text-primary focus:ring-primary">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Private</p>
                                        <p class="text-sm text-gray-600">Your profile is hidden from other players</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Preferences</h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Allow Friend Requests</p>
                                        <p class="text-sm text-gray-600">Other players can send you friend requests</p>
                                    </div>
                                    <div class="relative">
                                        <input type="checkbox" id="friend-requests" class="sr-only" checked>
                                        <label for="friend-requests" class="relative cursor-pointer">
                                            <div class="w-11 h-6 bg-primary rounded-full toggle-bg"></div>
                                            <div class="absolute top-0.5 right-0.5 w-5 h-5 bg-white rounded-full transition-transform toggle-dot"></div>
                                        </label>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Show Online Status</p>
                                        <p class="text-sm text-gray-600">Others can see when you're online</p>
                                    </div>
                                    <div class="relative">
                                        <input type="checkbox" id="online-status" class="sr-only">
                                        <label for="online-status" class="relative cursor-pointer">
                                            <div class="w-11 h-6 bg-gray-300 rounded-full toggle-bg"></div>
                                            <div class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full transition-transform toggle-dot"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Data & Analytics</h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Performance Analytics</p>
                                        <p class="text-sm text-gray-600">Allow collection of gameplay data for analysis</p>
                                    </div>
                                    <div class="relative">
                                        <input type="checkbox" id="analytics" class="sr-only" checked>
                                        <label for="analytics" class="relative cursor-pointer">
                                            <div class="w-11 h-6 bg-primary rounded-full toggle-bg"></div>
                                            <div class="absolute top-0.5 right-0.5 w-5 h-5 bg-white rounded-full transition-transform toggle-dot"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button class="px-6 py-3 bg-primary text-gray-900 rounded-button font-medium hover:bg-opacity-80 transition-colors cursor-pointer whitespace-nowrap">
                            Save Settings
                        </button>
                    </div>
                </div>
            </div>

            <!-- Preferences Section -->
            <div class="settings-section hidden" id="preferences-section">
                <div class="bg-white rounded-xl shadow-lg p-8 mb-6">
                    <h1 class="heading-font text-3xl text-gray-900 mb-2">App Preferences</h1>
                    <p class="text-gray-600 mb-8">Customize your app experience and interface</p>

                    <div class="space-y-6">
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Language & Region</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Language</label>
                                    <div class="relative">
                                        <button type="button" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-left bg-white cursor-pointer language-select">
                                            English (US)
                                        </button>
                                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 flex items-center justify-center">
                                            <i class="ri-arrow-down-s-line text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Timezone</label>
                                    <div class="relative">
                                        <button type="button" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-left bg-white cursor-pointer timezone-select">
                                            UTC-08:00 (Pacific Time)
                                        </button>
                                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 flex items-center justify-center">
                                            <i class="ri-arrow-down-s-line text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Display Options</h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Auto-refresh Stats</p>
                                        <p class="text-sm text-gray-600">Automatically update your performance statistics</p>
                                    </div>
                                    <div class="relative">
                                        <input type="checkbox" id="auto-refresh" class="sr-only" checked>
                                        <label for="auto-refresh" class="relative cursor-pointer">
                                            <div class="w-11 h-6 bg-primary rounded-full toggle-bg"></div>
                                            <div class="absolute top-0.5 right-0.5 w-5 h-5 bg-white rounded-full transition-transform toggle-dot"></div>
                                        </label>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Show Advanced Metrics</p>
                                        <p class="text-sm text-gray-600">Display detailed performance analytics</p>
                                    </div>
                                    <div class="relative">
                                        <input type="checkbox" id="advanced-metrics" class="sr-only">
                                        <label for="advanced-metrics" class="relative cursor-pointer">
                                            <div class="w-11 h-6 bg-gray-300 rounded-full toggle-bg"></div>
                                            <div class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full transition-transform toggle-dot"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Game Preferences</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Default Match View</label>
                                    <div class="grid grid-cols-2 gap-4">
                                        <label class="flex items-center space-x-3 cursor-pointer p-3 border border-gray-300 rounded-button hover:bg-gray-50">
                                            <input type="radio" name="match_view" value="live" checked class="text-primary focus:ring-primary">
                                            <span class="text-sm font-medium text-gray-900">Live View</span>
                                        </label>
                                        <label class="flex items-center space-x-3 cursor-pointer p-3 border border-gray-300 rounded-button hover:bg-gray-50">
                                            <input type="radio" name="match_view" value="summary" class="text-primary focus:ring-primary">
                                            <span class="text-sm font-medium text-gray-900">Summary</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Sound Effects</p>
                                        <p class="text-sm text-gray-600">Play sounds for goals, matches, and notifications</p>
                                    </div>
                                    <div class="relative">
                                        <input type="checkbox" id="sound-effects" class="sr-only" checked>
                                        <label for="sound-effects" class="relative cursor-pointer">
                                            <div class="w-11 h-6 bg-primary rounded-full toggle-bg"></div>
                                            <div class="absolute top-0.5 right-0.5 w-5 h-5 bg-white rounded-full transition-transform toggle-dot"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button class="px-6 py-3 bg-primary text-gray-900 rounded-button font-medium hover:bg-opacity-80 transition-colors cursor-pointer whitespace-nowrap">
                            Save Preferences
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </main>
</div>
<script id="navigation">
    document.addEventListener('DOMContentLoaded', function() {
        const navLinks = document.querySelectorAll('nav a');
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                navLinks.forEach(l => {
                    l.classList.remove('text-primary');
                    l.classList.add('text-gray-600');
                });
                this.classList.add('text-primary');
                this.classList.remove('text-gray-600');
            });
        });
    });
</script>
<script id="settings-navigation">
    document.addEventListener('DOMContentLoaded', function() {
        const settingsNavButtons = document.querySelectorAll('.settings-nav');
        const settingsSections = document.querySelectorAll('.settings-section');

        function showSection(sectionId) {
            settingsSections.forEach(section => {
                section.classList.add('hidden');
            });
            const targetSection = document.getElementById(sectionId + '-section');
            if (targetSection) {
                targetSection.classList.remove('hidden');
            }
        }

        settingsNavButtons.forEach(button => {
            button.addEventListener('click', function() {
                const sectionId = this.dataset.section;

                settingsNavButtons.forEach(btn => {
                    btn.classList.remove('sidebar-active');
                });
                this.classList.add('sidebar-active');

                showSection(sectionId);
            });
        });

        showSection('profile');
    });
</script>
<script id="form-interactions">
    document.addEventListener('DOMContentLoaded', function() {
        const positionSelect = document.querySelector('.position-select');
        const positionDropdown = document.querySelector('.position-dropdown');
        const positionOptions = document.querySelectorAll('.position-option');
        const bioTextarea = document.querySelector('textarea[name="bio"]');
        const bioCounter = document.querySelector('.bio-counter');

        if (positionSelect && positionDropdown) {
            positionSelect.addEventListener('click', function() {
                positionDropdown.classList.toggle('hidden');
            });

            positionOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const value = this.dataset.value;
                    positionSelect.textContent = value;
                    positionDropdown.classList.add('hidden');
                });
            });

            document.addEventListener('click', function(e) {
                if (!positionSelect.contains(e.target) && !positionDropdown.contains(e.target)) {
                    positionDropdown.classList.add('hidden');
                }
            });
        }

        if (bioTextarea && bioCounter) {
            function updateBioCounter() {
                const length = bioTextarea.value.length;
                bioCounter.textContent = `${length}/500`;
                if (length > 500) {
                    bioCounter.classList.add('text-red-500');
                    bioCounter.classList.remove('text-gray-500');
                } else {
                    bioCounter.classList.remove('text-red-500');
                    bioCounter.classList.add('text-gray-500');
                }
            }

            bioTextarea.addEventListener('input', updateBioCounter);
            updateBioCounter();
        }

        const toggles = document.querySelectorAll('input[type="checkbox"]:not([id^="2fa-toggle"])');
        toggles.forEach(toggle => {
            toggle.addEventListener('change', function() {
                const label = this.nextElementSibling;
                const bg = label.querySelector('.toggle-bg');
                const dot = label.querySelector('.toggle-dot');

                if (this.checked) {
                    bg.classList.remove('bg-gray-300');
                    bg.classList.add('bg-primary');
                    dot.classList.remove('translate-x-0');
                    dot.classList.add('translate-x-5');
                } else {
                    bg.classList.remove('bg-primary');
                    bg.classList.add('bg-gray-300');
                    dot.classList.remove('translate-x-5');
                    dot.classList.add('translate-x-0');
                }
            });
        });

        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const formName = this.id.replace('-form', '');

                const notification = document.createElement('div');
                notification.className = 'fixed top-4 right-4 bg-primary text-gray-900 px-6 py-3 rounded-button shadow-lg z-50';
                notification.textContent = `${formName.charAt(0).toUpperCase() + formName.slice(1)} settings saved successfully!`;
                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.remove();
                }, 3000);
            });
        });
    });
</script>
<script>
    !function (t, e) { var o, n, p, r; e.__SV || (window.posthog = e, e._i = [], e.init = function (i, s, a) { function g(t, e) { var o = e.split("."); 2 == o.length && (t = t[o[0]], e = o[1]), t[e] = function () { t.push([e].concat(Array.prototype.slice.call(arguments, 0))) } } (p = t.createElement("script")).type = "text/javascript", p.crossOrigin = "anonymous", p.async = !0, p.src = s.api_host.replace(".i.posthog.com", "-assets.i.posthog.com") + "/static/array.js", (r = t.getElementsByTagName("script")[0]).parentNode.insertBefore(p, r); var u = e; for (void 0 !== a ? u = e[a] = [] : a = "posthog", u.people = u.people || [], u.toString = function (t) { var e = "posthog"; return "posthog" !== a && (e += "." + a), t || (e += " (stub)"), e }, u.people.toString = function () { return u.toString(1) + ".people (stub)" }, o = "init capture register register_once register_for_session unregister unregister_for_session getFeatureFlag getFeatureFlagPayload isFeatureEnabled reloadFeatureFlags updateEarlyAccessFeatureEnrollment getEarlyAccessFeatures on onFeatureFlags onSessionId getSurveys getActiveMatchingSurveys renderSurvey canRenderSurvey getNextSurveyStep identify setPersonProperties group resetGroups setPersonPropertiesForFlags resetPersonPropertiesForFlags setGroupPropertiesForFlags resetGroupPropertiesForFlags reset get_distinct_id getGroups get_session_id get_session_replay_url alias set_config startSessionRecording stopSessionRecording sessionRecordingStarted captureException loadToolbar get_property getSessionProperty createPersonProfile opt_in_capturing opt_out_capturing has_opted_in_capturing has_opted_out_capturing clear_opt_in_out_capturing debug".split(" "), n = 0; n < o.length; n++)g(u, o[n]); e._i.push([i, s, a]) }, e.__SV = 1) }(document, window.posthog || []);
    posthog.init('phc_t9tkQZJiyi2ps9zUYm8TDsL6qXo4YmZx0Ot5rBlAlEd', {
        api_host: 'https://us.i.posthog.com',
        autocapture: false,
        capture_pageview: false,
        capture_pageleave: false,
        capture_performance: {
            web_vitals: false,
        },
        rageclick: false,
    })
    window.shareKey = 'Ej3SlcduvYPavZjFDe05VA';
    window.host = 'readdy.ai';
</script>
<script src="https://static.readdy.ai/static/share.js"></script></body>
</html>
