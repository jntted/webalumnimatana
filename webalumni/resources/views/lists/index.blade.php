@extends('layout.layout')

/* diganti: styling table lebih rapi, tanpa gradien */
<style>
:root{
  --primary: #0d6efd;
  --muted: #6c757d;
  --card-bg: #ffffff;
  --row-odd: #f7f9fb;
  --border: #e9ecef;
  --badge: #ff7a18;
}

.container { padding-top: 1rem; }

/* card-like wrapper, tapi flat */
.table-responsive {
  background: var(--card-bg);
  border-radius: .6rem;
  box-shadow: 0 6px 18px rgba(10,10,10,.04);
  padding: .6rem;
  margin-bottom: 1.5rem;
  border: 1px solid var(--border);
}

/* table base - lebih compact & rapi */
.table {
  width: 100%;
  border-collapse: collapse;
  background: transparent;
  border-radius: .4rem;
  overflow: hidden;
}

/* clean header (flat color) */
.table thead th {
  background: var(--primary);
  color: #fff;
  border-bottom: 2px solid rgba(0,0,0,.06);
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .03em;
  font-size: .88rem;
  padding: .75rem .9rem;
  text-align: left;
}

/* rows: light zebra dan subtle hover tanpa translate */
.table tbody tr:nth-child(odd) { background: var(--row-odd); }
.table tbody tr:hover { background: rgba(13,110,253,0.04); }
.table td, .table th { padding: .75rem .9rem; vertical-align: middle; border-bottom: 1px solid var(--border); }

/* nama/nim styling sederhana */
.table .name { font-weight: 700; color: #222; }
.table .nim { font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, "Roboto Mono", monospace; color: #333; }

/* badge flat dan rapi */
.badge-contact {
  display: inline-block;
  background: var(--badge);
  color: #fff;
  padding: .35rem .6rem;
  border-radius: 999px;
  font-size: .85rem;
  font-weight: 600;
  box-shadow: 0 6px 18px rgba(255,122,24,0.08);
  border: 1px solid rgba(0,0,0,0.04);
}

/* pastikan teks tetap terlihat & di depan background */
.container, .table, .table * {
  position: relative !important;
  z-index: 2 !important;
  color: #212529 !important;
  -webkit-text-fill-color: #212529 !important;
}

/* overlay/pseudo-element di belakang */
.container::before, .container::after,
.table::before, .table::after,
.bg-overlay {
  position: absolute !important;
  z-index: 0 !important;
  pointer-events: none;
}
</style>

@section('content')
<div class="container mt-4">
    <h2>Daftar Mahasiswa Aktif</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Prodi</th>
                    <th>Semester</th>
                    <th>Kontak</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $i => $student)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td class="name">{{ optional($student->user)->name ?? '-' }}</td>
                    <td class="nim">{{ $student->nim ?? '-' }}</td>
                    <td>{{ $student->major ?? '-' }}</td>
                    <td>{{ $student->semester ?? '-' }}</td>
                    <td><span class="badge-contact">{{ $student->phone ?? '-' }}</span></td>
                </tr>
                @empty
                <tr><td colspan="6">Tidak ada data mahasiswa aktif.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <h2 class="mt-5">Daftar Alumni</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Prodi</th>
                    <th>Tahun Lulus</th>
                    <th>Kontak</th>
                </tr>
            </thead>
            <tbody>
                @forelse($alumni as $i => $al)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td class="name">{{ optional($al->user)->name ?? '-' }}</td>
                    <td class="nim">{{ $al->nim ?? '-' }}</td>
                    <td>{{ $al->major ?? '-' }}</td>
                    <td>{{ $al->graduation_year ?? '-' }}</td>
                    <td><span class="badge-contact">{{ $al->phone ?? '-' }}</span></td>
                </tr>
                @empty
                <tr><td colspan="6">Tidak ada data alumni.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
