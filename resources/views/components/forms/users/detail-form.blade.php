@php($options = [
    'modalSize'         => 'modal-lg',
    'modalBodyClass'    => 'text-left',
    'modalConfirm'      => false,
    'modalCancel'       => true,
])
@component('components.modal.index', [
     'modalId'           => $modalId,
     'title'             => 'Detail User',
     'cancelText'        => 'Kembali',
     'options'           => $options,
 ])
    @slot('child')
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="firstName">Nama User</label>
                    <div class="font-size-16 text-dark">{{ $user?->name }}</div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group d-flex flex-column">
                    <label for="positionId">Jabatan</label>
                    <div class="font-size-16 text-dark">{{ $user?->userDetail?->position?->name ?? '-' }}</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="font-size-16 text-dark">{{ $user?->email }}</div>
                </div>

            </div>

            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group d-flex flex-column">
                    <label for="roleId">Role</label>
                    <div class="font-size-16 text-dark">{{ $user?->roles->first()->description }}</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group d-flex flex-column">
                    <label for="gender">Jenis Kelamin</label>
                    <div class="font-size-16 text-dark">{{ $user?->userDetail?->gender ? getGenders()[$user?->userDetail?->gender] : '-' }}</div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="phone">Nomor HP</label>
                    <div class="font-size-16 text-dark">{{ phoneNumberFormat($user?->userDetail?->phone) }}</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group d-flex flex-column">
                    <label for="ttl">Tempat Tanggal Lahir</label>
                    <div class="font-size-16 text-dark">
                        {{ $user?->userDetail?->birth_place ? $user?->userDetail?->birth_place . ', ' : '' }}
                        {{ $user?->userDetail?->birth_date ? \Illuminate\Support\Carbon::parse($user?->userDetail?->birth_date)->translatedFormat('d F Y') : '-' }}
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <div class="font-size-16 text-dark">{{ $user->userDetail?->address ?? '-'}}</div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="address">Foto</label>
                    <div class="font-size-16 text-dark">
                        @if($user->userDetail?->image_url)
                            <a href="{{ $user->userDetail?->image_url }}" target="_blank">Lihat Foto</a>
                            <img src="{{ $user->userDetail?->image_url ?? '-'}}" class="img-thumbnail">
                        @else
                            -
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endslot
@endcomponent