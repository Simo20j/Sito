@if (session('status'))
    <div style="color: #00ffcc; font-size: 14px; margin-bottom: 15px; text-align: center;">
        {{ session('status') }}
    </div>
@endif

@foreach ($errors->all() as $error)
    <div style="color: #ff4d4d; font-size: 14px; margin-bottom: 15px; text-align: center;">
        {{ $error }}
    </div>
@endforeach
