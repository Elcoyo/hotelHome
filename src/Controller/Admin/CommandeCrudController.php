<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class CommandeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commande::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('idChambre','Nom de la chambre'),
            DateTimeField::new('dateArrivee', "Date d'arrivé"),
            DateTimeField::new('dateDepart', "Date de départ"),
            MoneyField::new('prixTotal')->setCurrency('EUR')->setNumDecimals(2),
            TextField::new('prenom', 'Prénom'),
            TextField::new('nom', 'Nom'),
            TextField::new('email', 'E-mail'),
            TextField::new('telephone', 'Téléphone'),
            DateTimeField::new('dateEnregistrement', "Date d'enrégistrement")->hideOnForm(),
        ];
    }
    
    public function createEntity(string $entityFqcn)
    {
        $commande = new $entityFqcn;
        $commande->setDateEnregistrement(new \Datetime());
        return $commande;
    }
}
