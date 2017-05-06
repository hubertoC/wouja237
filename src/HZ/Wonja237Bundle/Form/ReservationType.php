<?php

namespace HZ\Wonja237Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ReservationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array('label' => 'Nom:'))
                ->add('surname',TextType::class, array('label' => 'Prenom:'))
                ->add('email',EmailType::class)
                ->add('number',NumberType::class, array('label' => 'Numero de telephone:'))
                ->add('ville',TextType::class, array('label' => 'Ville:'))
                ->add('exigence',TextareaType::class)
                ->add('dateDeReservation',DateTimeType::class, array('label' => "Date de l'evênement:"))
                ->add('save', SubmitType::class, array('label' => 'Reserver'))
;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HZ\Wonja237Bundle\Entity\Reservation'
        ));
    }

}
