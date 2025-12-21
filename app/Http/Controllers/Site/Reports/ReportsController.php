<?php

namespace App\Http\Controllers\Site\Reports;

use App\Http\Controllers\Controller;
use App\Models\Reports\UserReport;
use App\Models\Reports\ReportCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportsController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reported_user_id' => 'required|exists:users,id',
            'category_id' => 'required|integer|in:' . implode(',', array_keys(ReportCategory::getAll())),
            'description' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $reportedUser = User::findOrFail($request->reported_user_id);

        // Проверка на самопожалобу
        if (auth()->check() && auth()->id() === $reportedUser->id) {
            return back()->withErrors(['error' => 'Нельзя подать жалобу на самого себя'])->withInput();
        }

        $data = [
            'reported_user_id' => $request->reported_user_id,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'status' => 'pending',
        ];

        // Если пользователь авторизован
        if (auth()->check()) {
            $data['reporter_user_id'] = auth()->id();
        } else {
            // Для незарегистрированных пользователей
            $data['reporter_email'] = $request->input('reporter_email');
            $data['reporter_ip'] = $request->ip();
            
            // TODO: Добавить дополнительную проверку (капча, лимиты и т.д.)
        }

        UserReport::create($data);

        return back()->with('success', 'Жалоба успешно отправлена. Мы рассмотрим её в ближайшее время.');
    }
}

