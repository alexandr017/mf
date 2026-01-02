@extends('site.v1.layouts.account')

@section('title', 'Тренировка пробития пенальти')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="heading-font text-4xl text-gray-900 mb-2">Тренировка пробития пенальти</h1>
        <p class="text-gray-600">Выберите угол, куда хотите пробить пенальти. Вратарь случайным образом выберет, куда падать. Если вы угадали - получаете +0.001 к рейтингу!</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Game Area -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <!-- Game Field -->
                <div id="gameArea" class="relative bg-gradient-to-b from-green-400 to-green-600 rounded-lg overflow-hidden" style="height: 500px;">
                    <!-- Goal with Net -->
                    <div class="absolute top-0 left-0 right-0 h-32">
                        <!-- Goal Frame -->
                        <div class="absolute inset-0 border-4 border-white rounded-t-lg">
                            <!-- Goal Net Pattern -->
                            <div class="absolute inset-0 opacity-30" style="background-image: 
                                linear-gradient(to right, rgba(255,255,255,0.3) 1px, transparent 1px),
                                linear-gradient(to bottom, rgba(255,255,255,0.3) 1px, transparent 1px);
                                background-size: 20px 20px;">
                            </div>
                            <!-- Goal Text -->
                            <div class="absolute inset-0 flex justify-center items-center">
                                <div class="text-white text-2xl font-bold drop-shadow-lg">ВОРОТА</div>
                            </div>
                        </div>
                    </div>

                    <!-- Goal Posts -->
                    <div class="absolute top-0 left-0 w-2 h-32 bg-white"></div>
                    <div class="absolute top-0 right-0 w-2 h-32 bg-white"></div>
                    <div class="absolute top-28 left-0 right-0 h-2 bg-white"></div>

                    <!-- Penalty Spot -->
                    <div class="absolute bottom-32 left-1/2 transform -translate-x-1/2 w-4 h-4 bg-white rounded-full shadow-lg"></div>

                    <!-- Player (Ball) -->
                    <div id="playerBall" class="absolute bottom-24 left-1/2 transform -translate-x-1/2 w-16 h-16 transition-all duration-1000" style="display: none;">
                        <div class="w-full h-full bg-white rounded-full flex items-center justify-center shadow-lg">
                            <div class="w-12 h-12 bg-black rounded-full"></div>
                        </div>
                    </div>

                    <!-- Goalkeeper Figure -->
                    <div id="goalkeeper" class="absolute top-16 left-1/2 transform -translate-x-1/2 transition-all duration-1000" style="width: 60px; height: 80px;">
                        <!-- Head -->
                        <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-12 h-12 bg-blue-500 rounded-full border-2 border-white shadow-lg flex items-center justify-center">
                            <div class="w-8 h-8 bg-blue-600 rounded-full"></div>
                        </div>
                        <!-- Body -->
                        <div class="absolute top-10 left-1/2 transform -translate-x-1/2 w-16 h-20 bg-blue-500 rounded-t-2xl border-2 border-white shadow-lg">
                            <!-- Arms -->
                            <div id="goalkeeperLeftArm" class="absolute top-2 -left-4 w-6 h-16 bg-blue-500 rounded-full border-2 border-white transform origin-top transition-all duration-500"></div>
                            <div id="goalkeeperRightArm" class="absolute top-2 -right-4 w-6 h-16 bg-blue-500 rounded-full border-2 border-white transform origin-top transition-all duration-500"></div>
                            <!-- Number -->
                            <div class="absolute top-4 left-1/2 transform -translate-x-1/2 text-white text-xs font-bold">1</div>
                        </div>
                        <!-- Legs -->
                        <div class="absolute top-28 left-1/2 transform -translate-x-1/2 flex space-x-2">
                            <div class="w-5 h-12 bg-blue-500 rounded-full border-2 border-white"></div>
                            <div class="w-5 h-12 bg-blue-500 rounded-full border-2 border-white"></div>
                        </div>
                    </div>

                    <!-- Choice Buttons (размещены в соответствии с шириной ворот) -->
                    <div id="choiceButtons" class="absolute bottom-8 left-0 right-0" style="height: 60px;">
                        <button id="btnLeft" class="choice-btn bg-white hover:bg-gray-100 text-gray-900 font-bold px-4 py-3 rounded-button transition-all duration-300 shadow-lg absolute" data-choice="left" style="left: 10%; transform: translateX(-50%); position: relative;">
                            <div class="flex flex-col items-center">
                                <div class="absolute -top-10 left-1/2 transform -translate-x-1/2">
                                    <i class="ri-arrow-up-line text-3xl text-white drop-shadow-lg" style="transform: rotate(-45deg);"></i>
                                </div>
                                <span class="text-sm">В левый угол</span>
                            </div>
                        </button>
                        <button id="btnCenter" class="choice-btn bg-white hover:bg-gray-100 text-gray-900 font-bold px-4 py-3 rounded-button transition-all duration-300 shadow-lg absolute" data-choice="center" style="left: 50%; transform: translateX(-50%);">
                            <div class="flex flex-col items-center">
                                <div class="absolute -top-10 left-1/2 transform -translate-x-1/2">
                                    <i class="ri-arrow-up-line text-3xl text-white drop-shadow-lg"></i>
                                </div>
                                <span class="text-sm">По центру</span>
                            </div>
                        </button>
                        <button id="btnRight" class="choice-btn bg-white hover:bg-gray-100 text-gray-900 font-bold px-4 py-3 rounded-button transition-all duration-300 shadow-lg absolute" data-choice="right" style="right: 10%; transform: translateX(50%);">
                            <div class="flex flex-col items-center">
                                <div class="absolute -top-10 left-1/2 transform -translate-x-1/2">
                                    <i class="ri-arrow-up-line text-3xl text-white drop-shadow-lg" style="transform: rotate(45deg);"></i>
                                </div>
                                <span class="text-sm">В правый угол</span>
                            </div>
                        </button>
                    </div>

                    <!-- Fireworks Container -->
                    <div id="fireworksContainer" class="absolute inset-0 pointer-events-none hidden" style="z-index: 100;"></div>

                    <!-- Result Message -->
                    <div id="resultMessage" class="absolute inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden" style="z-index: 50;">
                        <div class="bg-white rounded-xl p-8 text-center max-w-md">
                            <div id="resultIcon" class="text-6xl mb-4"></div>
                            <h2 id="resultTitle" class="heading-font text-3xl mb-2"></h2>
                            <p id="resultText" class="text-gray-600 mb-4"></p>
                            <button id="playAgainBtn" class="bg-primary text-gray-900 font-bold px-6 py-3 rounded-button hover:bg-opacity-80 transition-colors">
                                Играть снова
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Loading -->
                <div id="loading" class="hidden text-center mt-4">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div>
                    <p class="mt-2 text-gray-600">Обработка результата...</p>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="space-y-6">
            <!-- Overall Stats -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="heading-font text-xl text-gray-900 mb-4">Статистика</h2>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500">Всего попыток</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalAttempts }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Успешных</p>
                        <p class="text-2xl font-bold text-primary">{{ $successfulAttempts }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Процент успеха</p>
                        <p class="text-2xl font-bold text-secondary">
                            {{ $totalAttempts > 0 ? number_format(($successfulAttempts / $totalAttempts) * 100, 1) : 0 }}%
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Заработано рейтинга</p>
                        <p class="text-2xl font-bold text-blue-600">+{{ number_format($totalRatingEarned, 3) }}</p>
                    </div>
                </div>
            </div>

            <!-- Recent Attempts -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="heading-font text-xl text-gray-900 mb-4">Последние попытки</h2>
                <div class="space-y-2">
                    @forelse($recentAttempts as $attempt)
                        <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                            <div class="flex items-center space-x-2">
                                @if($attempt->is_goal)
                                    <i class="ri-checkbox-circle-fill text-green-500"></i>
                                    <span class="text-sm text-gray-700">Гол</span>
                                @else
                                    <i class="ri-close-circle-fill text-red-500"></i>
                                    <span class="text-sm text-gray-700">Мимо</span>
                                @endif
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $attempt->created_at->format('d.m.Y H:i') }}
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">Пока нет попыток</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const choiceButtons = document.querySelectorAll('.choice-btn');
    const gameArea = document.getElementById('gameArea');
    const playerBall = document.getElementById('playerBall');
    const goalkeeper = document.getElementById('goalkeeper');
    const goalkeeperLeftArm = document.getElementById('goalkeeperLeftArm');
    const goalkeeperRightArm = document.getElementById('goalkeeperRightArm');
    const resultMessage = document.getElementById('resultMessage');
    const resultIcon = document.getElementById('resultIcon');
    const resultTitle = document.getElementById('resultTitle');
    const resultText = document.getElementById('resultText');
    const playAgainBtn = document.getElementById('playAgainBtn');
    const loading = document.getElementById('loading');
    const choiceButtonsContainer = document.getElementById('choiceButtons');
    
    // Audio context для звуков
    const audioContext = new (window.AudioContext || window.webkitAudioContext)();
    
    // Функция для создания звука
    function playSound(frequency, duration, type = 'sine') {
        const oscillator = audioContext.createOscillator();
        const gainNode = audioContext.createGain();
        
        oscillator.connect(gainNode);
        gainNode.connect(audioContext.destination);
        
        oscillator.frequency.value = frequency;
        oscillator.type = type;
        
        gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
        gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + duration);
        
        oscillator.start(audioContext.currentTime);
        oscillator.stop(audioContext.currentTime + duration);
    }
    
    // Фоновая мелодия (тихая, повторяющаяся)
    let backgroundMusicInterval = null;
    function startBackgroundMusic() {
        if (backgroundMusicInterval) return;
        backgroundMusicInterval = setInterval(() => {
            playSound(200, 0.5, 'sine');
        }, 2000);
    }
    
    function stopBackgroundMusic() {
        if (backgroundMusicInterval) {
            clearInterval(backgroundMusicInterval);
            backgroundMusicInterval = null;
        }
    }
    
    // Запускаем фоновую музыку
    startBackgroundMusic();
    
    let gameStartTime = null;
    let isPlaying = false;

    choiceButtons.forEach(button => {
        button.addEventListener('click', function() {
            if (isPlaying) return;
            
            const playerChoice = this.getAttribute('data-choice');
            gameStartTime = Math.floor(Date.now() / 1000);
            isPlaying = true;
            
            // Скрываем кнопки выбора
            choiceButtonsContainer.style.display = 'none';
            
            // Показываем мяч
            playerBall.style.display = 'block';
            
            // Позиции в соответствии с шириной ворот (левая стойка ~15%, центр 50%, правая стойка ~85%)
            const goalPositions = {
                'left': '15%',
                'center': '50%',
                'right': '85%'
            };
            
            const targetX = goalPositions[playerChoice];
            
            // Звук удара по мячу
            playSound(300, 0.2, 'square');
            setTimeout(() => playSound(400, 0.15, 'square'), 100);
            
            // Вратарь прыгает сразу при ударе (случайное направление для визуализации)
            // Реальное направление будет известно только после ответа сервера
            const randomGoalkeeperChoice = ['left', 'center', 'right'][Math.floor(Math.random() * 3)];
            const goalkeeperPositions = {
                'left': '15%',
                'center': '50%',
                'right': '85%'
            };
            
            // Анимация прыжка вратаря (начинается сразу при ударе)
            goalkeeper.style.left = goalkeeperPositions[randomGoalkeeperChoice];
            goalkeeper.style.transition = 'left 0.8s ease-out';
            
            // Анимация рук вратаря (прыжок)
            if (randomGoalkeeperChoice === 'left') {
                goalkeeperLeftArm.style.transform = 'rotate(-45deg)';
                goalkeeperRightArm.style.transform = 'rotate(-20deg)';
            } else if (randomGoalkeeperChoice === 'right') {
                goalkeeperLeftArm.style.transform = 'rotate(20deg)';
                goalkeeperRightArm.style.transform = 'rotate(45deg)';
            } else {
                goalkeeperLeftArm.style.transform = 'rotate(-10deg)';
                goalkeeperRightArm.style.transform = 'rotate(10deg)';
            }
            
            // Звук прыжка вратаря
            playSound(150, 0.3, 'triangle');
            
            // Анимация мяча (длится минимум 5 секунд)
            const animationDuration = 5000; // 5 секунд в миллисекундах
            
            // Анимация удара и полета мяча
            setTimeout(() => {
                playerBall.style.bottom = '80%';
                playerBall.style.left = targetX;
                playerBall.style.transform = 'translate(-50%, -50%)';
                
                // Звук полета мяча
                playSound(500, 0.3, 'sawtooth');
            }, 100);
            
            // Ждем минимум 5 секунд перед отправкой запроса
            setTimeout(() => {
                // Отправляем запрос на сервер
                loading.classList.remove('hidden');
                
                fetch('{{ route("games.penalty-training.play") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    player_choice: playerChoice,
                    start_time: gameStartTime
                })
            })
            .then(response => response.json())
            .then(data => {
                loading.classList.add('hidden');
                
                if (data.success) {
                    // Корректируем позицию вратаря на реальную (если она отличается от визуальной)
                    const goalkeeperPositions = {
                        'left': '15%',
                        'center': '50%',
                        'right': '85%'
                    };
                    
                    const goalkeeperChoice = data.goalkeeper_choice;
                    
                    // Обновляем позицию вратаря на реальную (если нужно)
                    if (goalkeeper.style.left !== goalkeeperPositions[goalkeeperChoice]) {
                        goalkeeper.style.left = goalkeeperPositions[goalkeeperChoice];
                    }
                    
                    // Обновляем анимацию рук на реальную
                    if (goalkeeperChoice === 'left') {
                        goalkeeperLeftArm.style.transform = 'rotate(-45deg)';
                        goalkeeperRightArm.style.transform = 'rotate(-20deg)';
                    } else if (goalkeeperChoice === 'right') {
                        goalkeeperLeftArm.style.transform = 'rotate(20deg)';
                        goalkeeperRightArm.style.transform = 'rotate(45deg)';
                    } else {
                        goalkeeperLeftArm.style.transform = 'rotate(-10deg)';
                        goalkeeperRightArm.style.transform = 'rotate(10deg)';
                    }
                    
                    // Звук пробития (мяч попадает или нет)
                    setTimeout(() => {
                        if (data.is_goal) {
                            // Звук гола
                            playSound(600, 0.4, 'sine');
                            setTimeout(() => playSound(800, 0.3, 'sine'), 200);
                            setTimeout(() => playSound(1000, 0.2, 'sine'), 400);
                            
                            // Запускаем фейерверк
                            startFireworks();
                        } else {
                            // Звук отбитого мяча
                            playSound(200, 0.2, 'square');
                        }
                    }, 800);
                    
                    // Показываем результат
                    setTimeout(() => {
                        if (data.is_goal) {
                            resultIcon.innerHTML = '<i class="ri-checkbox-circle-fill text-green-500"></i>';
                            resultTitle.textContent = 'ГОЛ!';
                            resultTitle.className = 'heading-font text-3xl mb-2 text-green-500';
                            resultText.textContent = data.message;
                        } else {
                            resultIcon.innerHTML = '<i class="ri-close-circle-fill text-red-500"></i>';
                            resultTitle.textContent = 'Вратарь отбил!';
                            resultTitle.className = 'heading-font text-3xl mb-2 text-red-500';
                            resultText.textContent = data.message;
                        }
                        
                        resultMessage.classList.remove('hidden');
                    }, 1500);
                } else {
                    alert(data.message || 'Произошла ошибка');
                    resetGame();
                }
            })
            .catch(error => {
                loading.classList.add('hidden');
                console.error('Error:', error);
                alert('Произошла ошибка при отправке запроса');
                resetGame();
            });
            }, animationDuration);
        });
    });

    playAgainBtn.addEventListener('click', function() {
        resetGame();
    });

    // Функция для создания фейерверка
    function startFireworks() {
        const fireworksContainer = document.getElementById('fireworksContainer');
        fireworksContainer.classList.remove('hidden');
        fireworksContainer.innerHTML = '';
        
        const colors = ['#FFD700', '#FF6B6B', '#4ECDC4', '#45B7D1', '#FFA07A', '#98D8C8', '#F7DC6F'];
        const fireworkCount = 15;
        
        for (let i = 0; i < fireworkCount; i++) {
            setTimeout(() => {
                createFirework(
                    Math.random() * 100 + '%',
                    Math.random() * 50 + 10 + '%',
                    colors[Math.floor(Math.random() * colors.length)]
                );
            }, i * 200);
        }
        
        // Скрываем фейерверк через 3 секунды
        setTimeout(() => {
            fireworksContainer.classList.add('hidden');
            fireworksContainer.innerHTML = '';
        }, 3000);
    }
    
    function createFirework(x, y, color) {
        const firework = document.createElement('div');
        firework.style.position = 'absolute';
        firework.style.left = x;
        firework.style.top = y;
        firework.style.width = '4px';
        firework.style.height = '4px';
        firework.style.backgroundColor = color;
        firework.style.borderRadius = '50%';
        firework.style.boxShadow = `0 0 10px ${color}`;
        
        const fireworksContainer = document.getElementById('fireworksContainer');
        fireworksContainer.appendChild(firework);
        
        // Анимация взрыва
        const particles = 12;
        const angleStep = (2 * Math.PI) / particles;
        
        for (let i = 0; i < particles; i++) {
            const particle = document.createElement('div');
            particle.style.position = 'absolute';
            particle.style.left = x;
            particle.style.top = y;
            particle.style.width = '3px';
            particle.style.height = '3px';
            particle.style.backgroundColor = color;
            particle.style.borderRadius = '50%';
            particle.style.boxShadow = `0 0 8px ${color}`;
            
            const angle = i * angleStep;
            const distance = 80 + Math.random() * 40;
            const vx = Math.cos(angle) * distance;
            const vy = Math.sin(angle) * distance;
            
            fireworksContainer.appendChild(particle);
            
            // Анимация частицы
            particle.animate([
                { transform: 'translate(0, 0) scale(1)', opacity: 1 },
                { transform: `translate(${vx}px, ${vy}px) scale(0)`, opacity: 0 }
            ], {
                duration: 1000 + Math.random() * 500,
                easing: 'ease-out'
            }).onfinish = () => particle.remove();
        }
        
        // Удаляем центральную точку
        setTimeout(() => firework.remove(), 100);
    }

    function resetGame() {
        isPlaying = false;
        gameStartTime = null;
        
        // Сбрасываем позиции
        playerBall.style.display = 'none';
        playerBall.style.bottom = '24%';
        playerBall.style.left = '50%';
        playerBall.style.transform = 'translate(-50%, 0)';
        
        goalkeeper.style.left = '50%';
        goalkeeper.style.transform = 'translate(-50%, 0)';
        goalkeeper.style.transition = 'left 0.5s ease-out';
        
        // Сбрасываем руки вратаря
        goalkeeperLeftArm.style.transform = 'rotate(0deg)';
        goalkeeperRightArm.style.transform = 'rotate(0deg)';
        
        // Показываем кнопки
        choiceButtonsContainer.style.display = 'block';
        
        // Скрываем результат
        resultMessage.classList.add('hidden');
        
        // Скрываем фейерверк
        const fireworksContainer = document.getElementById('fireworksContainer');
        fireworksContainer.classList.add('hidden');
        fireworksContainer.innerHTML = '';
        
        // Перезагружаем страницу для обновления статистики
        setTimeout(() => {
            window.location.reload();
        }, 1000);
    }
});
</script>

<style>
.choice-btn {
    min-width: 120px;
}

.choice-btn:hover {
    transform: translateY(-2px);
}

#playerBall {
    z-index: 10;
}

#goalkeeper {
    z-index: 5;
}
</style>
@endsection

