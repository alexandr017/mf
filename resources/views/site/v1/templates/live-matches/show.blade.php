@extends('site.v1.layouts.default')

@section('title', 'Матч: ' . $match->homeTeam->name . ' vs ' . $match->awayTeam->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Match Header -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="flex items-center space-x-4 mb-4 md:mb-0">
                <div class="text-center">
                    <div class="text-2xl font-bold">{{ $match->homeTeam->name }}</div>
                    <div class="text-sm text-gray-500">{{ $match->homeTeam->city ?? '' }}</div>
                </div>
                <div class="text-4xl font-bold text-primary">VS</div>
                <div class="text-center">
                    <div class="text-2xl font-bold">{{ $match->awayTeam->name }}</div>
                    <div class="text-sm text-gray-500">{{ $match->awayTeam->city ?? '' }}</div>
                </div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold" id="score">
                    <span id="score-1">0</span> : <span id="score-2">0</span>
                </div>
                <div class="text-sm text-gray-500 mt-2">
                    <span id="match-status">{{ $liveMatch->status === 'live' ? 'Идет матч' : 'Ожидание' }}</span>
                    <span id="match-minute" class="ml-2"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Match Field -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold">Поле</h2>
            <div class="text-sm text-gray-500">
                <span id="field-status">Загрузка...</span>
            </div>
        </div>
        <div class="relative bg-gradient-to-b from-green-400 to-green-600 rounded-lg overflow-hidden shadow-inner" style="height: 600px; min-height: 400px;">
            <canvas id="match-field" width="1000" height="600" class="w-full h-full"></canvas>
        </div>
    </div>

    <!-- Events Timeline -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-bold mb-4">События матча</h2>
        <div id="events-timeline" class="space-y-2">
            <!-- Events will be loaded here -->
        </div>
    </div>
</div>

<script>
(function() {
    const matchId = {{ $match->id }};
    const fieldCanvas = document.getElementById('match-field');
    const ctx = fieldCanvas.getContext('2d');
    
    // Масштабирование canvas
    function resizeCanvas() {
        const container = fieldCanvas.parentElement;
        const containerWidth = container.clientWidth;
        const aspectRatio = 1000 / 600;
        fieldCanvas.width = containerWidth;
        fieldCanvas.height = containerWidth / aspectRatio;
        fieldCanvas.style.width = containerWidth + 'px';
        fieldCanvas.style.height = (containerWidth / aspectRatio) + 'px';
    }
    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);

    let matchState = null;
    let lastEventIndex = 0;

    // Рисуем поле
    function drawField() {
        const width = fieldCanvas.width;
        const height = fieldCanvas.height;
        
        ctx.clearRect(0, 0, width, height);
        
        // Трава
        ctx.fillStyle = '#4ade80';
        ctx.fillRect(0, 0, width, height);
        
        // Центральная линия
        ctx.strokeStyle = '#ffffff';
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.moveTo(width / 2, 0);
        ctx.lineTo(width / 2, height);
        ctx.stroke();
        
        // Центральный круг
        ctx.beginPath();
        ctx.arc(width / 2, height / 2, 50, 0, Math.PI * 2);
        ctx.stroke();
        
        // Ворота
        const goalWidth = 20;
        const goalHeight = 80;
        
        // Левые ворота
        ctx.strokeStyle = '#ffffff';
        ctx.lineWidth = 3;
        ctx.strokeRect(0, height / 2 - goalHeight / 2, goalWidth, goalHeight);
        
        // Правые ворота
        ctx.strokeRect(width - goalWidth, height / 2 - goalHeight / 2, goalWidth, goalHeight);
        
        // Штрафные площади
        ctx.strokeRect(0, height / 2 - 120, 100, 240);
        ctx.strokeRect(width - 100, height / 2 - 120, 100, 240);
    }

    // Рисуем игроков
    function drawPlayers(positions) {
        if (!positions) return;
        
        const width = fieldCanvas.width;
        const height = fieldCanvas.height;
        
        // Команда 1 (слева, синие)
        if (positions.team1) {
            positions.team1.forEach((player, index) => {
                const x = (player.x / 100) * width;
                const y = (player.y / 100) * height;
                
                // Рисуем круг игрока
                ctx.fillStyle = '#3b82f6';
                ctx.beginPath();
                ctx.arc(x, y, 10, 0, Math.PI * 2);
                ctx.fill();
                
                ctx.strokeStyle = '#ffffff';
                ctx.lineWidth = 2;
                ctx.stroke();
                
                // Номер игрока
                ctx.fillStyle = '#ffffff';
                ctx.font = 'bold 10px Arial';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillText((index + 1).toString(), x, y);
            });
        }
        
        // Команда 2 (справа, красные)
        if (positions.team2) {
            positions.team2.forEach((player, index) => {
                const x = (player.x / 100) * width;
                const y = (player.y / 100) * height;
                
                // Рисуем круг игрока
                ctx.fillStyle = '#ef4444';
                ctx.beginPath();
                ctx.arc(x, y, 10, 0, Math.PI * 2);
                ctx.fill();
                
                ctx.strokeStyle = '#ffffff';
                ctx.lineWidth = 2;
                ctx.stroke();
                
                // Номер игрока
                ctx.fillStyle = '#ffffff';
                ctx.font = 'bold 10px Arial';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillText((index + 1).toString(), x, y);
            });
        }
    }

    // Обновляем события
    function updateEvents(events) {
        const timeline = document.getElementById('events-timeline');
        const newEvents = events.slice(lastEventIndex);
        
        newEvents.forEach(event => {
            const eventDiv = document.createElement('div');
            eventDiv.className = 'flex items-center space-x-2 p-2 bg-gray-50 rounded';
            
            const icon = event.type === 'goal' ? '⚽' : '🎯';
            const teamClass = event.team === 1 ? 'text-blue-600' : 'text-red-600';
            
            eventDiv.innerHTML = `
                <span class="text-2xl">${icon}</span>
                <span class="font-semibold ${teamClass}">${event.minute}'</span>
                <span>${event.scorer_name}</span>
                ${event.assister_name ? `<span class="text-gray-500">(передача: ${event.assister_name})</span>` : ''}
            `;
            
            timeline.insertBefore(eventDiv, timeline.firstChild);
        });
        
        lastEventIndex = events.length;
    }

    // Обновляем счет
    function updateScore(score1, score2) {
        document.getElementById('score-1').textContent = score1;
        document.getElementById('score-2').textContent = score2;
    }

    // Обновляем статус
    function updateStatus(state) {
        const statusEl = document.getElementById('match-status');
        const minuteEl = document.getElementById('match-minute');
        const fieldStatusEl = document.getElementById('field-status');
        
        if (state.status === 'live') {
            statusEl.textContent = 'Идет матч';
            statusEl.className = 'text-green-600 font-semibold';
            minuteEl.textContent = `${state.current_minute}'`;
            fieldStatusEl.textContent = `Минута ${state.current_minute} из 90`;
        } else if (state.status === 'finished') {
            statusEl.textContent = 'Матч завершен';
            statusEl.className = 'text-gray-600';
            minuteEl.textContent = '90\'';
            fieldStatusEl.textContent = 'Матч завершен';
        } else {
            statusEl.textContent = 'Ожидание';
            statusEl.className = 'text-yellow-600';
            minuteEl.textContent = '';
            fieldStatusEl.textContent = 'Ожидание начала матча';
        }
    }

    // Загружаем состояние матча
    async function loadMatchState() {
        try {
            const response = await fetch(`/live-matches/${matchId}/state?t=${Date.now()}`);
            const state = await response.json();
            
            if (state.error) {
                console.error('Error loading match state:', state.error);
                return;
            }
            
            matchState = state;
            
            // Обновляем UI
            updateScore(state.score_1, state.score_2);
            updateStatus(state);
            updateEvents(state.events || []);
            
            // Перерисовываем поле
            drawField();
            drawPlayers(state.players_positions);
            
        } catch (error) {
            console.error('Error loading match state:', error);
        }
    }

    // Инициализация
    drawField();
    loadMatchState();
    
    // Обновляем каждые 2 секунды (для снижения нагрузки)
    // Можно увеличить до 3-5 секунд для еще большей оптимизации
    setInterval(() => {
        loadMatchState();
    }, 2000);
})();
</script>
@endsection

