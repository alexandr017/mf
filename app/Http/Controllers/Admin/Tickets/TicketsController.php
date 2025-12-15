<?php

namespace App\Http\Controllers\Admin\Tickets;

use App\Helpers\ActivityLogHelper;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Tickets\TicketMessageRequest;
use App\Http\Requests\Admin\Tickets\TicketRequest;
use App\Models\Tickets\Ticket;
use App\Models\Tickets\TicketMessage;
use App\Models\User;
use App\Repositories\Admin\Tickets\TicketRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class TicketsController extends AdminController
{
    protected TicketRepository $ticketRepository;

    public function __construct()
    {
        parent::__construct();
        $this->ticketRepository = app(TicketRepository::class);
    }

    public function index(Request $request): View
    {
        $breadcrumbs = [['h1' => 'Тикеты']];

        return view('admin.tickets.index', compact('breadcrumbs'));
    }

    /**
     * Получить данные для DataTables (AJAX)
     */
    public function dataTables(Request $request): \Illuminate\Http\JsonResponse
    {
        $params = $request->all();

        // Добавляем фильтры из параметров
        $params['status'] = $request->get('status') ?: null;
        $params['priority'] = $request->get('priority') ?: null;
        $params['created_by_user_id'] = $request->get('created_by_user_id') ?: null;
        $params['assigned_to_user_id'] = $request->get('assigned_to_user_id') ?: null;

        $result = $this->ticketRepository->getForDataTables($params);

        $data = [];
        foreach ($result['data'] as $ticket) {
            $data[] = [
                'id' => $ticket->id,
                'subject' => $ticket->subject,
                'created_by_name' => $ticket->createdBy ? $ticket->createdBy->name . ' (' . $ticket->createdBy->email . ')' : '-',
                'assigned_to_name' => $ticket->assignedTo ? $ticket->assignedTo->name . ' (' . $ticket->assignedTo->email . ')' : '-',
                'status' => $ticket->status,
                'priority' => $ticket->priority,
                'messages_count' => $ticket->messages_count ?? $ticket->messages->count(),
                'created_at' => $ticket->created_at->format('d.m.Y H:i'),
            ];
        }

        return response()->json([
            'draw' => intval($params['draw'] ?? 1),
            'recordsTotal' => $result['recordsTotal'],
            'recordsFiltered' => $result['recordsFiltered'],
            'data' => $data,
        ]);
    }

    /**
     * Поиск пользователей через AJAX
     */
    public function searchUsers(Request $request): \Illuminate\Http\JsonResponse
    {
        $search = $request->get('q', '');

        $users = User::where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->limit(20)
            ->get(['id', 'name', 'email']);

        $results = [];
        foreach ($users as $user) {
            $results[] = [
                'id' => $user->id,
                'text' => $user->name . ' (' . $user->email . ')',
            ];
        }

        return response()->json(['results' => $results]);
    }

    public function create(): View
    {
        $users = User::orderBy('name')->limit(1000)->get(['id', 'name']);
        $breadcrumbs = [
            ['h1' => 'Тикеты', 'link' => route('admin.tickets.index')],
            ['h1' => 'Создание'],
        ];
        return view('admin.tickets.create', compact('users', 'breadcrumbs'));
    }

    public function store(TicketRequest $request): RedirectResponse
    {
        $data = $request->all();
        $data = empty_str_to_null($data);

        $ticket = new Ticket($data);
        $result = $ticket->save();

        if ($result) {
            ActivityLogHelper::logCreate($ticket);
            return redirect()
                ->route('admin.tickets.show', $ticket->id)
                ->with('flash_success', 'Тикет создан!');
        }

        return redirect()
            ->route('admin.tickets.index')
            ->with('flash_errors', 'Ошибка создания!');
    }

    public function show(string $id): View
    {
        $ticket = $this->ticketRepository->findOrFail($id);
        $users = User::orderBy('name')->limit(1000)->get(['id', 'name']);
        $breadcrumbs = [
            ['h1' => 'Тикеты', 'link' => route('admin.tickets.index')],
            ['h1' => 'Просмотр'],
        ];

        return view('admin.tickets.show', compact('ticket', 'users', 'breadcrumbs'));
    }

    public function edit(string $id): View
    {
        $ticket = $this->ticketRepository->findOrFail($id);
        $users = User::orderBy('name')->limit(1000)->get(['id', 'name']);
        $breadcrumbs = [
            ['h1' => 'Тикеты', 'link' => route('admin.tickets.index')],
            ['h1' => 'Редактирование'],
        ];

        return view('admin.tickets.edit', compact('ticket', 'users', 'breadcrumbs'));
    }

    public function update(TicketRequest $request, string $id): RedirectResponse
    {
        $ticket = $this->ticketRepository->findOrFail($id);
        $data = $request->all();
        $data = empty_str_to_null($data);

        // Если статус меняется на closed или resolved, устанавливаем closed_at
        if (in_array($data['status'], ['closed', 'resolved']) && $ticket->status !== $data['status']) {
            $data['closed_at'] = now();
        } elseif (!in_array($data['status'], ['closed', 'resolved'])) {
            $data['closed_at'] = null;
        }

        $oldData = $ticket->getOriginal();
        $result = $ticket->update($data);

        if ($result) {
            $changes = array_diff_assoc($ticket->getAttributes(), $oldData);
            ActivityLogHelper::logUpdate($ticket, $changes);
            return redirect()
                ->route('admin.tickets.show', $ticket->id)
                ->with('flash_success', 'Тикет обновлен!');
        }

        return redirect()
            ->route('admin.tickets.index')
            ->with('flash_errors', 'Ошибка обновления!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $ticket = $this->ticketRepository->findOrFail($id);
        $result = $ticket->delete();

        if ($result) {
            ActivityLogHelper::logDelete($ticket);
            return redirect()
                ->route('admin.tickets.index')
                ->with('flash_success', 'Тикет удален!');
        }

        return redirect()
            ->route('admin.tickets.index')
            ->with('flash_errors', 'Ошибка удаления!');
    }

    public function addMessage(TicketMessageRequest $request, string $id): RedirectResponse
    {
        $ticket = $this->ticketRepository->findOrFail($id);
        $data = $request->all();
        $data['is_admin'] = $request->has('is_admin') ? true : false;

        $message = new TicketMessage($data);
        $result = $message->save();

        if ($result) {
            // Если тикет был закрыт и админ отвечает, меняем статус на in_progress
            if ($ticket->status === 'closed' && $data['is_admin']) {
                $ticket->update(['status' => 'in_progress', 'closed_at' => null]);
            }

            ActivityLogHelper::log('ticket_message_added', $ticket, "Добавлено сообщение в тикет #{$ticket->id}");

            return redirect()
                ->route('admin.tickets.show', $ticket->id)
                ->with('flash_success', 'Сообщение добавлено!');
        }

        return redirect()
            ->route('admin.tickets.show', $ticket->id)
            ->with('flash_errors', 'Ошибка добавления сообщения!');
    }
}

