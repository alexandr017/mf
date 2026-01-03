@extends('site.v1.layouts.account')

@section('title', 'Чеканка')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="heading-font text-4xl text-gray-900 mb-2">Чеканка</h1>
        <p class="text-gray-600">Набивайте мяч как можно больше раз! Кликайте по мячу, когда он падает. С каждым разом игра становится сложнее. Прокачивает навык «Полузащита».</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Game Area -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <!-- Game Canvas -->
                <div id="gameArea" class="relative bg-gradient-to-b from-blue-400 via-blue-500 to-green-500 rounded-lg overflow-hidden" style="height: 600px; position: relative;">
                    <!-- Ball -->
                    <div id="ball" class="absolute w-20 h-20 transition-all duration-300" style="display: none;">
                        <div class="w-full h-full bg-white rounded-full flex items-center justify-center shadow-2xl border-4 border-gray-300">
                            <div class="w-16 h-16 bg-black rounded-full"></div>
                        </div>
                    </div>

                    <!-- Score Display -->
                    <div id="scoreDisplay" class="absolute top-4 left-1/2 transform -translate-x-1/2 bg-black bg-opacity-50 text-white px-6 py-3 rounded-full text-2xl font-bold z-10" style="display: none;">
                        <span id="scoreValue">0</span>
                    </div>

                    <!-- Start Screen -->
                    <div id="startScreen" class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center z-20">
                        <div class="bg-white rounded-xl p-8 text-center max-w-md">
                            <div class="text-6xl mb-4">⚽</div>
                            <h2 class="heading-font text-3xl text-gray-900 mb-4">Чеканка</h2>
                            <p class="text-gray-600 mb-6">Кликайте по мячу, когда он падает. Чем больше набиваете, тем сложнее становится!</p>
                            <button id="startButton" class="bg-primary text-gray-900 font-bold px-8 py-4 rounded-button hover:bg-opacity-80 transition-colors text-lg">
                                Начать игру
                            </button>
                        </div>
                    </div>

                    <!-- Game Over Screen -->
                    <div id="gameOverScreen" class="absolute inset-0 bg-black bg-opacity-75 flex items-center justify-center z-20 hidden">
                        <div class="bg-white rounded-xl p-8 text-center max-w-md">
                            <div id="gameOverIcon" class="text-6xl mb-4">🎉</div>
                            <h2 id="gameOverTitle" class="heading-font text-3xl text-gray-900 mb-2">Игра окончена!</h2>
                            <p id="gameOverScore" class="text-2xl font-bold text-primary mb-4">Набито мячей: <span id="finalScore">0</span></p>
                            <p id="gameOverRating" class="text-gray-600 mb-6"></p>
                            <button id="playAgainButton" class="bg-primary text-gray-900 font-bold px-8 py-4 rounded-button hover:bg-opacity-80 transition-colors text-lg">
                                Играть снова
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Loading -->
                <div id="loading" class="hidden text-center mt-4">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div>
                    <p class="mt-2 text-gray-600">Сохранение результата...</p>
                </div>
            </div>
        </div>

        <!-- Statistics & Leaderboard -->
        <div class="space-y-6">
            <!-- User Stats -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="heading-font text-xl text-gray-900 mb-4">Ваша статистика</h2>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500">Лучший результат</p>
                        <p class="text-2xl font-bold text-primary">{{ $userBestScore }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Всего игр</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalGames }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Всего набито</p>
                        <p class="text-2xl font-bold text-blue-600">{{ $totalScore }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Заработано рейтинга</p>
                        <p class="text-2xl font-bold text-secondary">+{{ number_format($totalRatingEarned, 4) }}</p>
                    </div>
                </div>
            </div>

            <!-- Leaderboard -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="heading-font text-xl text-gray-900 mb-4">Таблица лидеров</h2>
                <div class="space-y-3">
                    @forelse($leaderboard as $index => $entry)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-primary text-gray-900 font-bold flex items-center justify-center flex-shrink-0">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex items-center gap-2">
                                    @if($entry->user && $entry->user->avatar)
                                        <img src="{{ asset('storage/' . $entry->user->avatar) }}" alt="{{ $entry->user->name }}" class="w-8 h-8 rounded-full object-cover">
                                    @else
                                        <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center">
                                            <span class="text-xs font-bold text-gray-600">{{ strtoupper(substr($entry->user->name ?? 'U', 0, 1)) }}</span>
                                        </div>
                                    @endif
                                    <span class="font-medium text-gray-900">{{ $entry->user->name ?? 'Игрок' }}</span>
                                </div>
                            </div>
                            <div class="font-bold text-primary">{{ $entry->best_score }}</div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">Пока нет результатов</p>
                    @endforelse
                </div>
            </div>

            <!-- Recent Games -->
            @if(count($recentGames) > 0)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="heading-font text-xl text-gray-900 mb-4">Последние игры</h2>
                <div class="space-y-2">
                    @foreach($recentGames as $game)
                        <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                            <div class="text-sm text-gray-700">
                                {{ $game->score }} мячей
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $game->created_at->format('d.m.Y H:i') }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const gameArea = document.getElementById('gameArea');
    const ball = document.getElementById('ball');
    const startScreen = document.getElementById('startScreen');
    const gameOverScreen = document.getElementById('gameOverScreen');
    const startButton = document.getElementById('startButton');
    const playAgainButton = document.getElementById('playAgainButton');
    const scoreDisplay = document.getElementById('scoreDisplay');
    const scoreValue = document.getElementById('scoreValue');
    const finalScore = document.getElementById('finalScore');
    const gameOverRating = document.getElementById('gameOverRating');
    const loading = document.getElementById('loading');
    
    let gameStartTime = null;
    let isPlaying = false;
    let score = 0;
    let ballSpeed = 2;
    let ballX = 50;
    let ballY = 0;
    let ballDirection = 1; // 1 = вниз, -1 = вверх
    let ballHorizontalSpeed = 0;
    let animationFrame = null;
    let gameStartTimestamp = null;
    
    // Audio context для звуков
    const audioContext = new (window.AudioContext || window.webkitAudioContext)();
    
    function playSound(frequency, duration, type = 'sine') {
        const oscillator = audioContext.createOscillator();
        const gainNode = audioContext.createGain();
        
        oscillator.connect(gainNode);
        gainNode.connect(audioContext.destination);
        
        oscillator.frequency.value = frequency;
        oscillator.type = type;
        
        gainNode.gain.setValueAtTime(0.2, audioContext.currentTime);
        gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + duration);
        
        oscillator.start(audioContext.currentTime);
        oscillator.stop(audioContext.currentTime + duration);
    }
    
    function startGame() {
        isPlaying = true;
        score = 0;
        ballSpeed = 2;
        ballX = 50;
        ballY = 0;
        ballDirection = 1;
        ballHorizontalSpeed = 0;
        gameStartTime = Math.floor(Date.now() / 1000);
        gameStartTimestamp = Date.now();
        
        startScreen.style.display = 'none';
        scoreDisplay.style.display = 'block';
        ball.style.display = 'block';
        
        // Начальная позиция мяча
        resetBall();
        
        // Запускаем игровой цикл
        gameLoop();
        
        // Фоновая музыка
        playSound(300, 0.3, 'sine');
    }
    
    function resetBall() {
        // Случайная позиция X
        ballX = 20 + Math.random() * 60;
        ballY = 5; // Начинаем выше, чтобы мяч падал с самого верха
        ballHorizontalSpeed = (Math.random() - 0.5) * 0.5; // Случайное горизонтальное движение
    }
    
    function gameLoop() {
        if (!isPlaying) return;
        
        // Обновляем позицию мяча
        if (ballDirection === 1) {
            // Мяч падает
            ballY += ballSpeed;
            
            // Увеличиваем скорость со временем
            ballSpeed = Math.min(ballSpeed + 0.01, 8);
            
            // Горизонтальное движение (увеличивается со временем)
            ballX += ballHorizontalSpeed;
            ballHorizontalSpeed += (Math.random() - 0.5) * 0.1;
            
            // Ограничиваем горизонтальное движение
            if (ballX < 10) {
                ballX = 10;
                ballHorizontalSpeed *= -0.5;
            }
            if (ballX > 90) {
                ballX = 90;
                ballHorizontalSpeed *= -0.5;
            }
            
            // Если мяч упал вниз - игра окончена
            // Игра заканчивается, когда мяч опускается ниже 95% высоты экрана
            if (ballY >= 95) {
                endGame();
                return;
            }
        } else {
            // Мяч летит вверх
            ballY -= ballSpeed * 1.5;
            
            if (ballY < 5) {
                // Мяч достиг верха - сбрасываем
                score++;
                scoreValue.textContent = score;
                
                // Звук набивания
                playSound(400 + score * 10, 0.15, 'square');
                
                // Увеличиваем сложность
                ballSpeed = Math.min(ballSpeed + 0.2, 8);
                ballDirection = 1;
                resetBall();
            }
        }
        
        // Обновляем позицию мяча на экране
        ball.style.left = ballX + '%';
        ball.style.top = ballY + '%';
        ball.style.transform = 'translate(-50%, -50%)';
        
        // Продолжаем цикл
        animationFrame = requestAnimationFrame(gameLoop);
    }
    
    function endGame() {
        isPlaying = false;
        if (animationFrame) {
            cancelAnimationFrame(animationFrame);
        }
        
        ball.style.display = 'none';
        scoreDisplay.style.display = 'none';
        
        // Звук окончания игры
        playSound(200, 0.3, 'square');
        
        // Показываем экран окончания игры
        finalScore.textContent = score;
        const ratingEarned = (score * 0.0001).toFixed(4);
        gameOverRating.textContent = `+${ratingEarned} к рейтингу`;
        
        gameOverScreen.classList.remove('hidden');
        
        // Сохраняем результат
        saveResult();
    }
    
    function saveResult() {
        loading.classList.remove('hidden');
        
        const duration = Math.floor((Date.now() - gameStartTimestamp) / 1000);
        
        fetch('{{ route("games.keepie-uppie.play") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                score: score,
                duration: duration,
                start_time: gameStartTime
            })
        })
        .then(response => response.json())
        .then(data => {
            loading.classList.add('hidden');
            
            if (data.success) {
                // Обновляем текст с реальным рейтингом
                gameOverRating.textContent = data.message;
            } else {
                alert(data.message || 'Произошла ошибка');
            }
        })
        .catch(error => {
            loading.classList.add('hidden');
            console.error('Error:', error);
            alert('Произошла ошибка при сохранении результата');
        });
    }
    
    function resetGame() {
        gameOverScreen.classList.add('hidden');
        startScreen.style.display = 'flex';
        score = 0;
        ballSpeed = 2;
        ball.style.display = 'none';
        scoreDisplay.style.display = 'none';
        
        // Перезагружаем страницу для обновления статистики
        setTimeout(() => {
            window.location.reload();
        }, 500);
    }
    
    // Обработчики событий
    startButton.addEventListener('click', startGame);
    playAgainButton.addEventListener('click', resetGame);
    
    // Клик по мячу
    ball.addEventListener('click', function(e) {
        if (!isPlaying) return;
        e.stopPropagation();
        
        // Проверяем, что мяч падает (можно кликнуть на любом уровне)
        if (ballDirection === 1) {
            // Подбрасываем мяч
            ballDirection = -1;
            
            // Звук клика
            playSound(500, 0.1, 'square');
        }
    });
    
    // Клик по игровой области (если клик рядом с мячом)
    gameArea.addEventListener('click', function(e) {
        if (!isPlaying) return;
        
        // Проверяем, что клик не по мячу напрямую
        if (e.target === ball || e.target.closest('#ball')) return;
        
        // Получаем позицию мяча на экране
        const ballRect = ball.getBoundingClientRect();
        const ballCenterX = ballRect.left + ballRect.width / 2;
        const ballCenterY = ballRect.top + ballRect.height / 2;
        
        // Расстояние от клика до центра мяча
        const distance = Math.sqrt(
            Math.pow(e.clientX - ballCenterX, 2) + 
            Math.pow(e.clientY - ballCenterY, 2)
        );
        
        // Увеличиваем область клика до 120px и убираем ограничение по высоте
        if (distance < 120 && ballDirection === 1) {
            ballDirection = -1;
            playSound(500, 0.1, 'square');
        }
    });
});
</script>

<style>
#ball {
    cursor: pointer;
    z-index: 10;
}

#ball:hover {
    transform: translate(-50%, -50%) scale(1.1);
}

#gameArea {
    cursor: crosshair;
}
</style>
@endsection

