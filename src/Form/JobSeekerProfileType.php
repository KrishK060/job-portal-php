<?php

namespace App\Form;

use App\Entity\JobSeekerProfile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobSeekerProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName')
            ->add('resume')
            ->add('jobType',ChoiceType::class,[
                'choices'  => [
                    'FullTime' => 'FullTime',
                    'PartTime' => 'PartTime',
                ]
            ]
               
                )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JobSeekerProfile::class,
        ]);
    }
}
