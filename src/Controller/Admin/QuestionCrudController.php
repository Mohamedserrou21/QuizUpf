<?php

namespace App\Controller\Admin;

use App\Entity\Question;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;

class QuestionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Question::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('content');
        yield AssociationField::new('quiz');
        yield ArrayField::new('answers', 'Answers')
            ->formatValue(function ($value) {
                if (is_iterable($value)) {
                    $formattedAnswers = '';
                    foreach ($value as $index => $answer) {
                        $formattedAnswers .= ($index + 1) . '. ' . $answer . ', ';
                    }
                    // Supprimer la virgule et l'espace en fin de chaîne
                    $formattedAnswers = rtrim($formattedAnswers, ', ');

                    return $formattedAnswers;
                }

                return $value;
            })
            ->addCssClass('fade-in')
            ->hideOnForm();
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add('detail', Action::DETAIL);
    }
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('quiz');
    }
}
