@extends('layouts.app')
@section('title', 'Detail Penjualan')
@section('topbar-actions')
    <div style="display:flex;gap:8px;">
        <a href="{{ route('penjualan.edit', $penjualan->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i> Edit</a>
        <a href="{{ route('penjualan.index') }}" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-building" style="color:var(--primary);"></i> &nbsp;{{ $penjualan->nama_perusahaan }}</h2>
        <span class="badge badge-{{ $penjualan->status_filter ?? 'pending' }}">{{ ucfirst($penjualan->status_filter ?? 'N/A') }}</span>
    </div>
    <div class="detail-grid">
        <div class="detail-item">
            <div class="detail-label">Nama Perusahaan</div>
            <div class="detail-value">{{ $penjualan->nama_perusahaan }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Nama Kontak</div>
            <div class="detail-value">{{ $penjualan->nama_kontak }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Email</div>
            <div class="detail-value">{{ $penjualan->email ?? '-' }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Telepon</div>
            <div class="detail-value">{{ $penjualan->telepon ?? '-' }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Industri</div>
            <div class="detail-value">{{ $penjualan->industri ?? '-' }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Sumber Data</div>
            <div class="detail-value">{{ $penjualan->sumber_data ?? '-' }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Status</div>
            <div class="detail-value">
                <span class="badge badge-{{ $penjualan->status_filter ?? 'pending' }}">{{ ucfirst($penjualan->status_filter ?? 'N/A') }}</span>
            </div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Tanggal Input</div>
            <div class="detail-value">{{ $penjualan->tanggal_input?->format('d F Y, H:i') ?? '-' }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Ditangani Oleh</div>
            <div class="detail-value">{{ $penjualan->user?->nama ?? '-' }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Terakhir Diupdate</div>
            <div class="detail-value">{{ $penjualan->updated_at?->format('d F Y, H:i') ?? '-' }}</div>
        </div>
    </div>
</div>
@endsection
