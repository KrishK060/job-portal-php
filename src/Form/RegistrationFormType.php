<?php

namespace App\Form;

use App\Entity\User;
use Dom\Text;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label'=>false,
                'attr' => [
                    'placeholder'=>"Email",
                    'class' => 'form-control px-0'
                ]
            ])
            ->add('firstname',TextType::class,[
                'label'=>false,
                'attr' => [
                    'placeholder'=>"firstname",
                    'class' => 'form-control px-0'
                ]
            ])
            ->add('lastname',TextType::class,[
                'label'=>false,
                'attr' => [
                    'placeholder'=>"lastname",
                    'class' => 'form-control px-0'
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('roles', ChoiceType::class, [
                'choices'  => [
                    'job-seeker' => 'ROLE_jobseeker',
                    'Recruiter' => 'ROLE_recruiter',
                ],
                'expanded' => true,
                'multiple' => true,
                'data' => ['ROLE_USER'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please select a role.',
                    ]),
                ],
            ])
            
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'label'=> false,
                'attr' => [
                    'placeholder'=>"password",
                    'class' => 'form-control px-0',
                    'autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
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
