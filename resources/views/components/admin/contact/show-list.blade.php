<div class="contact-list mb-4">
    @foreach($list ?? [] as $id=>$item)
        <x-admin.contact.form :current="$item"/>
    @endforeach
</div>
