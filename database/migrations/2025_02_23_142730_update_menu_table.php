<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Menu\Menu;
use App\Models\Menu\Item;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if(!Schema::hasColumn('menu','show'))
            Schema::table('menu', function (Blueprint $table) {
                $table->tinyInteger('show')->default(1)->after('comment');
            });

        if(!Schema::hasColumn('menu_items','show'))
            Schema::table('menu_items', function (Blueprint $table) {
                $table->tinyInteger('show')->default(1)->after('parent_id');
            });


        if(!Schema::hasColumn('menu','deleted_at'))
            Schema::table('menu', function (Blueprint $table) {
                $table->timestamp('deleted_at')->nullable()->after('show');
            });

        if(!Schema::hasColumn('menu','parent_id'))
            Schema::table('menu', function (Blueprint $table) {
                $table->unsignedBigInteger('parent_id')->nullable()->default(null)->after('code');

                $table->foreign('parent_id')
                    ->references('id')
                    ->on('menu')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
            });

        if(!Schema::hasColumn('menu','sort'))
            Schema::table('menu', function (Blueprint $table) {
                $table->integer('sort')->default(10000)->after('show');
            });

        $main = Menu::find(4);

        foreach ($main->items as $item) {
            $newSub = $main->subs()->create([
                'code'  => bcrypt(rand(1,1000)),
                'name'  => $item->name,
                'sort'  => $item->sort,
            ]);

            $list = $item->subs()->distinct()->pluck('grp');

            foreach ($list as $key=>$grp) {
                $newItem = $newSub->items()->create([
                    'name'  => "{$newSub->name}: Grp {$grp}",
                    'sort'  => ($key+1)*100
                ]);

                $updateList = $item->subs()->where('grp',$grp)->get();

                foreach ($updateList as $rec)
                    $rec->fill([
                        'parent_id' => $newItem->id,
                        'menu_id'   => $newSub->id,
                    ])->save() ;
            }

            $item->delete();

        }

        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropColumn('grp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu', function (Blueprint $table) {
            $table->dropForeign('menu_parent_id_foreign');
            $table->dropIndex('menu_parent_id_foreign');
            $table->dropColumn('parent_id');

            $table->dropColumn('deleted_at');
            $table->dropColumn('show');
            $table->dropColumn('sort');
        });
    }
};
