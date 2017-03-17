<?php
use Spatie\Menu\Laravel\Menu;
//Menu::macro('fullsubmenuexample', function () {
//    return Menu::new()->prepend('<a href="#"><span> Multilevel PROVA </span> <i class="fa fa-angle-left pull-right"></i></a>')
//        ->addParentClass('treeview')
//        ->add(Link::to('/link1prova', 'Link1 prova'))->addClass('treeview-menu')
//        ->add(Link::to('/link2prova', 'Link2 prova'))->addClass('treeview-menu')
//        ->url('http://www.google.com', 'Google');
//});
Menu::macro('adminlteSubmenu', function ($submenuName) {
    return Menu::new()->prepend('<a href="#"><span> ' . $submenuName . '</span> <i class="fa fa-angle-left pull-right"></i></a>')
        ->addParentClass('treeview')->addClass('treeview-menu');
});
Menu::macro('adminlteMenu', function () {
    return Menu::new()
        ->addClass('sidebar-menu');
});
Menu::macro('adminlteSeparator', function ($title) {
    return Html::raw($title)->addParentClass('header');
});
Menu::macro('sidebar', function () {
    return Menu::adminlteMenu()
        ->add(Html::raw('HEADER')->addParentClass('header'))
        ->action('HomeController@index', 'Home')
        ->add(Menu::adminlteSeparator('Acacha Adminlte'))
        #adminlte_menu
        ->add(Link::toUrl('tasks','Tasques'))
        ->add(Link::toUrl('profile/tokens','Tokens'))

        ->setActiveFromRequest();
});