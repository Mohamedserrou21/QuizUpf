<?php

namespace App\Controller\Admin;

use App\Entity\Answers;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;

class AnswersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Answers::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('content');
        yield AssociationField::new('question');
        yield BooleanField::new('isCorrect');

        // Si vous souhaitez afficher des champs supplémentaires ou configurer d'autres options,
        // vous pouvez les ajouter ici en utilisant les méthodes yield appropriées.

        return null;
    }
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('question');
    }
}
