@component('components.forms.index', [
    'action'    => route('users.destroy', $user?->id ?? ''),
    'method'    => 'POST',
    'spoofingMethod' => 'DELETE',
    'multipart' => false
])
    @slot('child')
        @php($options = [
            'modalSize'         => 'modal-md',
            'modalBodyClass'    => 'text-center',
            'modalConfirmType'  => 'submit',
            'modalConfirmClass' => 'btn btn-danger',
        ])
        @component('components.modal.index', [
             'modalId'           => $modalId,
             'title'             => 'Non Aktifkan User',
             'message'           => 'Apakah Anda yakin ingin menonaktifkan users ini?',
             'confirmText'       => 'Ya, Non Aktifkan',
             'options'           => $options,
         ])
        @endcomponent
    @endslot
@endcomponent
