@component('components.forms.index', [
    'class'     => 'p-2',
    'action'    => route('users.update', $user->id),
    'method'    => 'POST',
    'spoofingMethod' => 'PUT',
    'multipart' => true
])
    @slot('child')
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="form-group">
                    <label for="name">Nama</label>
                    @include('components.input.index', [
                        'key'           => 'name',
                        'type'          => 'text',
                        'placeholder'   => 'Masukkan nama anda',
                        'value'         => $user->name,
                    ])
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    @include('components.input.index', [
                        'key'           => 'email',
                        'type'          => 'text',
                        'placeholder'   => 'Masukkan email anda',
                        'value'         => $user->email,
                    ])
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="form-group">
                    <label for="phone">No HP</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">+62</span>
                        </div>
                        @include('components.input.index', [
                           'key'           => 'phone',
                           'type'          => 'tel',
                           'placeholder'   => '812 3456 7890',
                           'value'         => $user->userDetail?->phone,
                       ])
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="form-group">
                    <label for="birth_date">Alamat</label>
                    @include('components.input.index', [
                        'key'           => 'address',
                        'type'          => 'text',
                        'placeholder'   => 'Masukkan alamat anda',
                        'value'         => $user->userDetail?->address,
                    ])
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <label for="birth_place">Tempat Tanggal Lahir</label>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            @include('components.input.index', [
                                'key'           => 'birth_place',
                                'type'          => 'text',
                                'placeholder'   => 'Tempat Kelahiran',
                                'value'         => $user->userDetail?->birth_place,
                            ])
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="bx bx-calendar"></i>
                                    </span>
                                </div>
                                @include('components.input.index', [
                                      'key'           => 'birth_date',
                                      'type'          => 'text',
                                      'placeholder'   => 'Pilih tanggal lahir anda',
                                      'value'         => convertDate($user->userDetail?->birth_date, 'd-M-Y', false),
                                      'attributes'    => 'data-provide=datepicker data-date-autoclose=true data-date-format=d-M-yyyy',
                                  ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-6">
                <label for="birth_place">Jenis Kelamin</label>
                <div class="form-group">
                    @include('components.select2.index', [
                        'key'           => 'gender',
                        'placeholder'   => 'Pilih Jenis Kelamin',
                        'items'         => getDataMaster('genders'),
                        'value'         => $user->userDetail->gender
                    ])
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <label for="cv">Upload Foto (*Replace Foto Jika ingin mengganti)</label>
                <div class="form-group">
                    @include('components.input.index', [
                      'class'         => 'dropify',
                      'key'           => 'image',
                      'type'          => 'file',
                      'placeholder'   => 'Masukkan file',
                      'attributes'    => 'data-height=200 data-max-file-size=2M data-default-file=' . $user->userDetail?->image_url
                    ])
                </div>
            </div>
        </div>

        <div class="mb-3 pt-3 text-right">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
            <button class="btn btn-primary" type="submit"> Update</button>
        </div>
    @endslot
@endcomponent