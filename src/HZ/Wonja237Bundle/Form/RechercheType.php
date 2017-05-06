<?php
namespace HZ\Wonja237Bundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
class RechercheType extends AbstractType
{


      public function buildForm(FormBuilderInterface $builder, array $options)
      {
          $builder->add('recherche', TextType::class ,array('label' => false, 'attr' => array('class' => 'input-medium search-query')));
      }


      public function getName()
      {
          return 'hz_wonja237bundle_recherche';
      }


}
