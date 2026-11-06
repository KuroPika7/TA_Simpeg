@component('components.forms.index', [
    'class'     => 'p-2',
    'action'    => route('users.store'),
    'method'    => 'POST',
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
                        'placeholder'   => 'Masukkan nama anda'
                    ])
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    @include('components.input.index', [
                        'key'           => 'email',
                        'type'          => 'text',
                        'placeholder'   => 'Masukkan email anda'
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
                    ])
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="form-group">
                    <label for="password">Password</label>
                    @include('components.input.index', [
                        'key'           => 'password',
                        'type'          => 'password',
                        'placeholder'   => 'Masukkan password anda'
                    ])
                </div>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    @include('components.input.index', [
                        'key'           => 'password_confirmation',
                        'type'          => 'password',
                        'placeholder'   => 'Masukkan ulang password anda'
                    ])
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <label for="birth_place">Role</label>
                <div class="form-group">
                    @include('components.select2.index', [
                        'key'           => 'role_id',
                        'placeholder'   => 'Pilih Role',
                        'items'         => getDataMaster('roles')->whereNotIn('name', 'director')->map(fn($item)=> (object) [
                                'id'    => $item->id,
                                'name'  => $item->description,
                        ]),
                    ])
                </div>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-6">
                <label for="birth_place">Jabatan</label>
                <div class="form-group">
                    @include('components.select2.index', [
                        'key'           => 'position_id',
                        'placeholder'   => 'Pilih Jabatan',
                        'items' => getDataMaster('positions'),
                        'attributes'    => 'disabled',
                    ])
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <label for="cv">Upload Foto</label>
                <div class="form-group">
                    @include('components.input.index', [
                      'class'         => 'dropify',
                      'key'           => 'image',
                      'type'          => 'file',
                      'placeholder'   => 'Masukkan file',
                      'attributes'    => 'data-height=200 data-max-file-size=2M'
                    ])
                </div>
            </div>
        </div>

        <div class="mb-3 pt-3 text-right">
            <button class="btn btn-primary" type="submit"> Submit</button>
        </div>
    @endslot
@endcomponent