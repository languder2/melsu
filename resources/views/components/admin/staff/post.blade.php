<div class="post grid grid-cols-1 md:grid-cols-[90px_1fr_1fr_4fr_auto] gap-4">
    <input type="hidden" name="posts[{{$i}}][id]" value="{{optional($post)->id}}">

    <div class="pt-6">
        <x-form.on-off
            name="posts[{{$i}}][show]"
            :old="old('posts.'.$i.'.show')"
            :current="$post"
        />
    </div>


    <div data-ident="work-line">
        <x-form.input
            id="post_{{$i}}_employment"
            type="date"
            name="posts[{{$i}}][employment]"
            label="Дата трудоустройства"
            value="{{old('posts.'.$i.'.employment')??optional($post)->employment}}"
        />
    </div>

    <div>
        <x-form.input
            id="post{{$i}}_dismissal"
            type="date"
            name="posts[{{$i}}][dismissal]"
            label="Дата увольнения"
            value="{{old('posts.'.$i.'.dismissal')??optional($post)->dismissal}}"
        />
    </div>

    <div>
        <x-form.input
            id="post{{$i}}_post"
            name="posts[{{$i}}][post]"
            label="Должность"
            value="{{old('posts.'.$i.'.post')??optional($post)->post}}"
        />
    </div>

    <div>
        <a
            href="{{route('api-post-delete',optional($post)->id)}}"
            class="
                cursor-pointer
                flex
                w-10 h-10
                items-center justify-center
                bg-stone-100/90
                text-red-800
                rounded-lg
                hover:bg-red-800
                hover:text-white
                mt-2
            "
            onclick="Actions.DeleteItem(this.closest('.post'),this.href); return false">
            <i class="fas fa-recycle"></i>
        </a>
    </div>
</div>
