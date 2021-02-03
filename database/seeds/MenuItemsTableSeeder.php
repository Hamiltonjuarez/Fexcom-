<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;

class MenuItemsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $menu = Menu::where('name', 'admin')->firstOrFail();

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.dashboard'),
            'url'     => '',
            'route'   => 'voyager.dashboard',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-boat',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 1,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.media'),
            'url'     => '',
            'route'   => 'voyager.media.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-images',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 5,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.users'),
            'url'     => '',
            'route'   => 'voyager.users.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-person',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 3,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.roles'),
            'url'     => '',
            'route'   => 'voyager.roles.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-lock',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 2,
            ])->save();
        }

        $toolsMenuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.tools'),
            'url'     => '',
        ]);
        if (!$toolsMenuItem->exists) {
            $toolsMenuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-tools',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 9,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.menu_builder'),
            'url'     => '',
            'route'   => 'voyager.menus.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-list',
                'color'      => null,
                'parent_id'  => $toolsMenuItem->id,
                'order'      => 10,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.database'),
            'url'     => '',
            'route'   => 'voyager.database.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-data',
                'color'      => null,
                'parent_id'  => $toolsMenuItem->id,
                'order'      => 11,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.compass'),
            'url'     => '',
            'route'   => 'voyager.compass.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-compass',
                'color'      => null,
                'parent_id'  => $toolsMenuItem->id,
                'order'      => 12,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.bread'),
            'url'     => '',
            'route'   => 'voyager.bread.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-bread',
                'color'      => null,
                'parent_id'  => $toolsMenuItem->id,
                'order'      => 13,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.settings'),
            'url'     => '',
            'route'   => 'voyager.settings.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-settings',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 14,
            ])->save();
        }

         // menu para usuario admon fexcom

         $menu = Menu::where('name', 'admon')->firstOrFail();

         $menuItem = MenuItem::firstOrNew([
             'menu_id' => $menu->id,
             'title'   => 'Usuarios',
             'url'     => '',
             'route'   => 'users.index',
         ]);
         if (!$menuItem->exists) {
             $menuItem->fill([
                 'target'     => '_self',
                 'icon_class' => 'users',
                 'color'      => null,
                 'parent_id'  => null,
                 'order'      => 1,
             ])->save();
         }
 
         $menuItem = MenuItem::firstOrNew([
             'menu_id' => $menu->id,
             'title'   => 'Empresas',
             'url'     => '',
             'route'   => 'companies.index',
         ]);
         if (!$menuItem->exists) {
             $menuItem->fill([
                 'target'     => '_self',
                 'icon_class' => 'companies',
                 'color'      => null,
                 'parent_id'  => null,
                 'order'      => 2,
             ])->save();
         }
 
         //adding items to accountant user menu
         $menu = Menu::where('name', 'accountant')->firstOrFail();
 
         $accountsPayable = MenuItem::firstOrNew([ 
             'menu_id' => $menu->id,
             'title'   => 'Cuentas por pagar',
             'url'     => '',
             'route'   => 'payables.index',             
         ]);
         if (!$accountsPayable->exists) {
             $accountsPayable->fill([
                 'target'     => '_self',
                 'icon_class' => 'providers',
                 'color'      => null,
                 'parent_id'  => null,
                 'order'      => 1,
             ])->save();
            }
         $menuItem = MenuItem::firstOrNew([
             'menu_id' => $menu->id,
             'title'   => 'Proveedores',
             'url'     => '',
             'route'   => 'providers.index',
         ]);
         if (!$menuItem->exists) {
             $menuItem->fill([
                 'target'     => '_self',
                 'icon_class' => 'providers',
                 'color'      => null,
                 'parent_id'  => $accountsPayable->id,
                 'order'      => 2,
             ])->save();
          }

          $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Compras',
            'url'     => '',
            'route'   => 'purchases.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'purchases',
                'color'      => null,
                'parent_id'  => $accountsPayable->id,
                'order'      => 2,
            ])->save();
         }
      
    }
}
