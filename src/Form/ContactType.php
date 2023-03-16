<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('content');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
            'remove_fields' => [] // Ajout de l'option pour supprimer des champs
        ]);
    }

    public function getBlockPrefix(): string
    {
        return ''; // Retourne une chaîne vide pour empêcher la création d'un préfixe de champ
    }
}