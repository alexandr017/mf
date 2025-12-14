<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Users\UserRequest;
use App\Models\User;
use App\Repositories\Admin\Users\UserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

final class UsersController extends AdminController
{
    protected UserRepository $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = app(UserRepository::class);
    }

    public function index(): View
    {
        $users = $this->userRepository->getForShow(50); // 50 записей на страницу

        $breadcrumbs = [['h1' => 'Пользователи']];

        return view('admin.users.index', compact('users', 'breadcrumbs'));
    }

    public function create(): View
    {
        // Выбираем только нужные поля для выпадающего списка
        $users = User::select('id', 'name')
            ->orderBy('name')
            ->limit(1000) // Ограничиваем до 1000 для выпадающего списка
            ->get();
        $breadcrumbs = [
            ['h1' => 'Пользователи', 'link' => route('admin.users.index')],
            ['h1' => 'Создание'],
        ];
        return view('admin.users.create', compact('users', 'breadcrumbs'));
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $data = $request->all();

        $data = empty_str_to_null($data);

        // Генерируем referral_code, если не указан
        if (empty($data['referral_code'])) {
            $data['referral_code'] = Str::upper(Str::random(8));
        }

        // Хешируем пароль, если он указан
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $item = new User($data);

        $result = $item->save();

        if ($result) {
            return redirect()
                ->route('admin.users.index')
                ->with('flash_success', 'Пользователь создан!');
        }

        return redirect()
            ->route('admin.users.index')
            ->with('flash_errors', 'Ошибка создания!');
    }

    public function edit(string $id): View
    {
        $item = $this->userRepository->findOrFail($id);
        // Выбираем только нужные поля для выпадающего списка
        $users = User::select('id', 'name')
            ->where('id', '!=', $id)
            ->orderBy('name')
            ->limit(1000) // Ограничиваем до 1000 для выпадающего списка
            ->get();
        $breadcrumbs = [
            ['h1' => 'Пользователи', 'link' => route('admin.users.index')],
            ['h1' => 'Редактирование'],
        ];
        return view('admin.users.edit', compact('item', 'users', 'breadcrumbs'));
    }

    public function update(UserRequest $request, string $id): RedirectResponse
    {
        $item = $this->userRepository->findOrFail($id);

        $data = $request->all();

        $data = empty_str_to_null($data);

        // Хешируем пароль, если он указан
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('admin.users.index')
                ->with('flash_success', 'Пользователь обновлен!');
        }

        return redirect()
            ->route('admin.users.index')
            ->with('flash_errors', 'Ошибка обновления!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $item = $this->userRepository->findOrFail($id);

        $result = $item->delete();

        if ($result) {
            return redirect()
                ->route('admin.users.index')
                ->with('flash_success', 'Пользователь удален!');
        }

        return redirect()
            ->route('admin.users.index')
            ->with('flash_errors', 'Ошибка удаления!');
    }
}


