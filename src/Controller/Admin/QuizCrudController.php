<?php

namespace App\Controller\Admin;

use App\Entity\Quiz;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\TemplateField;
use Symfony\Component\Routing\Annotation\Route;

class QuizCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Quiz::class;
    }

    private $adminUrlGenerator;

    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('Titre');
        yield TextField::new('Description');

        yield ImageField::new('Image')
            ->setBasePath($this->getParameter('app.path.product_images'))
            ->onlyOnIndex();

        yield TextareaField::new('ImageFile')
            ->hideOnIndex()

            ->setFormType(VichImageType::class)
            ->setFormTypeOptions([
                'empty_data' => '', // Set the empty data property to an empty string
            ]);

        yield ArrayField::new('questions', 'Questions')
            ->formatValue(function ($value, $entity) {
                if ($entity instanceof Quiz) {
                    $questions = $entity->getQuestionsArray();
                    $questionLinks = [];

                    foreach ($questions as $question) {
                        $questionLink = sprintf(
                            '<a href="%s">%s</a>',
                            $this->get(AdminUrlGenerator::class)
                                ->setController(QuestionCrudController::class)
                                ->setAction('show')
                                ->setEntityId($question->getId())
                                ->generateUrl(),
                            $question->getContent()
                        );
                        $questionLinks[] = $questionLink;
                    }

                    return implode(', ', $questionLinks);
                }

                return '';
            })
            ->hideOnForm();
    }
}
