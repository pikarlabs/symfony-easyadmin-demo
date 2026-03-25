<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use App\Entity\FormFieldReference;
use App\Entity\Post;
use App\Entity\Tag;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('New Easyadmin Demo');
    }

    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addAssetMapperEntry('admin')
        ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkTo(User::class, 'Users', 'fa fa-users')->setAction(Action::INDEX);
        yield MenuItem::linkTo(Post::class, 'Blog Posts', 'fa fa-file-text-o')->setAction(Action::INDEX);
        yield MenuItem::linkTo(Comment::class, 'Comments', 'far fa-comments')->setAction(Action::INDEX);
        yield MenuItem::linkTo(Tag::class, 'Tags', 'fas fa-tags')->setAction(Action::INDEX);

        yield MenuItem::section('Resources');
        yield MenuItem::linkTo(FormFieldReference::class, 'Form Field Reference', 'fa-solid fa-table-cells')->setAction(Action::NEW);
        yield MenuItem::linkToRoute('Fixtures data', 'fa-solid fa-database', 'admin_regenerate_fixtures');

        yield MenuItem::section('Links');
        yield MenuItem::linkToUrl('EasyAdmin Docs', 'fas fa-book', 'https://symfony.com/doc/current/bundles/EasyAdminBundle/index.html')->setLinkTarget('_blank');
        yield MenuItem::linkToUrl('EasyAdmin Demo', 'fas fa-magic', 'https://github.com/EasyCorp/easyadmin-demo')->setLinkTarget('_blank');
        yield MenuItem::linkToUrl('Sponsor EasyAdmin', 'fa fa-euro-sign', 'https://github.com/sponsors/javiereguiluz')->setLinkTarget('_blank');
    }
}
