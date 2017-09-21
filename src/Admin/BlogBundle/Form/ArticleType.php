<?php

namespace Admin\BlogBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('hat')
            ->add('file', FileType::class)
            ->add('content', CKEditorType::class)
            ->add('category', EntityType::class, array(
                'class' => 'Admin\BlogBundle\Entity\Category',
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false,
            ))
            ->add('tags', EntityType::class, array(
                'class' => 'Admin\BlogBundle\Entity\Tag',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Admin\BlogBundle\Entity\Article'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'admin_blogbundle_article';
    }


}
