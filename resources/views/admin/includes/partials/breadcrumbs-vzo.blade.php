@if (isset($breadcrumbs))
    <ol class="breadcrumb" style="margin: 15px;">
        <li><a href="/admin/dashboard">Панель управления</a></li>
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!$loop->last)
                <li><a href="{{ $breadcrumb['link'] }}">{{ $breadcrumb['h1'] }}</a></li>
            @else
                <li class="active">{{ $breadcrumb['h1'] }}</li>
            @endif
        @endforeach
    </ol>
@endif