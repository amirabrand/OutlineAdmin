@extends('layouts.app')

@section('content')
    <div class="card m-5 p-1">
        <div class="card-body">
            <div class="card-title d-flex justify-content-between align-items-center">
                <h5>{{ $server->name }}</h5>
                <a class="btn btn-outline-light btn-sm" href="{{ route('servers.edit', $server->id) }}">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <defs>
                            <symbol id="lineMdCog0">
                                <path fill="none" stroke-width="2" d="M15.24 6.37C15.65 6.6 16.04 6.88 16.38 7.2C16.6 7.4 16.8 7.61 16.99 7.83C17.46 8.4 17.85 9.05 18.11 9.77C18.2 10.03 18.28 10.31 18.35 10.59C18.45 11.04 18.5 11.52 18.5 12"><animate fill="freeze" attributeName="d" begin="0.8s" dur="0.2s" values="M15.24 6.37C15.65 6.6 16.04 6.88 16.38 7.2C16.6 7.4 16.8 7.61 16.99 7.83C17.46 8.4 17.85 9.05 18.11 9.77C18.2 10.03 18.28 10.31 18.35 10.59C18.45 11.04 18.5 11.52 18.5 12;M15.24 6.37C15.65 6.6 16.04 6.88 16.38 7.2C16.38 7.2 19 6.12 19.01 6.14C19.01 6.14 20.57 8.84 20.57 8.84C20.58 8.87 18.35 10.59 18.35 10.59C18.45 11.04 18.5 11.52 18.5 12"/></path>
                            </symbol>
                        </defs>
                        <g fill="none" stroke="currentColor" stroke-width="2">
                            <g stroke-linecap="round" stroke-linejoin="round">
                                <path stroke-dasharray="42" stroke-dashoffset="42" d="M12 5.5C15.59 5.5 18.5 8.41 18.5 12C18.5 15.59 15.59 18.5 12 18.5C8.41 18.5 5.5 15.59 5.5 12C5.5 8.41 8.41 5.5 12 5.5z" opacity="0">
                                    <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.2s" dur="0.5s" values="42;0"/>
                                    <set attributeName="opacity" begin="0.2s" to="1"/>
                                    <set attributeName="opacity" begin="0.7s" to="0"/>
                                </path>
                                <path stroke-dasharray="20" stroke-dashoffset="20" d="M12 9C13.66 9 15 10.34 15 12C15 13.66 13.66 15 12 15C10.34 15 9 13.66 9 12C9 10.34 10.34 9 12 9z">
                                    <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.2s" values="20;0"/>
                                </path>
                            </g>
                            <g opacity="0"><use href="#lineMdCog0"/>
                                <use href="#lineMdCog0" transform="rotate(60 12 12)"/>
                                <use href="#lineMdCog0" transform="rotate(120 12 12)"/>
                                <use href="#lineMdCog0" transform="rotate(180 12 12)"/>
                                <use href="#lineMdCog0" transform="rotate(240 12 12)"/>
                                <use href="#lineMdCog0" transform="rotate(300 12 12)"/>
                                <set attributeName="opacity" begin="0.7s" to="1"/>
                            </g>
                        </g>
                    </svg>
                </a>
            </div>

            <h6 class="card-subtitle mb-2 text-body-secondary opacity-50">{{ $server->version }} | {{ $server->api_id }}</h6>

            <section class="d-flex flex-wrap gap-2 justify-content-between">
                <div>
                    <span class="opacity-50">{{ __('Status') }}:</span>
                    @if ($server->is_available)
                        <span class="badge bg-success text-dark">{{ __('Available') }}</span>
                    @else
                        <span class="badge bg-danger text-dark">{{ __('Not Available') }}</span>
                    @endif
                </div>

                <div>
                    <span class="opacity-50">{{ __('Creation date') }}:</span>
                    <span class="badge bg-light text-dark">{{ $server->api_created_at }} ({{ $server->api_created_at->diffForHumans() }})</span>
                </div>
                <div>
                    <span class="opacity-50">{{ __('Total usage') }}:</span>
                    <span class="badge bg-light text-dark">{{ format_bytes($server->total_usage_in_bytes) }})</span>
                </div>

                <div>
                    <span class="opacity-50">
                        <abbr title="{{ __('This port will be used for new keys.') }}">{{ __('Port') }}</abbr>:
                    </span>
                    <span class="badge bg-light text-dark">{{ $server->port_for_new_access_keys }}</span>
                </div>

                <div>
                    <span class="opacity-50">
                        <abbr title="{{ __('This hostname will be used for new keys.') }}">{{ __('Hostname') }}</abbr>:
                    </span>
                    <span class="badge bg-light text-dark">{{ $server->hostname_for_new_access_keys }}</span>
                </div>

                <div>
                    <span class="opacity-50">{{ __('Number of keys') }}:</span>
                    <span class="badge bg-light text-dark">{{ $keys->count() }}</span>
                </div>

                <div class="w-100">
                    <span class="opacity-50">{{ __('Management URL') }}:</span>
                    <a class="btn btn-link px-0 text-break" href="{{ $server->api_url }}" target="_blank">{{ $server->api_url }}</a>
                </div>
            </section>
        </div>
    </div>

    <div class="card m-5 p-1">
        <div class="card-body">
            <div class="card-title d-flex justify-content-between gap-2 align-items-center mb-3">
                <h5>{{ __('Keys') }}</h5>

               @if ($server->is_available)
                    <a href="{{ route('servers.keys.create', $server->id) }}" class="btn btn-light text-uppercase">{{ __('Create') }}</a>
               @endif
            </div>


            <section class="d-flex flex-wrap gap-3 justify-content-start">
                @foreach($keys as $key)
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $key->name ?: "Key-$key->id" }}</h5>
                            <div class="card-text py-2 mb-2">
                                <code>{{ $key->access_url }}</code>
                            </div>
                            @if ($server->is_available)
                                <a href="{{ route('servers.keys.edit', [$server->id, $key->id]) }}" class="btn btn-outline-secondary text-uppercase">{{ __('Edit') }}</a>
                                <form method="post" action="{{ route('servers.keys.destroy', [$server->id, $key->id]) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-outline-danger text-uppercase">{{ __('Delete') }}</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </section>
        </div>
    </div>
@endsection
