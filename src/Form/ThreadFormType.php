<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Thread;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ThreadFormType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $isAdmin = $this->security->isGranted('ROLE_ADMIN');

        $builder
            ->add('title')
            ->add('description')
            ->add('main');

        if ($isAdmin) {
            $builder->add('status', ChoiceType::class, [
                'choices' => [
                    'Open' => 'open',
                    'Closed' => 'closed',
                ],
            ]);
        }

        $builder->add('categories', EntityType::class, [
            'class' => Category::class,
            'choice_label' => 'title',
            'multiple' => true,
            'expanded' => true
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Thread::class,
        ]);
    }
}
