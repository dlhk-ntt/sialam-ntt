@php
$exp = new DateTime(Cache::get('app')->moodle_token_expired);
$diff = $exp->diff(now());
$day = $diff->format('%a');
$sign = $diff->format('%R');
if ($day < 7 || $sign == '+') $show_danger = true;
  else $show_danger = false;
@endphp
<div class="col-lg-3">
    <div class="card">
      <div class="card-body">
        <ul class="nav nav-pills nav-sidebar flex-column">
          <li class="nav-item">
            <a href="/admin/appinfo" class="nav-link {{ ($active == "appinfo") ? "active" : "" }}">
              <i class="fas fa-info-circle nav-icon"></i>
              <p>Info Aplikasi</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/linkmoodle" class="nav-link {{ ($active == "linkmoodle") ? "active" : "" }}">
              <i class="fas fa-link nav-icon"></i>
              <p>
                Integrasi Moodle LMS
                @if ($show_danger)
                  <span class="badge badge-danger navbar-badge text-bold">EX</span>
                @endif
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/user" class="nav-link {{ ($active == "user") ? "active" : "" }}">
              <i class="fas fa-users nav-icon"></i>
              <p>Manajemen Pengguna</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/shpfile" class="nav-link {{ ($active == "shpfile") ? "active" : "" }}">
              <i class="fas fa-map nav-icon"></i>
              <p>Manajemen Data Spasial</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/proposal" class="nav-link {{ ($active == "proposal") ? "active" : "" }}">
              <i class="fas fa-list-ol nav-icon"></i>
              <p>Pengajuan PS</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
