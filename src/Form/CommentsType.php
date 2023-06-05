<?php

namespace App\Form;

use App\Entity\Comments;
use App\Entity\Episode;
use App\Repository\EpisodeRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('comment')
            ->add('rate')
            ->add('Episode', null, [
                /* 'by_reference' => false,
                'class' => Episode::class,
                'query_builder' => function (EpisodeRepository $e) {
                    return $e->createQueryBuilder('e')
                        ->orderBy('e.id', 'ASC');
                }, */
                'choice_label' => 'title',
            ])
            ->add('Author', null, ['choice_label' => 'email']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comments::class,
        ]);
    }
}
