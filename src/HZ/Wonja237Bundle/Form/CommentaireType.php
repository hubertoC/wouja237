<?php
namespace HZ\Wonja237Bundle\Form;

use HZ\Wonja237Bundle\Entity\Commentaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label' =>'Nom:', 'attr' => array(
              'placeholder' => 'Votre Nom',
            )
))

            ->add('contenu', TextareaType::class, array('label' => 'Commentaire:'));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Commentaire::class,
        ));
    }
}
