<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('photoFile', VichImageType::class, [
                'label' => 'Photo de profil',
                'required' => false,
                'allow_delete' => false,
                'download_uri' => false,
                'image_uri' => true,
                'attr' => ['class' => 'form-input'],
                'constraints' => [
                    new File([
                        'maxSize' => '3M',
                        'mimeTypes' => ['image/jpeg', 'image/png'],
                        'mimeTypesMessage' => 'Merci de déposer une photo au format JPG ou PNG (3 Mo max).',
                    ]),
                ],
            ])
            ->add('dateNaissance', DateType::class, [
                'label' => 'Date de naissance', 'widget' => 'single_text', 'required' => false,
                'attr' => ['class' => 'form-input'],
            ])
            ->add('lieuNaissance', TextType::class, [
                'label' => 'Lieu de naissance', 'required' => false, 'attr' => ['class' => 'form-input'],
            ])
            ->add('nationalite', TextType::class, [
                'label' => 'Nationalité', 'required' => false, 'attr' => ['class' => 'form-input'],
            ])
            ->add('sexe', ChoiceType::class, [
                'label' => 'Sexe', 'required' => false,
                'choices' => ['Masculin' => 'M', 'Féminin' => 'F', 'Autre' => 'X'],
                'attr' => ['class' => 'form-input'],
                'placeholder' => 'Sélectionner',
            ])
            ->add('dateEmission', DateType::class, [
                'label' => "Date d'émission du passeport", 'widget' => 'single_text', 'required' => false,
                'attr' => ['class' => 'form-input'],
            ])
            ->add('dateExpiration', DateType::class, [
                'label' => "Date d'expiration du passeport", 'widget' => 'single_text', 'required' => false,
                'attr' => ['class' => 'form-input'],
            ])
            ->add('paysEmission', TextType::class, [
                'label' => "Pays d'émission du passeport", 'required' => false, 'attr' => ['class' => 'form-input'],
            ])
            ->add('telephone', TextType::class, [
                'label' => 'Téléphone', 'required' => false, 'attr' => ['class' => 'form-input'],
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse', 'required' => false, 'attr' => ['class' => 'form-input'],
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville', 'required' => false, 'attr' => ['class' => 'form-input'],
            ])
            ->add('pays', TextType::class, [
                'label' => 'Pays de résidence', 'required' => false, 'attr' => ['class' => 'form-input'],
            ])
            ->add('codePostal', TextType::class, [
                'label' => 'Code postal', 'required' => false, 'attr' => ['class' => 'form-input'],
            ])
            ->add('profession', TextType::class, [
                'label' => 'Profession', 'required' => false, 'attr' => ['class' => 'form-input'],
            ])
            ->add('situationFamiliale', ChoiceType::class, [
                'label' => 'Situation familiale', 'required' => false,
                'choices' => [
                    'Célibataire' => 'celibataire',
                    'Marié(e)' => 'marie',
                    'Divorcé(e)' => 'divorce',
                    'Veuf(ve)' => 'veuf',
                ],
                'attr' => ['class' => 'form-input'],
                'placeholder' => 'Sélectionner',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
