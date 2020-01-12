<?php

namespace App\Http\Middleware;

use App\Events\DashboardAdminEvent;
use Closure;
use Auth;
use Menu;

class DashboardAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::check())
            return $next($request);

        Menu::create('AdminMenu', function($menu) {
            $menu->style('adminlte');

            $admin = Auth::user();

            $attr = ['icon' => 'fa fa-angle-double-right'];

            $menu->add([
                'url' => '/',
                'title' => 'Home',
                'icon' => 'fa fa-home',
                'order' => 1,
            ]);

            if ($admin->can(['read-agent-groups', 'read-agents'])) {
                $menu->dropdown('Agen', function ($sub) use($admin, $attr) {
                    if ($admin->can('read-agent-groups')) {
                        $sub->url('agent/groups', 'Kelompok Agen', 1, $attr);
                    }
                    if ($admin->can('read-agents')) {
                        $sub->url('agent/agents', 'Agen', 2, $attr);
                    }
                }, 2, [
                    'title' => 'Agen',
                    'icon' => 'fa fa-list',
                ]);
            }

            if ($admin->can(['read-worksheets'])) {
                $menu->dropdown('Worksheet', function ($sub) use($admin, $attr) {
                    if ($admin->can('read-worksheets')) {
                        $sub->url('worksheet/worksheets', 'Worksheet', 1, $attr);
                    }
                }, 3, [
                    'title' => 'Worksheet',
                    'icon' => 'fa fa-file-excel-o',
                ]);
            }

            if ($admin->can(['read-orders'])) {
                $menu->dropdown('Order', function ($sub) use($admin, $attr) {
                    if ($admin->can('read-orders')) {
                        $sub->url('order/orders', 'Order', 1, $attr);
                    }
                }, 4, [
                    'title' => 'Order',
                    'icon' => 'fa fa-list',
                ]);
            }

            if ($admin->can(['read-monitorings'])) {
                $menu->dropdown('Monitoring', function ($sub) use($admin, $attr) {
                    if ($admin->can('read-monitorings')) {
                        $sub->url('monitor/monitors', 'Monitors', 1, $attr);
                    }
                }, 5, [
                    'title' => 'Monitoring',
                    'icon' => 'fa fa-desktop',
                ]);
            }
            
            if ($admin->can(['read-worksheet-status'])) {
                $menu->dropdown('Status', function ($sub) use($admin, $attr) {
                    if ($admin->can('read-worksheet-status')) {
                        $sub->url('status/worksheets', 'Worksheet Status', 1, $attr);
                    }
                }, 6, [
                    'title' => 'Monitoring',
                    'icon' => 'fa fa-wrench',
                ]);
            }

            if ($admin->can(['read-auth-roles', 'read-auth-permissions', 'read-auth-users'])) {
                $menu->dropdown('Pengguna', function ($sub) use($admin, $attr) {
                    if ($admin->can('read-auth-roles')) {
                        $sub->url('auth/roles', 'Role', 1, $attr);
                    }
                    if ($admin->can('read-auth-permissions')) {
                        $sub->url('auth/permissions', 'Permisi', 2, $attr);
                    }
                    if ($admin->can('read-auth-users')) {
                        $sub->url('auth/users', 'Pengguna', 3, $attr);
                    }
                }, 7, [
                    'title' => 'Pengguna',
                    'icon' => 'fa fa-user',
                ]);
            }

            event(new DashboardAdminEvent($menu));
        });

        return $next($request);
    }
}
