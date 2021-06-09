@if(session('flash_messages') && is_array(session('flash_messages')))
    @foreach(session('flash_messages') as $message)
        <div class="container pt-3">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="alert alert-{{ $message['type'] ?? 'success' }} text-center">
                        {!! $message['text'] ?? null !!}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

