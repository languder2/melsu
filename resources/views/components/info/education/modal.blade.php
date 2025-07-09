<div class="flex gap-4 p-4 items-center">
    <div id="modal-header" class="flex-1 text-center font-semibold">
        {{ __("documents.add-in-profile") }}
    </div>

    <a
        href="javascript:Modal.closeModal()"
        class="
            inline-block p-1 bg-red hover:bg-red-700 rounded-xl
        "
    >
        <x-info.forms.icons.close width="24px" height="24px" />
    </a>
</div>

<x-info.education.document-form
    profileId="{{ $profile->id }}"
    documentId="{{ $document->exists ? $document->id : null }}"
    code="{{ $code ?? null }}"
/>

