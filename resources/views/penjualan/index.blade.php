@extends('layouts.app')

@section('title', 'Data Penjualan')

@section('topbar-actions')
    <a href="{{ route('penjualan.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Penjualan
    </a>
@endsection

@section('content')
    <div class="card">
        <!-- Filter Bar -->
        <form method="GET" action="{{ route('penjualan.index') }}">
            <div class="filter-bar">
                <div class="filter-item">
                    <label>Cari</label>
                    <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Nama, kontak, email...">
                </div>
                <div class="filter-item">
                    <label>Status</label>
                    <select name="status_filter">
                        <option value="">Semua Status</option>
                        @foreach(['baru', 'dihubungi', 'prospek', 'negosiasi', 'menang', 'kalah', 'pending'] as $status)
                            <option value="{{ $status }}" {{ ($filters['status_filter'] ?? '') === $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-item">
                    <label>Industri</label>
                    <select name="industri">
                        <option value="">Semua Industri</option>
                        @foreach(['Teknologi','Manufaktur','Kesehatan','Pendidikan','Keuangan','Retail','Properti','Logistik','F&B','Pertanian','Otomotif','Telekomunikasi','Energi','Media','Pariwisata'] as $ind)
                            <option value="{{ $ind }}" {{ ($filters['industri'] ?? '') === $ind ? 'selected' : '' }}>
                                {{ $ind }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-item">
                    <label>Sumber</label>
                    <select name="sumber_data">
                        <option value="">Semua Sumber</option>
                        @foreach(['Website','Referral','Pameran','Cold Call','Social Media','Email Marketing','Google Ads','LinkedIn','Partnership','Walk-in'] as $sumber)
                            <option value="{{ $sumber }}" {{ ($filters['sumber_data'] ?? '') === $sumber ? 'selected' : '' }}>
                                {{ $sumber }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-item">
                    <label>Dari Tanggal</label>
                    <input type="date" name="tanggal_dari" value="{{ $filters['tanggal_dari'] ?? '' }}">
                </div>
                <div class="filter-item">
                    <label>Sampai Tanggal</label>
                    <input type="date" name="tanggal_sampai" value="{{ $filters['tanggal_sampai'] ?? '' }}">
                </div>
                <div class="filter-item" style="display:flex;flex-direction:row;gap:8px;align-self:flex-end;">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ route('penjualan.index') }}" class="btn btn-outline btn-sm">
                        <i class="fas fa-times"></i> Reset
                    </a>
                </div>
            </div>
        </form>

        <!-- Table -->
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>
                            <a href="{{ route('penjualan.index', array_merge($filters, ['sort_by' => 'nama_perusahaan', 'sort_dir' => ($filters['sort_by'] ?? '') === 'nama_perusahaan' && ($filters['sort_dir'] ?? 'desc') === 'asc' ? 'desc' : 'asc'])) }}">
                                Perusahaan
                                @if(($filters['sort_by'] ?? '') === 'nama_perusahaan')
                                    <i class="fas fa-sort-{{ ($filters['sort_dir'] ?? 'desc') === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </a>
                        </th>
                        <th>Kontak</th>
                        <th>Industri</th>
                        <th>Sumber</th>
                        <th>
                            <a href="{{ route('penjualan.index', array_merge($filters, ['sort_by' => 'status_filter', 'sort_dir' => ($filters['sort_by'] ?? '') === 'status_filter' && ($filters['sort_dir'] ?? 'desc') === 'asc' ? 'desc' : 'asc'])) }}">
                                Status
                                @if(($filters['sort_by'] ?? '') === 'status_filter')
                                    <i class="fas fa-sort-{{ ($filters['sort_dir'] ?? 'desc') === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('penjualan.index', array_merge($filters, ['sort_by' => 'tanggal_input', 'sort_dir' => ($filters['sort_by'] ?? '') === 'tanggal_input' && ($filters['sort_dir'] ?? 'desc') === 'asc' ? 'desc' : 'asc'])) }}">
                                Tanggal
                                @if(($filters['sort_by'] ?? '') === 'tanggal_input')
                                    <i class="fas fa-sort-{{ ($filters['sort_dir'] ?? 'desc') === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </a>
                        </th>
                        <th>PIC</th>
                        <th style="text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penjualans as $index => $penjualan)
                        <tr>
                            <td style="color:var(--gray-400);font-size:13px;">{{ $penjualans->firstItem() + $index }}</td>
                            <td>
                                <a href="{{ route('penjualan.show', $penjualan->id) }}" style="color:var(--primary);text-decoration:none;font-weight:600;">
                                    {{ $penjualan->nama_perusahaan }}
                                </a>
                            </td>
                            <td>
                                <div style="font-weight:500;">{{ $penjualan->nama_kontak }}</div>
                                <div style="font-size:12px;color:var(--gray-400);">{{ $penjualan->email }}</div>
                            </td>
                            <td>{{ $penjualan->industri ?? '-' }}</td>
                            <td>{{ $penjualan->sumber_data ?? '-' }}</td>
                            <td>
                                <span class="badge badge-{{ $penjualan->status_filter ?? 'pending' }}">
                                    {{ ucfirst($penjualan->status_filter ?? 'N/A') }}
                                </span>
                            </td>
                            <td style="font-size:13px;">{{ $penjualan->tanggal_input?->format('d M Y') ?? '-' }}</td>
                            <td style="font-size:13px;">{{ $penjualan->user?->nama ?? '-' }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('penjualan.show', $penjualan->id) }}" class="btn btn-outline btn-sm btn-icon" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('penjualan.edit', $penjualan->id) }}" class="btn btn-outline btn-sm btn-icon" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm btn-icon" title="Hapus"
                                            onclick="confirmDelete({{ $penjualan->id }}, '{{ addslashes($penjualan->nama_perusahaan) }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">
                                <div class="empty-state">
                                    <i class="fas fa-building"></i>
                                    <h3>Belum ada data penjualan</h3>
                                    <p>Mulai tambahkan data penjualan pertama Anda.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($penjualans->hasPages())
            <div class="pagination-wrapper">
                <div class="pagination-info">
                    Menampilkan {{ $penjualans->firstItem() }}-{{ $penjualans->lastItem() }} dari {{ number_format($penjualans->total()) }} data
                </div>
                <ul class="pagination">
                    {{-- Previous --}}
                    @if($penjualans->onFirstPage())
                        <li class="disabled"><span>&laquo;</span></li>
                    @else
                        <li><a href="{{ $penjualans->previousPageUrl() }}">&laquo;</a></li>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach($penjualans->getUrlRange(max(1, $penjualans->currentPage() - 2), min($penjualans->lastPage(), $penjualans->currentPage() + 2)) as $page => $url)
                        <li class="{{ $page == $penjualans->currentPage() ? 'active' : '' }}">
                            @if($page == $penjualans->currentPage())
                                <span>{{ $page }}</span>
                            @else
                                <a href="{{ $url }}">{{ $page }}</a>
                            @endif
                        </li>
                    @endforeach

                    {{-- Next --}}
                    @if($penjualans->hasMorePages())
                        <li><a href="{{ $penjualans->nextPageUrl() }}">&raquo;</a></li>
                    @else
                        <li class="disabled"><span>&raquo;</span></li>
                    @endif
                </ul>
            </div>
        @endif
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="modal-overlay">
        <div class="modal">
            <h3><i class="fas fa-exclamation-triangle" style="color:var(--danger);"></i> Konfirmasi Hapus</h3>
            <p>Apakah Anda yakin ingin menghapus data <strong id="deleteName"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="modal-actions">
                <button type="button" class="btn btn-outline" onclick="closeDeleteModal()">Batal</button>
                <form id="deleteForm" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function confirmDelete(id, name) {
        document.getElementById('deleteName').textContent = name;
        document.getElementById('deleteForm').action = '/penjualan/' + id;
        document.getElementById('deleteModal').classList.add('active');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('active');
    }

    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });
</script>
@endsection
