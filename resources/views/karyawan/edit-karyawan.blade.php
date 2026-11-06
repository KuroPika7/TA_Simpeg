@extends('layouts.user_type.auth')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card modern-form-card">
          <div class="card-header form-header-gradient">
            <div class="d-flex align-items-center">
              <div class="form-header-icon me-3">
                <i class="fas fa-user-edit" aria-hidden="true"></i>
              </div>
              <div>
                <h5 class="form-header-title">Form Edit Karyawan</h5>
                <p class="form-header-subtitle">Perbarui data karyawan</p>
              </div>
            </div>
          </div>
          <div class="card-body form-body-padding">
            @if (session()->has('message'))
              <div class="alert alert-success-modern alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
                <span class="alert-text"><strong>Success!</strong> {{ session()->get('message') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif

            <form action="{{ route('daftar-karyawan.update', $karyawan->id) }}" method="POST"
              enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                  <h6 class="form-section-header">Informasi Personal</h6>

                  <div class="form-group-modern">
                    <label for="name" class="form-control-label">Nama Lengkap</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                      <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name', $karyawan->name) }}" placeholder="Contoh: Budi Santoso" required>
                    </div>
                    @error('name')
                      <p class="form-error-text">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="form-group-modern">
                    <label for="nip" class="form-control-label">NIP (Nomor Induk Pegawai)</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-id-badge"></i></span>
                      <input type="text" class="form-control" id="nip" name="nip"
                        value="{{ old('nip', $karyawan->nip) }}" placeholder="Contoh: PEG-2025-001" >
                    </div>
                    @error('nip')
                      <p class="form-error-text">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="form-group-modern">
                    <label for="email" class="form-control-label">Email Address</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                      <input type="email" class="form-control" id="email" name="email"
                        value="{{ old('email', $karyawan->user->email ?? '') }}" placeholder="email@perusahaan.com"
                        required>
                    </div>
                    @error('email')
                      <p class="form-error-text">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="form-group-modern">
                    <label for="password" class="form-control-label">Password</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-lock"></i></span>
                      <input type="password" class="form-control" id="password" name="password"
                        placeholder="Kosongkan jika tidak ingin mengubah">
                    </div>
                    <p class="form-helper-text">Kosongkan jika tidak ingin mengubah password</p>
                    @error('password')
                      <p class="form-error-text">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group-modern">
                        <label for="birth_place" class="form-control-label">Tempat Lahir</label>
                        <input type="text" class="form-control" id="birth_place" name="birth_place"
                          value="{{ old('birth_place', $karyawan->birth_place) }}" placeholder="Jakarta" required>
                        @error('birth_place')
                          <p class="form-error-text">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group-modern">
                        <label for="birth_date" class="form-control-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date"
                          value="{{ old('birth_date', $karyawan->birth_date ? $karyawan->birth_date->format('Y-m-d') : '') }}"
                          max="{{ date('Y-m-d') }}"
                          required>
                        @error('birth_date')
                          <p class="form-error-text">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="form-group-modern">
                    <label for="gender" class="form-control-label">Jenis Kelamin</label>
                    <select name="gender" id="gender" class="form-select" required>
                      <option value="">-- Pilih Gender --</option>
                      <option value="Lk" {{ $karyawan->gender == 'Lk' ? 'selected' : '' }}>Laki-laki</option>
                      <option value="Pr" {{ $karyawan->gender == 'Pr' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('gender')
                      <p class="form-error-text">{{ $message }}</p>
                    @enderror
                  </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                  <h6 class="form-section-header mt-4 mt-md-0">Informasi Pekerjaan & Kontak</h6>

                  <div class="form-group-modern">
                    <label for="jabatan_id" class="form-control-label">Jabatan</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                      <select name="jabatan_id" id="jabatan_id" class="form-select" required>
                        <option value="">-- Pilih Jabatan --</option>
                        @foreach ($jabatans as $jabatan)
                          <option value="{{ $jabatan->id }}"
                            {{ $jabatan->id == $karyawan->jabatan_id ? 'selected' : '' }}>
                            {{ $jabatan->name }}
                          </option>
                        @endforeach
                      </select>
                    </div>
                    @error('jabatan_id')
                      <p class="form-error-text">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="form-group-modern">
                    <label for="departemen" class="form-control-label">Departemen</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-building"></i></span>
                      <select name="departemen" id="departemen" class="form-select">
                        <option value="">-- Pilih Departemen --</option>
                        @foreach(['HRD', 'IT', 'Finance', 'Marketing', 'Operasional', 'Gudang', 'Kantor'] as $dept)
                            <option value="{{ $dept }}" {{ (old('departemen', $karyawan->departemen) == $dept) ? 'selected' : '' }}>{{ $dept }}</option>
                        @endforeach
                      </select>
                    </div>
                    @error('departemen')
                      <p class="form-error-text">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="tanggal_masuk" class="form-control-label">Tanggal Masuk</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                                <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" 
                                    value="{{ old('tanggal_masuk', $karyawan->tanggal_masuk) }}" required>
                            </div>
                            @error('tanggal_masuk')
                                <p class="form-error-text">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="gaji" class="form-control-label">Gaji Pokok</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="gaji" name="gaji" 
                                    value="{{ old('gaji', $karyawan->gaji) }}" placeholder="0" min="0" step="1000">
                            </div>
                            @error('gaji')
                                <p class="form-error-text">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                  </div>

                  <div class="form-group-modern">
                    <label for="phone" class="form-control-label">Nomor Telepon</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                      <input type="text" class="form-control" id="phone" name="phone"
                        value="{{ old('phone', $karyawan->phone) }}" placeholder="0812xxxxxxxx" required>
                    </div>
                    @error('phone')
                      <p class="form-error-text">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="form-group-modern">
                    <label for="address" class="form-control-label">Alamat Lengkap</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                      <input type="text" class="form-control" id="address" name="address"
                        value="{{ old('address', $karyawan->address) }}" placeholder="Jl. Raya No. 123" required>
                    </div>
                    @error('address')
                      <p class="form-error-text">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="form-group-modern">
                    <label for="status" class="form-control-label">Status Karyawan</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                      <select name="status" id="status" class="form-select" required>
                        <option value="Aktif" {{ $karyawan->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Non-Aktif" {{ $karyawan->status == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif
                        </option>
                      </select>
                    </div>
                    @error('status')
                      <p class="form-error-text">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="form-group-modern">
                    <label for="image" class="form-control-label">Foto Profil</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-camera"></i></span>
                      <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <p class="form-helper-text">Format: JPG, PNG. Max: 2MB. Kosongkan jika tidak ingin mengubah</p>
                    @error('image')
                      <p class="form-error-text">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="form-actions d-flex justify-content-end gap-3 mt-5">
                <button type="button" class="btn btn-cancel" onclick="window.history.back()">Batal</button>
                <button type="submit" class="btn btn-gradient-cyan text-white">
                  <i class="fas fa-save me-2"></i>
                  Update Data Karyawan
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
