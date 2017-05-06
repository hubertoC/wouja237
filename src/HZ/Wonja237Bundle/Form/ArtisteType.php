<?php

namespace HZ\Wonja237Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use HZ\Wonja237Bundle\Form\ImageType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ArtisteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder->add('name')
                      ->add('surname')
                      ->add('email')
                      ->add('sexe' ,ChoiceType::class, array(
                                                              'choices'  => array(
                                                                '' => null,
                                                                'Masculin' => 'M',
                                                                'Feminin' => 'F',
                                                              ),
                                                            ))
                      ->add('style' ,ChoiceType::class, array(
                        'choices'  => array(
                          'Makossa' => 'Makossa',
                          'hip hop - RNB ' => 'hip hop - RNB',
                          'Folklore/traditionnel' => 'Folklore/traditionnel',
                          'Gospel' => 'Gospel',
                          'Bikutsi' => 'Bikutsi',
                          'Rap/Urbain' => 'Rap/Urbain',
                          'Zouk/love' => 'Zouk/love',
                          'reggae' => 'reggae',

                        ),
                      )
)
                      ->add('status' ,ChoiceType::class, array(
                        'choices'  => array(
                          '' => null,
                          'Solo' => 'solo',
                          'Groupe' => 'Groupe',
                        ),
                      ))


                    ->add('image', ImageType::class)
                    ->add('video', VideoType::class, array('label' =>'Lien Youtube'))
                    ->add('categories',EntityType::class, array(
                                                                'class' => 'HZWonja237Bundle:Category',
                                                                'choice_label' => 'name',
                                                                'multiple'=>true
                                                              )
                          )
                ->add('ville')
                ->add('number')
                ->add('lu', CheckboxType::class, array(
                                                        'label' => 'J\'accepte les conditions: '
        ));
          }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HZ\Wonja237Bundle\Entity\Artiste'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hz_wonja237bundle_artiste';
    }


}
