@component('components.forms.index', [
    'action'    => route('users.restore', $user?->id ?? ''),
    'method'    => 'POST',
    'spoofingMethod' => 'PUT',
    'multipart' => false
])
    @slot('child')
        @php($options = [
            'modalSize'         => 'modal-md',
            'modalBodyClass'    => 'text-center text-dark',
            'modalConfirmType'  => 'submit',
        ])
        @component('components.modal.index', [
             'modalId'           => $modalId,
             'title'             => 'Aktifkan User',
             'message'           => 'Apakah Anda yakin ingin mengaktifkan users ini?',
             'confirmText'       => 'Aktifkan',
             'options'           => $options,
         ])
        @endcomponent
    @endslot
@endcomponent
