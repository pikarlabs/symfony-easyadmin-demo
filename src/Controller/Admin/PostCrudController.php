<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // First Tab
            FormField::addTab('Content (EN)'),
            TextField::new('title'),
            SlugField::new('slug')
                ->setTargetFieldName('title'),
            TextareaField::new('summary'),
            TextEditorField::new('content'),

            // Second Tab
            FormField::addTab('Content (ID)'),
            TextField::new('title_id'),
            TextareaField::new('summary_id'),
            TextEditorField::new('content_id'),

            // Third Tab
            FormField::addTab('Other'),
            DateTimeField::new('publishedAt'),
            AssociationField::new('author')
                ->autocomplete(),
            AssociationField::new('tags')
                ->autocomplete(),
        ];
    }
}
