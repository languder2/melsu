<h4 class="font-semibold py-6 text-xl">
    {{ $title }}
</h4>

<div class="grid grid-cols-1 xl:grid-cols-2 gap-x-4 gap-y-6">
    @each('public.staffs.division.staff',$staffs,'staff')

</div>


