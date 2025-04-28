@use('App\Enums\EducationForm')
<div class="flex flex-col xl:flex-row">
    @foreach(EducationForm::cases() as $form)
        @if(!$speciality->profileByForm($form,true)) @continue @endif
        <label
            for="profile_{{$form->name}}"
            @disabled(!$speciality->profileByForm($form,true))
            class="
                        group

                        bg-white
                        p-4 cursor-pointer flex-1 font-bold transition duration-300
                        text-lg xl:text-xl
                        has-checked:bg-base-red
                        has-checked:text-white
                        has-checked:border-base-red
                        border-2 border-base-red border-t-0 first:border-t-2

                        xl:border-white xl:border-t-2 xl:border-b-base-red
                        xl:has-checked:bg-white
                        xl:has-checked:text-black
                        xl:has-checked:border-b-white
                        hover:text-base-red

                        has-disabled:bg-neutral-300
                        has-disabled:border-neutral-300
                        has-disabled:border-b-base-red
                        has-disabled:text-white
                        has-disabled:hidden
                        has-disabled:xl:block

                    "
        >
            <input
                id="profile_{{$form->name}}"
                type="radio"
                name="form"
                @checked($loop->first)

                value="panel_{{$form->name}}"
                class="hidden"
                onchange="PublicAction.showBlock('profile_{{$form->name}}','.profiles')"
                @disabled(!$speciality->profileByForm($form,true))
            >
            {!! $form->getName() !!}
        </label>
    @endforeach
</div>
