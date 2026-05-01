@extends('layouts.app')

@section('title', 'Tambah Penjualan')

@section('topbar-actions')
    <a href="{{ route('penjualan.index') }}" class="btn btn-outline">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h2><i class="fas fa-plus-circle" style="color:var(--primary);"></i> &nbsp;Tambah Data Penjualan Baru</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('penjualan.store') }}">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label for="nama_perusahaan">Nama Perusahaan <span style="color:var(--danger);">*</span></label>
                        <input type="text" id="nama_perusahaan" name="nama_perusahaan"
                               class="form-control @error('nama_perusahaan') is-invalid @enderror"
                               value="{{ old('nama_perusahaan') }}" placeholder="PT Contoh Jaya">
                        @error('nama_perusahaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_kontak">Nama Kontak <span style="color:var(--danger);">*</span></label>
                        <input type="text" id="nama_kontak" name="nama_kontak"
                               class="form-control @error('nama_kontak') is-invalid @enderror"
                               value="{{ old('nama_kontak') }}" placeholder="Budi Santoso">
                        @error('nama_kontak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" placeholder="budi@perusahaan.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="telepon">Telepon</label>
                        <input type="text" id="telepon" name="telepon"
                               class="form-control @error('telepon') is-invalid @enderror"
                               value="{{ old('telepon') }}" placeholder="08123456789">
                        @error('telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="industri">Industri</label>
                        <select id="industri" name="industri" class="form-control @error('industri') is-invalid @enderror">
                            <option value="">-- Pilih Industri --</option>
                            @foreach(['Teknologi','Manufaktur','Kesehatan','Pendidikan','Keuangan','Retail','Properti','Logistik','F&B','Pertanian','Otomotif','Telekomunikasi','Energi','Media','Pariwisata'] as $ind)
                                <option value="{{ $ind }}" {{ old('industri') === $ind ? 'selected' : '' }}>{{ $ind }}</option>
                            @endforeach
                        </select>
                        @error('industri')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="sumber_data">Sumber Data</label>
                        <select id="sumber_data" name="sumber_data" class="form-control @error('sumber_data') is-invalid @enderror">
                            <option value="">-- Pilih Sumber --</option>
                            @foreach(['Website','Referral','Pameran','Cold Call','Social Media','Email Marketing','Google Ads','LinkedIn','Partnership','Walk-in'] as $sumber)
                                <option value="{{ $sumber }}" {{ old('sumber_data') === $sumber ? 'selected' : '' }}>{{ $sumber }}</option>
                            @endforeach
                        </select>
                        @error('sumber_data')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="status_filter">Status</label>
                        <select id="status_filter" name="status_filter" class="form-control @error('status_filter') is-invalid @enderror">
                            <option value="">-- Pilih Status --</option>
                            @foreach(['baru' => 'Baru', 'dihubungi' => 'Dihubungi', 'prospek' => 'Prospek', 'negosiasi' => 'Negosiasi', 'menang' => 'Menang', 'kalah' => 'Kalah', 'pending' => 'Pending'] as $val => $label)
                                <option value="{{ $val }}" {{ old('status_filter') === $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('status_filter')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal_input">Tanggal Input</label>
                        <input type="date" id="tanggal_input" name="tanggal_input"
                               class="form-control @error('tanggal_input') is-invalid @enderror"
                               value="{{ old('tanggal_input', date('Y-m-d')) }}">
                        @error('tanggal_input')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="user_id">Ditangani Oleh <span style="color:var(--danger);">*</span></label>
                        <select id="user_id" name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                            <option value="">-- Pilih User --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group"></div>
                </div>

                <div style="display:flex;gap:12px;padding-top:12px;border-top:1px solid var(--gray-100);margin-top:8px;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('penjualan.index') }}" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
