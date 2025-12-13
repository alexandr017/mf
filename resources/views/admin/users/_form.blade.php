<div class="form-group">
    <label for="name"><i class="red">*</i> Имя</label>
    <input type="text" class="form-control" name="name" id="name" required
           @if(old('name'))
               value="{{old('name')}}"
           @else
               @if(isset($item))
                   value="{{$item->name}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="email"><i class="red">*</i> Email</label>
    <input type="email" class="form-control" name="email" id="email" required
           @if(old('email'))
               value="{{old('email')}}"
           @else
               @if(isset($item))
                   value="{{$item->email}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="password">@if(!isset($item))<i class="red">*</i>@endif Пароль</label>
    <input type="password" class="form-control" name="password" id="password" @if(!isset($item)) required @endif>
    @if(isset($item))
        <small class="form-text text-muted">Оставьте пустым, если не хотите менять пароль</small>
    @endif
</div>

<div class="form-group" id="password_confirmation_group" @if(isset($item)) style="display: none;" @endif>
    <label for="password_confirmation">@if(!isset($item))<i class="red">*</i>@endif Подтверждение пароля</label>
    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" @if(!isset($item)) required @endif>
</div>

@if(isset($item))
<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const passwordConfirmationGroup = document.getElementById('password_confirmation_group');
    const passwordConfirmationInput = document.getElementById('password_confirmation');
    
    if (passwordInput && passwordConfirmationGroup && passwordConfirmationInput) {
        passwordInput.addEventListener('input', function() {
            if (this.value.length > 0) {
                passwordConfirmationGroup.style.display = 'block';
                passwordConfirmationInput.required = true;
            } else {
                passwordConfirmationGroup.style.display = 'none';
                passwordConfirmationInput.required = false;
                passwordConfirmationInput.value = '';
            }
        });
    }
});
</script>
@endif

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="goals">Голы</label>
            <input type="number" class="form-control" name="goals" id="goals" min="0" value="0"
                   @if(old('goals') !== null)
                       value="{{old('goals')}}"
                   @else
                       @if(isset($item))
                           value="{{$item->goals ?? 0}}"
                       @endif
                   @endif
            >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="assists">Голевые передачи</label>
            <input type="number" class="form-control" name="assists" id="assists" min="0" value="0"
                   @if(old('assists') !== null)
                       value="{{old('assists')}}"
                   @else
                       @if(isset($item))
                           value="{{$item->assists ?? 0}}"
                       @endif
                   @endif
            >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="rating">Рейтинг</label>
            <input type="number" class="form-control" name="rating" id="rating" min="0" max="100" step="0.01" value="0"
                   @if(old('rating') !== null)
                       value="{{old('rating')}}"
                   @else
                       @if(isset($item))
                           value="{{$item->rating ?? 0}}"
                       @endif
                   @endif
            >
        </div>
    </div>
</div>

<div class="form-group">
    <label for="referral_code">Реферальный код</label>
    <div class="input-group">
        <input type="text" class="form-control" name="referral_code" id="referral_code" maxlength="255"
               @if(old('referral_code'))
                   value="{{old('referral_code')}}"
               @else
                   @if(isset($item))
                       value="{{$item->referral_code}}"
                   @endif
               @endif
        >
        <div class="input-group-append">
            <button type="button" class="btn btn-default" id="generate-referral-code" title="Сгенерировать код">
                <i class="fa fa-refresh"></i>
            </button>
        </div>
    </div>
    <small class="form-text text-muted">Оставьте пустым для автоматической генерации</small>
</div>

<div class="form-group">
    <label for="referred_by_id">Приглашен пользователем</label>
    <select class="form-control" name="referred_by_id" id="referred_by_id">
        <option value="">Не приглашен</option>
        @foreach($users as $user)
            <option value="{{$user->id}}"
                    @if((old('referred_by_id') == $user->id) || (isset($item) && $item->referred_by_id == $user->id))
                        selected
                    @endif>
                {{$user->name}} ({{$user->email}}) @if($user->referral_code) [{{$user->referral_code}}] @endif
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="referrals_count">Количество рефералов</label>
    <input type="number" class="form-control" name="referrals_count" id="referrals_count" min="0" value="0"
           @if(old('referrals_count') !== null)
               value="{{old('referrals_count')}}"
           @else
               @if(isset($item))
                   value="{{$item->referrals_count ?? 0}}"
               @endif
           @endif
    >
    <small class="form-text text-muted">Количество пользователей, приглашенных этим пользователем</small>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const generateBtn = document.getElementById('generate-referral-code');
    const referralCodeInput = document.getElementById('referral_code');
    
    if (generateBtn && referralCodeInput) {
        generateBtn.addEventListener('click', function() {
            // Генерируем случайный код из 8 символов
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let code = '';
            for (let i = 0; i < 8; i++) {
                code += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            referralCodeInput.value = code;
        });
    }
});
</script>

