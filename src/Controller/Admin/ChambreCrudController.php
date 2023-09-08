<?php

namespace App\Controller\Admin;

use App\Entity\Chambre;
use phpDocumentor\Reflection\Types\Integer;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ChambreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Chambre::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre', 'Titre'),
            TextField::new('descriptionCourte', 'Description courte'),
            TextEditorField::new('descriptionLongue', 'Desciption longue'),
            ImageField::new('photo')->setUploadDir('public/uploads/img/')->setUploadedFileNamePattern('[timestamp]-[slug].[extension]')->onlyWhenUpdating()->setFormTypeOptions([
                'required' => false, // Rendre le champ non requis lors de la mise à jour
            ]),
            ImageField::new('photo')->setUploadDir('public/uploads/img/')->setUploadedFileNamePattern('[timestamp]-[slug].[extension]')->onlyWhenCreating(),
            ImageField::new('photo')->setBasePath('uploads/img/')->hideOnForm(),
            IntegerField::new('prixJournalier', 'Prix journalier'),
            DateTimeField::new('dateEnregistrement', "Date d'enregistrement")->hideOnForm(),
            // TextEditorField::new('description'),
        ];
    }
    
    public function createEntity(string $entityFqcn)
    {
        $chambre = new $entityFqcn;
        $chambre->setDateEnregistrement(new \Datetime());
        return $chambre;
    }

}
