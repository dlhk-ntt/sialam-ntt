@extends('partials.template')

@section('base_template')
<div class="card card-primary card-tabs">
    <div class="card-header p-0" style="background-color: white;">
        <ul class="nav nav-tabs nav-fill" id="custom-tabs-two-tab" role="tablist">
            <li class="nav-item nav-steps mr-1">
                <a class="nav-link nav-a-steps @if ($active == 'intro') active @endif" href="/introduction/{{ $urlparam }}">Pengantar</a>
            </li>
            <li class="nav-item nav-steps mr-1">
                <a class="nav-link nav-a-steps @if ($active == 'step-1') active @endif" href="/step-1/{{ $urlparam }}">Langkah 1: Analisis Spasial</a>
            </li>
            <li class="nav-item nav-steps mr-1">
                <button class="w-100 nav-link nav-a-steps @if ($active == 'step-2') active @endif" onclick="gotoNext(2)">Langkah 2: Penapisan</button>
            </li>
            <li class="nav-item nav-steps mr-1">
                <button class="w-100 nav-link nav-a-steps @if ($active == 'step-3') active @endif @if (!$proposal->step2_completed && !strlen($proposal->result_skemaps)) disabled @endif" onclick="gotoNext(3)" @if (!$proposal->step2_completed && !strlen($proposal->result_skemaps)) disabled @endif>Langkah 3: Penentuan Preferensi</button>
            </li>
            <li class="nav-item nav-steps mr-1">
                <button class="w-100 nav-link nav-a-steps @if ($active == 'result') active @endif @if (!$proposal->step3_completed && !strlen($proposal->result_skemaps)) disabled @endif" onclick="gotoNext(4)" @if (!$proposal->step3_completed && !strlen($proposal->result_skemaps)) disabled @endif>Ringkasan Hasil</button>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-two-tabContent">
            <div class="tab-pane fade show active" role="tabpanel">
                @yield('menu_tab_content')
            </div>
        </div>
    </div>
    
    </div>
@stop